<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Repository\Notes\Note;

class NotesAuth {

	use BaseAuth;

    public function handle($request, Closure $next) {
        
        $action_data = self::prepare_request($request);
        extract($action_data);

        switch ($uri) {

            case 'create_note':

                $rules = [
                    'title' => 'required',
                ];
                $messages = [];

                $response = self::process_validation($request->all(), $rules, $messages);

                if (count($response)) {
                    return response($response);
                }
                
                break;

            case 'update_note':

                $rules = [
                    'title' => 'required',
                    'note_id' => 'required',
                ];
                $messages = [];

                $response = self::process_validation($request->all(), $rules, $messages);

                if (count($response)) {
                    return response($response);
                }
                
                break;

            case 'delete_note':

                $rules = [
                    'note' => 'required',
                ];
                $messages = [];

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
