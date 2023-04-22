<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Note;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function create_note(Request $request){
        $bearer = $request->header("authorization");
        $token = explode(" ", $bearer)[1];
        $user = User::all()->where("remember_token", $token)->first();
        if($bearer != ''){
            if($user != null){
                $user_id = $user -> id;
                $validator = Validator::make($request->all(), [
                    "title" => "required|string",

                ]);
                if ($validator->fails()) {
                    return response()->json([
                        "error" => [
                            "message" => "validation failed",
                            "errors" => $validator->errors()
                        ]
                    ]);
                } else {
                    $add = new Note();
                    $add -> user_id = $user_id;
                    $add -> title = $request -> input("title");
                    $add -> text = $request -> input("text");
                    $add -> save();
                    return response() -> json("Created");
                }


            }else{return response()->json("user not found");}
        }else{return response()->json("token is empty");}
    }
    public function show_notes(Request $request){
        $bearer = $request->header("authorization");
        $token = explode(" ", $bearer)[1];
        $user = User::all()->where("remember_token", $token)->first();
        if ($bearer != ''){
            if($user != null){
                $notes = Note::all() -> where("user_id", $user -> id);
                return response() -> json(["data" => [
                    "notes" => $notes
                ]]);

            }else{return response() -> json("User not found");}

        }else{return response() -> json("token is empty");}

    }

}
