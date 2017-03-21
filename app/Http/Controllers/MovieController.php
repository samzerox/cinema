<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;
use Cinema\Http\Requests;
use Cinema\Http\Controllers\Controller;
use Cinema\Genre;
use Cinema\Movie;
use Session;
use Redirect;
use Illuminate\Routing\Route;

class MovieController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
        
    }
        
    public function index()
    {
        $movies = Movie::Movies();
    	return view('pelicula.index',compact('movies'));
    }

    public function create()
    {
    	$genres = Genre::lists('genre','id');
    	return view('pelicula.create',compact('genres'));
    }

    public function store(Request $request)
    {
    	Movie::create($request->all());
    	Session::flash('message','Pelicula Agregada Correctamente');
        return Redirect::to('/pelicula');
    }

    public function edit($id)
    {   $movie = Movie::find($id);

                $this->notFound($movie);

                $genres = Genre::lists('genre', 'id');
                return view('pelicula.edit',['movie'=>$movie,'genres'=>$genres]);

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
        $movie = Movie::find($id);
        $movie->fill($request->all());
        $movie->save();
        Session::flash('message','Pelicula Editada Correctamente');
        return Redirect::to('/pelicula');
    }

    public function destroy($id)
    {
        $movie = Movie::find($id);
        $movie->delete();
        \Storage::delete($movie->path);
        Session::flash('message','Pelicula Eliminada Correctamente');
        return Redirect::to('/pelicula');
    }
}
