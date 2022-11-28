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

}

