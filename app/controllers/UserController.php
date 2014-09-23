<?php

class UserController extends Controller {

    public function loginAction() {
        if (Input::server("REQUEST_METHOD") == "POST") {
            $validator = Validator::make(Input::all(), [
                "name" => "required",
                "password" => "required"
            ]);
            if ($validator->passes()) {
                $credentials = [
                    "name" => Input::get("name"),
                    "password" => Input::get("password")
                ];
                if (Auth::attempt($credentials)) {
                    return Redirect::route("user/profile");
                }
            } else {
                $data["name"] = Input::get("name");
                return Redirect::route("user/login")->withInput($data);
            }
        }
        return View::make("user/login");
    }


    public function profileAction() {
        return View::make("user/profile");
    }


    public function logoutAction() {
        Auth::logout();
        return Redirect::to("/login");
    }

}