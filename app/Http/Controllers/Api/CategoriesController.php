<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoriesController extends Controller
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
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




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
        $category = Category::findOrFail($id);
        if($category == NULL){
            return response()->json([
                'message' => 'Categoria não encontrada'
            ],404);
        }
        if($category->delete()){
            return response()->json([
                'message' => 'Categoria deletada com sucesso'
            ],204);
        }else{
            return response()->json([
                'message' => 'Categoria não pode ser deletada, tente mais tarde'
            ],204);
        }
    }




}
