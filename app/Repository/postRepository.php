<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class postRepository implements postRepositoryInterface{
    
    public function createPost(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'body' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }
        // dd($request->all());

            $post = new Post();
            $post->title = $request->title;
            $post->body = $request->body;
            $post->category_id = $request->category_id;
            $post->user_id = Auth::user()->id;
            $post->save();
            $post->tags()->attach($request->tag_id);

            
        // return response()->json($product);
        return response()->json([
            'status' => 200,
            'message' => 'added successfully',
        ]);

    }

    public function showPost($id){
        $post = Post::find($id);
        $comments = Comment::where('post_id',$id)->get();
        return view('admin.pages.posts.show',compact('post','comments'));
    }

    public function editPost($id){
        $post = Post::find($id);
        if($post)
        {
            return response()->json([
                'status'=>200,
                'post'=> $post,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Post Found.'
            ]);
        }
    }

    public function updatePost(Request $request,$id){
        $validation = Validator::make($request->all(),[
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
            'tag_id' => 'required',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->tags()->detach($request->tag_id);
        $post->save();

        return response()->json([
            'status' => 200,
            'message' => 'updated successfully',
        ]);
        
    }

    public function deletePost($id){
        $delete = Post::find($id);
        $delete->delete();
        return response()->json([
            'status' => 200,
            'message' => 'deleted succfully'
        ]);
    }

    
}