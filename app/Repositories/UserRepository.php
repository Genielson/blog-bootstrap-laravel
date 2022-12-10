<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository  {

    private $model;

    function __construct() {
        $this->model = new User();
    }

    public function getCountUser(){
        return $this->model::all()->count();
    }

}
