<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    public function __construct(){
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        if($id == NULL){
            return response()->json([
                'message' => 'O id deve ser diferente de zero'
            ],206);
        }
        if($request->input('name') == NULL
            || $request->input('password') == NULL
            || $request->input('email') == NULL
        ){
            return response()->json([
                'message' => 'Nome,email ou Senha vazio, por favor, envie todos os parametros'
            ],206);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == NULL){
            return response()->json([
               'message' => 'O id deve ser diferente de zero'
            ],206);
        }
        $user = User::findOrFail($id);
        if($user == NULL){
            return response()->json([
               'message' => 'Usuario não encontrado'
            ],404);
        }
        if($user->delete()){
            return response()->json([
                'message' => 'Usuario deletado com sucesso!'
            ],200);
        }else{
            return response()->json([
                'message' => 'Usuario não pode ser deletado, tente mais tarde!'
            ],200);
        }

    }
}
