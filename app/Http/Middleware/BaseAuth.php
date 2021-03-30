<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;

trait BaseAuth {

    protected static function prepare_request($request) {
        $route = $request->route();
        $uri = $route->uri;
        $app_user_id = $request->input('app_user_id');
        $prefix = $route->action['prefix'];
        $path_info = $request->getPathInfo();

        $request_data['path_info'] = str_replace("/api", "", $path_info);
        $request_data['prefix'] = $prefix;
        $request_data['app_user_id'] = $app_user_id;
        $request_data['uri'] = $uri;
        return $request_data;

        //return $next($request);
    }

    public static function process_validation($request_data, $rules, $messages) {
        $response = [];
        $validator = Validator::make($request_data, $rules, $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            $new_errors = arrange_valdiation_errors($errors);
            $response['errors'] = $new_errors;
            $response['error'] = TRUE;
            $response['msg'] = "*Check Your Errors";            
        }
        return $response;
    }

}
