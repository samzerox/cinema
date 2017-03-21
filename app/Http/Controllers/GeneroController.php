<?php

namespace Cinema\Http\Controllers;

use Illuminate\Http\Request;

use Cinema\Http\Requests;
use Cinema\Http\Requests\GenreRequest;
use Cinema\Http\Controllers\Controller;
use Cinema\Genre;


class GeneroController extends Controller
{
    /*
    public function __construct()
    {
      $this->beforeFilter('@find',['only' => ['edit','update','destroy']]);
    }

   public function find(Route $route)
   {
      $this->genre = Genre::find($route->getParameter('genero'));
   }
   */

   public function listing()
   {
      $genres = Genre::all();

      return response()->json(
          $genres->toArray()
        );
   }

   public function index()
   {
      return view('genero.index');
   }

   public function create()
   {
        return view('genero.create');
   }

   public function store(GenreRequest $request)
   {
        if($request->ajax())
        {
            Genre::create($request->all());
            return response()->json([
                "mensaje" => "Creado"
            ]);
        }
   }

   public function edit($id)
   {
      $genre = Genre::find($id);

      return response()->json(
          $genre->toArray()
      );
   }

   public function update(Request $request, $id)
   {
      $genre = Genre::find($id);
      $genre->fill($request->all());
      $genre->save();

      return response()->json([
          "mensaje" => "listo"
        ]);
    }

    public function destroy(Request $request, $id)
    {
      $genre = Genre::find($id);
      $genre->delete();
      return response()->json(["mensaje"=> "borrado"]);
    }
}
