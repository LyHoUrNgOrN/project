<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCategory()
    {
        return Category::orderBy('name')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCategory(Request $request)
    {
        // $user = User::where("name",$request->name)->first();
        // if(!$user||!Hash::check($request->password,$user->password)){
        //     return response()->json(["message"=>"Username or Password Invalid"],401);
        // }
        // return response()->json([
        //     "user"=>$user,
        // ]);
        $validate = $request->validate([
            "name"=>"required|unique:categories,name",
        ]);

        $allData = Category::get();
        foreach($allData as $eachData){
            if(strToUpper($eachData->name) === strToUpper($request->name)) {
                return 'false';
            }
        };
        $category = new Category();
        $category->name = $request->name;
        $category->save();
        return response()->json(['message' => 'created', 'newCategory' => $category],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getOne($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCategory(Request $request, $id)
    {   
        $validate = $request->validate([
            "name"=>"required|unique:categories,name",
        ]);
        $allData = Category::get();
        foreach($allData as $eachData){
            if(strToUpper($eachData->name) === strToUpper($request->name)) {
                return 'false';
            }
        };
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();
        return response()->json(['message' => 'update', 'updated' => $category],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCategory($id)
    {
        $isDelete = Category::destroy($id);

        if($isDelete == 1) {
            return response()->json('Deleted');
        } else {
            return response()->json('Cannot find ID');
        }
    }
        /**
     * search the specified category from database.
     *
     * @param  int  $categoryname
     * @return \Illuminate\Http\Response
     */
    public function searchCategory($name)
    {
        return Category::where('name','like','%'.$name.'%')->get();
    }
}

