<?php

namespace Cinema\Http\Controllers;

use Cinema\Http\Requests;
use Cinema\Http\Requests\UserCreateRequest;
use Cinema\Http\Requests\UserUpdateRequest;
use Cinema\Http\Controllers\Controller;
use Cinema\user;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;


class UsuarioController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => ['create', 'edit']]);

    }
    
    /*
Se intento usar estas funciones para reducir el codigo, pero en la version 5.2 no funciono
por ende fue comentado este codigo

    public function __construct()
    {
        $this->beforeFilter('@find',['only'=>['edit','update','destroy']]);
    }

    public function find(Route $route)
    {
        $this->user = User::find($route->getParameter('usuario'));
    }
*/

    public function index(Request $request)
    {
        $users = User::paginate(2);
        if ($request->ajax())
        {
            return response()->json(view('usuario.users',compact('users'))->render());
        }
        return view('usuario.index',compact('users'));
    }

    public function create()
    {
    	return view('usuario.create');
    }

    public function store(UserCreateRequest $request)
    {
        User::create($request->all());

        Session::flash('message','Usuario Agregado Correctamente');
        return Redirect::to('/usuario');
    }

    public function edit($id)
    {
        /*
        Codigo que se usaria con el constructor y si funcionara el beforeFilter en 5.2

         return view('usuario.edit',['user'=>$this->user]);
        */
        $user = User::find($id);
        return view('usuario.edit',['user'=>$user]);
    }

    public function update($id, UserUpdateRequest $request)
    {
        /*
        Codigo que se usaria con el constructor y si funcionara el beforeFilter en 5.2

        $this->user->fill($request->all());
        $this->user->save();

        Session::flash('message','Usuario Editado Correctamente');
        return Redirect::to('/usuario');

        */

        $user = User::find($id);
        $user->fill($request->all());
        $user->save();

        Session::flash('message','Usuario Editado Correctamente');
        return Redirect::to('/usuario');
    }

    public function destroy($id)
    {
        /*
        Codigo que se usaria con el constructor y si funcionara el beforeFilter en 5.2

        $this->user->delete();

        Session::flash('message','Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
        */

        $user = User::find($id);
        $user->delete();

        Session::flash('message','Usuario Eliminado Correctamente');
        return Redirect::to('/usuario');
    }

}
