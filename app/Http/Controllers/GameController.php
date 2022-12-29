<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Factory as faker;
use App\Models\Game;
use App\Models\Orderline;
use Spatie\Searchable\Search;
use Validator;
use DB;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $g = Orderline::select("g_id" , DB::raw("(sum(qty)) as qty"))
                            ->orderBy('qty','DESC')
                            ->groupBy('g_id')->with(['game'])
                            ->get();


        $data = array();
        $label = array();

        foreach ($g as $key => $value) {
            array_push($data,$value->qty);
            array_push($label,$value->game->title);
        }

        return response(['data'=> $data ,'label'=> $label]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'title' =>'required',
            'description' =>'required',
            'price' =>'required',
            'platform' =>'required',
            'genre_id' =>'required',
            'stocks' =>'required',
        ]);

        if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $file->move(public_path('storage/images'),$file->getClientOriginalName());

            $game = Game::create([
                'title' =>$request->title,
                'description' => $request->description,
                'price' => (int)$request->price,
                'platform' => $request->platform,
                'genre_id' => (int)$request->genre_id,
                'stocks' => (int)$request->stocks,
                'img' =>  'storage/images/'.$file->getClientOriginalName()
            ]);
        }else{
            $game = Game::create([
                'title' =>$request->title,
                'description' => $request->description,
                'price' => (int)$request->price,
                'platform' => $request->platform,
                'genre_id' => (int)$request->genre_id,
                'stocks' => (int)$request->stock,
            ]);

        }
        return response()->json(['status' => 'Game successfully Created'],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::with(['comments','genre'])->where('id',$id)->limit(1)->get();
        return response()->json($game);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'update_title' =>'required',
            'update_description' =>'required',
            'update_price' =>'required',
            'update_platform' =>'required',
            'update_genre_id' =>'required',
            'update_stocks' =>'required',
        ]);

        if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('update_img')) {
            $file = $request->file('update_img');
            $file->move(public_path('storage/images'),$file->getClientOriginalName());

            $game = Game::where('id',$id)->update([
                'title' =>$request->update_title,
                'description' => $request->update_description,
                'price' => (int)$request->update_price,
                'platform' => $request->update_platform,
                'genre_id' => (int)$request->update_genre_id,
                'stocks' => (int)$request->update_stocks,
                'img' => 'storage/images/'.$file->getClientOriginalName()
            ]);
        }else{
            $game = Game::where('id',$id)->update([
                'title' =>$request->update_title,
                'description' => $request->update_description,
                'price' => (int)$request->update_price,
                'platform' => $request->update_platform,
                'genre_id' => (int)$request->update_genre_id,
                'stocks' => (int)$request->update_stocks
            ]);

        }
        return response()->json(['status' => 'Game successfully Updated'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
     $game = Game::where('id',$id)->delete();

     return response()->json($game);
    }

    public function search(Request $request){
        $search = $request->input('search');
        if ($search == null) {
            $games = Game::with(['comments','genre'])->get();
            return response()->json($games);
        }

        $data = (new Search())->registerModel(Game::class, ['title'])
           ->search($search);

         return response()->json($data,200);
        
    }
}
