<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{

    public function __construct(){
        if(config('app.env') != 'testing'){
            $this->middleware('auth:api');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = DB::table('users')->select('id','name','email','created_at')->get();
        if(count($users) > 0){
            return response()->json([
                $users,
                'success' => true
            ],200);
        }else{
            return response()->json([
                 'Não existem usuarios cadastrados',
                'success' => false
            ],404);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->input('name') == NULL
            || $request->input('password') == NULL
            || $request->input('email') == NULL
        ){
            return response()->json([
                'message' => 'Nome,email ou Senha está vazio, por favor, envie todos os parametros',
                'success' => false
            ],206);
        }else{

            if(User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ])){
                return response()->json([
                    'message' => 'Usuario criado com sucesso ',
                    'success' => true
                ],200);
            }else{
                return response()->json([
                    'message' => 'Não foi possivel criar o usuario no momento, tente mais tarde ',
                    'success' => false
                ],200);
            }

        }


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
                'message' => 'Nome,email ou Senha está vazio, por favor, envie todos os parametros',
                'success' => false
            ],206);
        }else{

            $user = User::findOrFail($id);
            if($user == NULL){
                return response()->json([
                    'message' => 'Usuario não encontrado ',
                    'success' => false
                ],404);
            }else{
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                if($user->save()){
                    return response()->json([
                        'message' => 'Usuario atualizado com sucesso',
                        'success' => true
                    ],200);
                }else{
                    return response()->json([
                        'message' => 'Não foi possível atualizar o usuario, tente mais tarde',
                        'success' => false
                    ],200);
                }
            }
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
            ],204);
        }else{
            return response()->json([
                'message' => 'Usuario não pode ser deletado, tente mais tarde!'
            ],204);
        }

    }
}
