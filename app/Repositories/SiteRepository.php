<?php

namespace App\Repositories;
use App\Models\Site;

class SiteRepository {
    private $model;

    public function __construct(){
        $this->model = new Site();
    }

    public function getIdConfigurationSite(){

        $id = $this->model::limit(1)->get()->toArray();

        if (count($id) == 0){
            $id = 0;
        }else{
            $id = $id[0]['id'];
        }
        return $id;
    }

    public function updateSiteConfiguration(array $data,int $id){

        $site = NULL;
       if($id == 0){
           $site = new Site();
       }else{
           $site = $this->model::findOrFail($id);
       }

        $site->title = $request->input('title');
        $image = $request->file('image');
        $filename = date('YmdHi').$image->getClientOriginalName();
        $image->move(public_path('public/image'),$filename);
        $site->url_image_logo = $filename;

        $site->header_background = $request->input('header');
        $site->footer_background = $request->input('footer');
        $site->save();

    }

}

