<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSiteRequest;
use App\Models\Site;
use App\Repositories\SiteRepository;
use Exception;
use Session;

class SiteController extends Controller
{
    public $repository;

    public function __construct(SiteRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = NULL;
        try{
            $id = $this->repository->getIdConfigurationSite();
        }catch(Exception $e){
            return "Ocorreu um erro :( ";
        }
        return view('admin-site',['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSiteRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteRequest $request, $id)
    {
        $data = $request->validated();
        try{
           $this->repository->updateSiteConfiguration($data,$id);
           Session::flash('message','Site atualizado com sucesso! ');
        }catch(Exception $e){
           return $e->getMessage();
        }
        return redirect()->route('site.index');
    }

}
