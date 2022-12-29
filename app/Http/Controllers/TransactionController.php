<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\User; 
use App\Models\Transaction;
use App\Models\Service;
use App\Models\Orderline;
use DB;
use Auth;
use Session;
use PDF;
class TransactionController extends Controller{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(Auth::user()->role == 'employee' || Auth::user()->role == 'admin') {
            $data = Transaction::orderBy('id','DESC')->with('customer','customer','orderlines.game')->get();
            return response()->json($data);
        }else{
            $data = Transaction::where('c_id', Auth::user()->id )->with('customer','orderlines.game')->get();
            return response()->json($data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('transaction.create', [
        //     'customer' => User::where('role','customer')->get()
        // ]);
    }

    public function transac(Request $request)
    {
        // dd(Customer::where('c_id',$request->c_id)->with('pet')->get());
        // return view('transaction.trans', [
        //     'customer' => Customer::where('id',$request->c_id)->with('pet')->get(),
        //     'employee' => Employee::all(),
        //     'service' => Service::all()
        // ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $done = array();
        $overall_total = 0;
        try {
        DB::beginTransaction();
        $transaction = Transaction::create(['c_id'=>auth()->user()->id]);

        foreach ($request->get('data') as $key => $value) {
            Orderline::create([
                't_id'=> $transaction->id,
                'g_id'=> (int) $value['id'],
                'qty'=> (int) $value['count'],
                'total' => (int) $value['price'] * (int) $value['count']
            ]);

            $done[]= (object)[
                         "sname"=>$value['name'],
                         "cost"=> $value['price'],
                         "count"=> $value['count'],
                         "total"=> (int) $value['price'] * (int) $value['count'],

                     ];

            $overall_total = $overall_total + ((int) $value['price'] * (int) $value['count']);
        }

        Transaction::where('id',$transaction->id)->update(['total_amount'=>$overall_total]);

        }catch (\Exception $e) {
            DB::rollback();
            return response(['error'=> $e,"data"=>$done]);
        }
        DB::commit();

        $pdf = PDF::loadView('trans_pdf',[
            'customer' => Auth::user()->fname ." ".Auth::user()->lname,
            'trans' => $done
            ]);
         file_put_contents('storage/bills/transaction_no_'.$transaction->id.'.pdf', $pdf->output());

        // $pdf->stream('Reciept.pdf');
        return response(['pdf'=> 'storage/bills/transaction_no_'.$transaction->id.'.pdf']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $t = Transaction::where('id',$id)->limit(1)->get();
        return response()->json($t);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // dd(Transaction::where('t_id',$id)->with('customer.one_pet','employee','ts.service')->get());
       // return view('transaction.edit', [
       //      'trans' => Transaction::where('t_id',$id)->with('customer.one_pet','employee','ts.service')->get(),
       //      'employee' => User::where('role','employee')->get(),
       //      'service' => Service::all(),
       //      'pet' => Pet::all()
       //  ]);
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
        Transaction::find($id)->update($request->all());
        return redirect()->route('trans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $t = Transaction::find($id)->delete();
        return response()->json($t);

    }

    public function addserv($t_id,Request $request)
    {

        // Tran::create(['t_id' => $t_id,'s_id' => $request->s_id]);

        // return view('transaction.edit', [
        //     'trans' => Transaction::where('t_id',$t_id)->with('customer.one_pet','employee','ts.service')->get(),
        //     'employee' => Employee::all(),  
        //     'service' => Service::all(),
        //     'pet' => Pet::all()
        // ]);
    }


    public function delserv($t_id, $s_id)
    {   

        // Tran::where('t_id',$t_id)->where('s_id',$s_id)->delete();

        // return view('transaction.edit', [
        //     'trans' => Transaction::where('t_id',$t_id)->with('customer.one_pet','employee','ts.service')->get(),
        //     'employee' => Employee::all(),  
        //     'service' => Service::all(),
        //     'pet' => Pet::all()
        // ]);
    }


}
