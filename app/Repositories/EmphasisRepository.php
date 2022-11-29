<?php

namespace App\Repositories;
use App\Models\Emphasis;

class EmphasisRepository {
    private $model;
    private $VALUE_ID_UPDATE = 1;

    public function  __construction(){
        $this->model = new Emphasis();
    }


    public function setEmphasisInPost(int $id){

        $emphasis = $this->model::all();
        if(count($emphasis) == 0){
            $newEmphasis = new Emphasis();
            $newEmphasis->post_id = $id;
            $newEmphasis->save();
        }else{
            $emphasis = Emphasis::find($this->VALUE_ID_UPDATE);
            $emphasis->post_id = $id;
            $emphasis->save();
        }

    }

}
