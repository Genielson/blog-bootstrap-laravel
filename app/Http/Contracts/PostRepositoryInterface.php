<?php
namespace App\Http\Contracts;

interface PostRepositoryInterface {

    public function getSomeCategories();
    public function getCategoryById(int $id);
    public function getAllCategories();

}
