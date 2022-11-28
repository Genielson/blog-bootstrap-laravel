<?php

namespace App\Repositories;
use App\Models\Emphasis;
use Illuminate\Support\Facades\File;

class EmphasisRepository {
    private $model;

    public function  __construction(){
        $this->model = new Emphasis();
    }


    public function create(int $id){
        $VALUE_ID_UPDATE = 1;
        $emphasis = $this->model::all();
        if(count($emphasis) == 0){
            $newEmphasis = new Emphasis();
            $newEmphasis->post_id = $id;
            $newEmphasis->save();
        }else{
            $emphasis = Emphasis::find($VALUE_ID_UPDATE);
            $emphasis->post_id = $id;
            $emphasis->save();
        }

    }

}
