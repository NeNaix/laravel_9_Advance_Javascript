<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Game;
use Auth;
use Spatie\Searchable\Search;
use App\DataTables\CustomerDTDataTable;
use App\Rules\UploadExcel;
use App\Imports\CustomerImporter;
use Excel;
use DB;
use App\Mail\MailRegister;use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller{
    
    public function __construct()
    {
        // $this->middleware(['auth']);
        // $this->middleware(['auth'])->except(['store','edit','update']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerDTDataTable $dataTable)
    {
        $g = Game::select("platform" , DB::raw("(count(platform)) as total"))
                            ->orderBy('total','DESC')
                            ->groupBy('platform')
                            ->get();

        $data = array();
        $label = array();

        foreach ($g as $key => $value) {
            array_push($data,$value->total);
            array_push($label,$value->platform);
        }

        return response(['data'=> $data ,'label'=> $label]);
    }

    public function fileImport(Request $request) 
    {   
        
        $request->validate([
            'file' => ['required', new UploadExcel($request->file('file'))],
        ]); 
      
         Excel::import(new CustomerImporter, request()->file('file'));
        
        return redirect()->back()->with('success', 'Excel file Imported Successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 
        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd( User::with('transac.ts.service','transac.one_pet','transac.employee')->where('id',$id)->get());
        $customer = User::withTrashed()->where('role',1)->where('id',$id)->get();
        return response()->json($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('customer.edit', ['customer' => User::where('id',$id)->get()]);
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

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6',
                'lname'=> 'required|min:3',
                'fname'=> 'required|min:3',
                'address'=>'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
            
        $formData = $request->all();
        
        if ($request->hasFile('update_img_customer')) {
            $file = $request->file('update_img_customer');
            $file->move(public_path('storage/images'),$file->getClientOriginalName());

            $user = User::where('id',$id)->update([
                'lname'=> $request['update_lname_customer'],
                'fname'=> $request['update_fname_customer'],
                'address'=> $request['update_address_customer'],
                'email'=> $request['update_email_customer'],
                'role'=> 'customer',
                'img'=> 'storage/images/'. $file->getClientOriginalName(),
            ]);
        }else{
            $user = User::where('id',$id)->update([
                'lname'=> $request['update_lname_customer'],
                'fname'=> $request['update_fname_customer'],
                'address'=> $request['update_address_customer'],
                'email'=> $request['update_email_customer'],
                'role'=> 'customer',
            ]);

        }

        

        return response()->json(['status' => 'Customer successfully Updated'],200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['status' => 'Customer successfully Deleted']);
    }

    public function restore($id)
    {
        User::withTrashed()->where('id',$id)->restore();
        return response()->json(['status' => 'Customer successfully restore']);
    }

    public function search_customer(Request $request){
        $search = $request->input('search');
        if ($search == null) {
           return redirect()->route('customer.index');
        }
        $data = (new Search())->registerModel(User::class, ['fname','lname'])
           ->search($search);
        // dd($data);
         return view('customer.cstable',compact('data'));
    }

    
}
