<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UsersAuth {

	use BaseAuth;

    public function handle($request, Closure $next) {
        
        $action_data = self::prepare_request($request);
        extract($action_data);

        switch ($uri) {

            case 'save_user':


                $email_rules = ['required','email','max:255'];
                $email_rules[] = Rule::unique('users')->where(function ($query) {
                        
                    });

                $rules = [
                    'email' => $email_rules,
                    'password' => 'required|min:5',
                ];
                $messages = [
                    'email.email' => "The email must be a valid email address.",
                ];

                $response = self::process_validation($request->all(), $rules, $messages);
                if (count($response)) {
                    return response($response);
                }
                
                break;

            case 'check_login':

                $rules = [
                    'email' => 'required|email|max:255',
                    'password' => 'required|min:5',
                ];
                $messages = [
                    'email.email' => "The email must be a valid email address.",
                ];

                $response = self::process_validation($request->all(), $rules, $messages);
                if (count($response)) {
                    return response($response);
                }
                
                break;

            default:
                
                break;
        }
        return $next($request);
    }

}
