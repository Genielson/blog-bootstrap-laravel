<?php

namespace App\Repositories;

use App\Models\LogAccessUser;

class LogAccessUserRepository {
    private $model;

    public function __construct(){
        $this->model = new LogAccessUser();
    }

    public function getCountLogAcessUser(){
        return LogAccessUser::all()->count();
    }

}
