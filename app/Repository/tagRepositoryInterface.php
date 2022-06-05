<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface tagRepositoryInterface 
{
    public function createTag(Request $request);

    public function editTag($id);

    public function updateTag(Request $request,$id);

    public function deleteTag($id);
}