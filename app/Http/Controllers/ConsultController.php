<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Consult;
use DB;

use App\Events\ConsemailEvent;

class ConsultController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // dd(Consult::with('employee','one_pet.customer')->orderBy('cons_id','DESC')->get());
       return view('cons.table', ['data' => Consult::with('employee','one_pet.customer')->orderBy('cons_id','DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cons.create', ['pet' => Pet::with('customer')->paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try { 
        $data = Consult::create($request->all());
        }catch (\Throwable $e) {
        DB::rollback();
        throw $e;
        return view('cons.create', ['pet' => Pet::with('customer')->paginate(10)]);
        }
        DB::commit();

        $success = Consult::where('cons_id', $data->cons_id)->with(['employee','one_pet.customer'])->get();
            $info = [
                    'customer_email'=> $success[0]->one_pet->customer->email,
                    'customer'=> $success[0]->one_pet->customer->fname." ".$success[0]->one_pet->customer->lname,
                    'vet' => $success[0]->employee->fname." ".$success[0]->employee->lname,
                    'pet' => $success[0]->one_pet->pname,
                    'injury_disease' => $success[0]->injury_disease,
                    'comment' => $success[0]->comment,
                    'price' => $success[0]->price,
                ];
        
        event(new ConsemailEvent($info));

        return view('cons.consult',[
            'done' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd(Pet::with('customer')->get());
       return view('cons.edit', [
        'pet' => Pet::with('customer')->get(),
        'data' => Consult::with('employee','one_pet')->get()
        ]);
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
        Consult::find($id)->update($request->all());
        return redirect()->route('cons.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Consult::find($id)->delete();
        return redirect()->route('cons.index');
    }
}
