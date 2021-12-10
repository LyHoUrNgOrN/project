<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers(Request $request){
        return User::latest()->get();
    }

    public function getUser(Request $request, $id){
        return User::findOrFail($id);
    }

    public function createUser(Request $request)
    {
        $request->validate([
        "name"=>"required|min:2|max:30",
        "password"=>"required|confirmed|min:8|max:16",
        'email' => 'required|email|unique:users,email',
        "profile"=>"image|mimes:jpg,png,jpeg,gif|max:19999",
        ]);

        //move image to storage
        $request->file('profile')->store('public/profiles');

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile = $request->file('profile')->hashName();
        $user->save();
        return response()->json(["message"=>"User Created"],200);
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile = $request->profile;
        $user->save();
        return response()->json(["message"=>"Post Updated","user"=>$user],201);
    }

    public function deleteUser($id)
    {
        $isDelete = User::destroy($id);
        if($isDelete){
            return response()->json(["message"=>"deleted"],201);
        }
        return response()->json(["message"=>"deleted_error"],404);
    }


    // public function signup(Request $request){

    //     $request->validate([
    //         "password"=>"required|confirmed",
    //     ]);
    
    //     $user = new User();
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->save();
    //     $token = $user->createToken("mytoken")->plainTextToken;
    //     return response()->json([
    //         "user"=>$user,
    //         "token"=>$token,
    //     ]);
    
    // }
    
    // public function signout(Request $request){
    //     auth()->user()->tokens()->delete();
    //     return response()->json(["user"=>"signout"]);
    // }
    
    public function signIn(Request $request){
        $user = User::where("name",$request->name)->first();
        if(!$user||!Hash::check($request->password,$user->password)){
            return response()->json(["message"=>"Username or Password Invalid"],401);
        }
        return response()->json([
            "user"=>$user,
        ]);
    }
}
