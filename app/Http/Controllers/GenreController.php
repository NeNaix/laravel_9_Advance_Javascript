<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Game;
use App\Models\Orderline;
use Validator;
use DB;
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $g = Game::select("genre_id" , DB::raw("(count(genre_id)) as total"))
                            ->orderBy('total','DESC')
                            ->groupBy('genre_id')->with(['genre'])
                            ->get();

        $data = array();
        $label = array();

        foreach ($g as $key => $value) {
            array_push($data,$value->total);
            array_push($label,$value->genre->genre);
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
            'genre' =>'required|string|min:3'
        ]);

        if ($validator->fails()) {
                    return response()->json($validator->errors(), 422);
        }
         $genre = Genre::create($request->all());
         return response()->json($genre);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $genre = Genre::where('id',$id)->limit(1)->get();
        return response()->json($genre);
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
            'update_genre' =>'required|string|min:3'
        ]);
        $genre = Genre::where('id',$id)->update(['genre' => $request->update_genre]);
         return response()->json($genre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $genre = Genre::where('id',$id)->delete();
         return response()->json($genre);
    }
}
