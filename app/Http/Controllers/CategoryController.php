<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Category::all();
        return view('categories',['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $regras = ['category' => 'required|min:1|max:20'];
        $feedback = [
            'category.required' => 'O campo Nome deve ser preenchido',
            'category.min' => 'O titulo deve ter ao menos 1 caractere',
            'categoty.max' => 'O titulo deve ter no máximo 20 caracteres'
        ];

        $request->validate($regras,$feedback);
        $category = new Category();
        $category->title = $request->input('category');
        $category->save();
        return redirect()->route('category.index');
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
    public function edit($id)
    {
        $categoria = Category::findOrFail($id);
        return view('category-edit',['categoria'=>$categoria]);
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

        $regras = [
           'category' => 'required|min:1|max:20'
        ];
        $feedback = [
            'category.required' => 'O titulo precisa ser preenchido',
            'category.min' => 'O titulo precisa ter no minimo 1 caractere',
            'category.max' => 'O titulo precisa ter no máximo 20 caracteres '
        ];
        $request->validate($regras,$feedback);
        $categoria = Category::findOrFail($id);
        $categoria->title = $request->input('category');
        $categoria->save();
        return redirect()->route('category.index');

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
    }
}
