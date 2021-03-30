<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Repository\Common\AppRepository;
use App\Repository\Users\UserRepository as UserRepo;
use Exception;


class Users extends Controller {

    public function __construct(){
        $this->middleware('UsersAuth');
    }

    public function create_user(Request $request){
        
        $response = [];
        try {
            
            $user_data = $request->all();
            UserRepo::create_user($user_data);

            $response['success'] = TRUE;
            $response['msg'] = 'An invitation send to your email.';
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;
    }

    public function activate($token){
        
        $response = [];
        try {
            
            UserRepo::verify_user_email($token);
            return redirect('login')->with('success', 'your account successfully activated.');
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;
    }

    public function verify_user(Request $request){
        
        $response = [];
        try {
            
            $user_data = $request->all();
            
            UserRepo::check_login($user_data);


            $response['success'] = TRUE;
            $response['msg'] = 'User login successfully.';
            $response['url'] = url('/');
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;
    }

    public function logout(UserRepo $obj_user) {
        
        $obj_user->logout();
        return redirect('/');
    }
    

}
