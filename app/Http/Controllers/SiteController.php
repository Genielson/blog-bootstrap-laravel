<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;
use Illuminate\Http\Request;
use Session;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $id = Site::limit(1)->get()->toArray();

        if (count($id) == 0){
            $id = 0;
        }else{
            $id = $id[0]['id'];
        }

        return view(
            'admin-site',
            [
                'id' => $id
            ]
        );
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
     * @param  \App\Http\Requests\StoreSiteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSiteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $regras = [
            'title'=>'required|min:1|max:100',
            'header'=>'required',
            'footer'=>'required',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ];

        $feedback = [
            'title.required' => ' O titulo não pode estar em branco',
            'title.min' => 'O titulo deve ter ao menos 1 caractere' ,
            'title.max' => 'O titulo deve ter no máximo 100 caracteres',
            'image.required' => ' É obrigatório inserir uma imagem ',
            'image.image' => 'O upload tem que ser do tipo imagem',
            'image.mimes' => ' O formato de envio deve ser pg,png,jpeg,gif,svg ',
            'image.max' => ' O tamanho máximo para upload de imagem é 2MB',
            'header.required' => ' É necessario escolher uma cor para o header ',
            'footer.required' => ' É necessario escolher uma cor para o footer '
        ];
        $request->validate($regras,$feedback);
       $site = NULL;
       if($id == 0){
           $site = new Site();
       }else{
           $site = Site::findOrFail($id);
       }

        $site->title = $request->input('title');
        $image = $request->file('image');
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $site->url_image_logo = $filename;

        $site->header_background = $request->input('header');
        $site->footer_background = $request->input('footer');
        $site->save();
        Session::flash('message','Site atualizado com sucesso! ');
        return redirect()->route('site.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Site  $site
     * @return \Illuminate\Http\Response
     */
    public function destroy(Site $site)
    {
        //
    }
}
