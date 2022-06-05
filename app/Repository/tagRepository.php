<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class tagRepository implements tagRepositoryInterface{
    public function createTag(Request $request){
        $validation = Validator::make($request->all(),[
            'name' => 'required',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }
        // dd($request->all());

            $tag = new Tag();
            $tag->name = $request->name;
            $tag->save();

            
        // return response()->json($product);
        return response()->json([
            'status' => 200,
            'message' => 'added successfully',
        ]);
    }

    public function editTag($id){
        $tag = Tag::find($id);
        if($tag)
        {
            return response()->json([
                'status'=>200,
                'tag'=> $tag,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Tag Found.'
            ]);
        }
    }

    public function updateTag(Request $request,$id){
        
        $validation = Validator::make($request->all(),[
            'name' => 'required|unique:tags,name,except,id',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }

        $tag = Tag::find($id);
        $tag->name = $request->name;
        $tag->save();

        return response()->json([
            'status' => 200,
            'message' => 'updated successfully',
        ]);
    }

    public function deleteTag($id){
        $tag = Tag::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'deleted succfully'
        ]);
    }

    
}