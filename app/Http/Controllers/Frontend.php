<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Common\AppRepository;
use Exception;


class Frontend extends Controller {

    public function __construct(){
        
    }

    public function index() {

        $data = [
            'app' => env('APP_NAME'),
            'title' => env('APP_NAME'),
        ];

        return view('frontend.corporate', $data);
    }


    public function login() {

        $data = [
            'app' => env('APP_NAME'),
            'title' => 'Login',
        ];

        return view('frontend.login', $data);
    }

    public function register() {

        $data = [
            'app' => env('APP_NAME'),
            'title' => 'Register',
        ];

        return view('frontend.register', $data);
    }

}
