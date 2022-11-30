<?php
namespace App\Http\Contracts;

interface CategoryRepositoryInterface {

    public function getSomeCategories();
    public function getCategoryById(int $id);

}
