<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User;
use Auth;
use Spatie\Searchable\Search;
use App\DataTables\PetDTDataTable;
use App\Rules\UploadExcel;
use App\Imports\PetImporter;
use Excel;
class PetController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PetDTDataTable $dataTable)
    {
        return $dataTable->render('pet.ptable');
    }
    public function fileImport(Request $request) 
    {   
        
        $request->validate([
            'file' => ['required', new UploadExcel($request->file('file'))],
        ]); 
      
         Excel::import(new PetImporter, request()->file('file'));
         //Excel::import(new AlbumArtistListenerImport, request()->file('album_upload'));
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role == 'employee' || Auth::user()->role == 'admin'){
                return view('pet.create',['customer' => User::where('role','customer')->get()]);
        }else{
            return view('pet.create');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($formData);
        $formData = $request->all();
        $formData['c_id'] = (int)$formData['c_id'];
        // for image uplaod
        if ($request->hasFile('pimg')) {
            $file = $request->File('pimg');
            $file->move(public_path('storage/images'),$formData['pimg']->getClientOriginalName());
            $formData['pimg'] = 'storage/images/'.$formData['pimg']->getClientOriginalName();
        }else{
            $formData['pimg'] = 'storage/images/tao.png';
        }
        Pet::create($formData);
        return redirect()->route('pet.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $d = Pet::with('consult.employee')->where('p_id',$id)->get();
        // dd($d[0]->consult);
        return view('pet.pshow', ['pet' => Pet::with('consult.employee')->where('p_id',$id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        

        if(Auth::user()->role == 'employee' || Auth::user()->role == 'admin'){
            return view('pet.edit', ['pet' => Pet::with('customer')->where('p_id',$id)->get(),
            'customer' => User::where('role','customer')->get()
            ]);
        }else{
            return view('pet.edit', ['pet' => Pet::where('p_id',$id)->get()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $formData = $request->all();
        if (isset($formData['c_id'])) {
            $formData['c_id'] = (int)$formData['c_id'];
        }
        if (isset($formData['page'])) {
            $formData['page'] = (int)$formData['page'];
        }

        if ($request->hasFile('pimg')) {
            $file = $request->File('pimg');
            $file->move(public_path('storage/images'),$formData['pimg']->getClientOriginalName());
            $formData['pimg'] = 'storage/images/'.$formData['pimg']->getClientOriginalName();
        }

        Pet::find($id)->update($formData);
        return redirect()->route('pet.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->route('pet.index');
    }

    public function restore($id)
    {
        Pet::withTrashed()->where('p_id',$id)->restore();
        return redirect()->route('pet.index');
    }
    public function search_pet(Request $request){
        $search = $request->input('search');
        if ($search == null) {
           return redirect()->route('pet.index');
        }
        $data = (new Search())->registerModel(Pet::class, ['pname'])
           ->search($search);
           
         return view('pet.pstable',compact('data'));

        // dd(Pet::withTrashed()->orderBy('p_id', 'DESC')->with('customer')->withTrashed()->where('pname', 'LIKE', "%{$search}%")->paginate(10));
        // if(Auth::user()->role == 'employee' || Auth::user()->role == 'admin'){
        //     return view('pet.ptable',
        //         ['data' => Pet::withTrashed()->orderBy('p_id', 'DESC')->with('customer')->withTrashed()->where('pname', 'LIKE', "%{$search}%")->paginate(10)]);
        // }else{
        //     return view('pet.ptable',
        //         ['data' => Pet::withTrashed()->orderBy('p_id', 'DESC')->where('c_id',Auth::user()->id)->where('pname', 'LIKE', "%{$search}%")->paginate(10)]);
        // }
        
    }
}
