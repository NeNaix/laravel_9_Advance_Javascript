<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\DataTables\EmployeeDTDataTable;
use App\Rules\UploadExcel;
use App\Imports\EmployeeImporter;
use Excel;

use Validator;
class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth',['except' => ['login','login_request']]);
    // }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(EmployeeDTDataTable $dataTable)
     {
        return $dataTable->render('employee.etable');
    }

    public function fileImport(Request $request) 
    {   
        $request->validate([
            'file' => ['required', new UploadExcel($request->file('file'))],
        ]); 

        Excel::import(new EmployeeImporter, request()->file('file'));
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
        return view('employee.create',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        // dd($request->all());
        $formData = $request->all();
        // for image uplaod

        if ($request->hasFile('img')) {
            $file = $request->File('img');
            $file->move(public_path('storage/images'),$formData['img']->getClientOriginalName());

            User::create([
                'lname' =>$request->fname,
                'lname' =>$request->lname,
                'addr'=> $request->addr,
                'email'=> $request->email,
                'password' =>Hash::make($request->password), 
                'img' => 'storage/images/'.$request['img']->getClientOriginalName()
            ]);
        }
        

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(User::where('c_id',$id)->get());
        $emp = User::withTrashed()->where('role',2)->where('id',$id)->get();
        return response()->json($emp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('employee.edit', ['employee' => User::where('id',$id)->get()]);
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
            'update_lname_employee' => 'required',
            'update_fname_employee' => 'required|string|min:6',
            'update_email_employee'=> 'required|email',
            'update_address_employee'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $formData = $request->all();
        
        if ($request->hasFile('update_img_employee')) {
            $file = $request->file('update_img_employee');
            $file->move(public_path('storage/images'),$file->getClientOriginalName());

            $user = User::where('id',$id)->update([
                'lname'=> $request['update_lname_employee'],
                'fname'=> $request['update_fname_employee'],
                'address'=> $request['update_address_employee'],
                'email'=> $request['update_email_employee'],
                'role'=> 'employee',
                'img'=> 'storage/images/'. $file->getClientOriginalName(),
            ]);
        }else{
            $user = User::where('id',$id)->update([
                'lname'=> $request['update_lname_employee'],
                'fname'=> $request['update_fname_employee'],
                'address'=> $request['update_address_employee'],
                'email'=> $request['update_emaile_employee'],
                'role'=> 'employee',
            ]);

        }

        return response()->json(['status' => 'Employee successfully Updated'],200);
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
        return response()->json(['status' => 'Employee successfully Deleted']);
    }

    public function restore($id)
    {
        User::withTrashed()->where('id',$id)->restore();
        return response()->json(['status' => 'Employee successfully restore']);
    }
}
