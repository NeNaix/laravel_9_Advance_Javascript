<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

use App\DataTables\ServiceDTDataTable;
use App\Rules\UploadExcel;
use App\Imports\ServiceImporter;
use Excel; 

class ServiceController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ServiceDTDataTable $dataTable)
    {
        return $dataTable->render('service.stable');
    }

    public function fileImport(Request $request) 
    {   
        $request->validate([
            'file' => ['required', new UploadExcel($request->file('file'))],
        ]); 
      
         Excel::import(new ServiceImporter, request()->file('file'));
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
        return view('service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $formData = $request->all();
        // for image uplaod
        $images=array();
        if ($files = $request->file('simg')) {

            foreach($files as $file){
                $file->move(public_path('storage/images'),$file->getClientOriginalName());
                $image_url = 'storage/images/'.$file->getClientOriginalName();
                $images[] = $image_url;
            }
           
            Service::create([
                'sname' =>$request->sname,
                'cost' => (int)$request->cost,
                'simg' =>  implode("|",$images)
                ]);
        }else{
            Service::create([
                'sname' =>$request->sname,
                'cost' => (int)$request->cost,
                'simg' => 'storage/images/tao.png'
                ]);
        }
        

        return redirect()->route('service.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(service::where('c_id',$id)->get());
        return view('service.sshow',['service' => Service::where('s_id',$id)->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('service.edit',['service' => Service::where('s_id',$id)->get()]);
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
         $formData = $request->all();
        if ($files = $request->file('simg')) {

            foreach($files as $file){
                $file->move(public_path('storage/images'),$file->getClientOriginalName());
                $image_url = 'storage/images/'.$file->getClientOriginalName();
                $images[] = $image_url;
            }
           
            Service::find($id)->update([
                'sname' =>$request->sname,
                'cost' => (int)$request->cost,
                'simg' => implode("|",$images)
                ]);
        }else{
           Service::find($id)->update([
                'sname' =>$request->sname,
                'cost' => (int)$request->cost
                ]); 
        }
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return redirect()->route('service.index');
    }

    public function restore($id)
    {
        Service::withTrashed()->where('s_id',$id)->restore();
        return redirect()->route('service.index');
    }
}
