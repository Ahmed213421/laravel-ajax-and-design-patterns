<?php

namespace App\Repository;

use Illuminate\Http\Request;

interface postRepositoryInterface 
{
    public function createPost(Request $request);

    public function showPost($id);

    public function editPost($id);

    public function updatePost(Request $request,$id);

    public function deletePost($id);
}