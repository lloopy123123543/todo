<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\User;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "login" => "required|string|min:3",
            "password" => "required|string|min:8",
            "name" => "required|string|min:2",
            "surname" => "required|string|min:2",
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => [
                    "message" => "validation failed",
                    "errors" => $validator->errors()
                ]
            ]);
        } else {
            $login = User::all()->where("login", $request->input("login"));
            if ($login != null) {
                $add = new User();
                $token = bin2hex(openssl_random_pseudo_bytes(16));
                $add->login = $request->input("login");
                $add->password = $request->input("password");
                $add->name = $request->input("name");
                $add->surname = $request->input("surname");
                $add->remember_token = $token;

                $add->save();
                return response()->json(["data" => [
                    "token" => $token
                ]]);
            } else {
                return response()->json(["error" => ["errors" => "login alrady exist"]]);
            }
        }
    }


    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "login" => "required|string",
            "password" => "required|string"
        ]);
        if ($validator->fails()) {
            return response()->json([
                "error" => [
                    "message" => "validation failed",
                    "errors" => $validator->errors()
                ]
            ]);
        } else {
            $user = User::all()->where("login", $request->input("login"))->first();
            if ($user != null) {
                if ($user->password == $request->input("password")) {
                    $token = bin2hex(openssl_random_pseudo_bytes(16));
                    $user->remember_token = $token;
                    $user->save();
                    return response()->json(["data" => [
                        "token" => $token
                    ]]);
                }
            } else {
                return response()->json([
                    "error" => [
                        "message" => "Login failes",
                        "errors" => "Login was not found"
                    ]
                ]);
            }
        }
    }

    public function all_users(Request $request)
    {
        $bearer = $request->header("authorization");
        $token = explode(" ", $bearer)[1];
        $user = User::all()->where("remember_token", $token)->first();

        if ($bearer != '') {
            if ($user != null) {
                if ($user->login == 'admin') {
                    $show = User::all();
                    return response()->json($show);
                }else{return response()->json("forbidden for you");}
            }else{return response()->json("user not found");}
        }else{return response()->json("token is empty");}
    }
}
