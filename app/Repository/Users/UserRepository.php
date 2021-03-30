<?php

namespace App\Repository\Users;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Exception;
use App\Repository\Users\User;
use App\Repository\Users\Emailtokens;

use App\Repository\Common\AppRepository;

use Illuminate\Support\Str;


class UserRepository {


    public static function create_user($user_data) {
        

        /******* set user_data *****/

        $original_password = $user_data['password'];
        $user_data['password'] = Hash::make($user_data['password']);
        $user_data['is_active'] = '0';
        
        $user = User::create($user_data);

        $data['password'] = $original_password;
        $data['user'] = $user;

        $em_tok['email'] = $user->email;
        $em_tok['token'] = Str::random(60);
        Emailtokens::create($em_tok);

        $subject = "Welcome to 2do";
        $mail_view = "emails/account_activation";
        AppRepository::send_mail($user->email, $subject, $mail_view, $em_tok);

        return $user;
    }

    public static function verify_user_email($token) {
        
        
        $email_token = Emailtokens::where('token', $token)->first();
        if(!$email_token){
            throw new Exception("Token expired.", 1);
        }

        User::where('email', $email_token->email)->update(['is_active'=>'1']);

        $email_token->forceDelete();
        
    }

    public static function check_login($data){

        extract($data);

        $user = User::Where([
            ['email',$email], ['is_active',1]
        ])->first();

        if(!$user){
            throw new Exception("Incorrect Login ID or Password.", 1);
        }

        if (!Hash::check($password, $user->password)) {
            throw new Exception("Incorrect Login ID or Password.", 1);
        }

        self::create_user_session($user);

    }

    private static function create_user_session($user){

        Session::put('2do_user_id', $user->user_id);
        Session::put('2do_user_email', $user->email);
        Session::put('2do_logged_in', TRUE);
        
    }

    public function logout() {

        Session::forget('2do_user_id');
        Session::forget('2do_user_email');
        Session::forget('2do_logged_in');
        Session::flush();
    }


    public static function get_app_user_id(){

        return Session::get('2do_user_id');
    }


}
