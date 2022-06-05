<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface categoryRepositoryInterface 
{
    public function createCategory(Request $request);

    public function fetchcategory();

    public function editCategory($id);

    public function updateCategory(Request $request,$id);

    public function deleteCategory($id);

    public function showCategory($id);

}