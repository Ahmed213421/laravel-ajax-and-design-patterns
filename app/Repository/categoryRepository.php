<?php

namespace App\Repository;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class categoryRepository implements categoryRepositoryInterface{

    public function createCategory(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }
            $category = new Category();
            $category->name = $request->name;
            $category->save();        
            
            return response()->json([
                'status' => 200,
                'message' => 'added successfully',
            ]);    
    }

    public function fetchcategory(){
        $categories = Category::all();
        return response()->json([
            'categories' => $categories
        ]);
    }

    public function editCategory($id){
        $category = Category::find($id);
        if($category)
        {
            return response()->json([
                'status'=>200,
                'category'=> $category,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No category Found.'
            ]);
        }

    }

    public function updateCategory(Request $request, $id)
    {
        $validation = Validator::make($request->all(),[
            'name' => 'required||unique:categories,name|',
        ]);


        if($validation->fails()){
            return response()->json([
                'status' => 400,
                'errors' => $validation->errors(),
            ]);
        }

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        return response()->json([
            'status' => 200,
            'message' => 'added successfully',
        ]);
    }

    public function deleteCategory($id){
        $category = Category::find($id)->delete();
        return response()->json([
            'status' => 200,
            'message' => 'deleted succfully'
        ]);
    }

    public function showCategory($id){
        $category = Category::find($id);
        $posts = Post::where('category_id',$id)->get();
        return view('admin.pages.categories.show',compact('category','posts'));
    }
}