<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()  //3rd
    {
        //
        $games=Game::all();

        return view('index',compact('games')); // yaha se data games ke variable ma pass ho raha view file ma 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() //1st
    {
        //
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)   //2nd
    {
        //
        $validateData=$request->validate([

            'name'=>'required|max:255',
            'price'=>'required'

        ]);
        $show=Game::create($validateData); // create is used to create new record
        return redirect('/games')->with('success','Game is successfully saved');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)   //4th
    {
        //

        $game=Game::findOrFail($id);  // yaha se id search karay ga jakey database ma 

        return view('edit',compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) //5th
    {
        //
        $validatedData=$request->validate([

            'name'=>'required|max:255',
            'price'=>'required'
        ]);

       Game::whereId($id)->update($validatedData);
       return redirect('/games')->with('success','Game Data is successfully submitted');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

      //  $game=Game::findOrFail($id);
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect('/games')->with('success','Game Data is Successfully Deleted');
    }
}
