<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Repository\Common\AppRepository;
use App\Repository\Users\UserRepository as UserRepo;
use App\Repository\Notes\NoteRepository as NoteRepo;
use Exception;


class Notes extends Controller {

    public function __construct(){
        $this->middleware('NotesAuth');
    }

    public function index(Request $request){
        $data = [
            'app' => env('APP_NAME'),
            'title' => 'Notes',
        ];

        return view('notes.list', $data);
        
    }

    public function search(Request $request) {
        $response = [];
        $app_user_id = $request->input('app_user_id');
        $route = $request->route();
        $count_only = $request->input('count_only');
        
        // print_r($request->all());exit;
        try {

            $current = $request->input('current');
            $row_count = $request->input('rowCount');
            
            $search_phrase = trim($request->input('search_phrase'));
            $where['created_by'] = UserRepo::get_app_user_id();
            

       
            $search_options = [];
            $search_options['where'] = $where;
            
            
            $notes = NoteRepo::get_all_notes($current, $row_count, $search_options);
            

            $data['notes'] = $notes; 
            $notes_html = view('notes.note_snippet', $data);
            $response['html'] = (string) $notes_html;

            if ($current > 0 && $row_count > 0) {
                $start = ($current - 1) * $row_count;
            }else {
                $start = 0;
                $row_count = 100;
            }

            //$current = $current*$row_count;
        
            $response['current'] = ($current*$row_count);
            $response['rowCount'] = $row_count;
            $response['success'] = true;

        } catch (Exception $ex) {
            $response['rows'] = [];
            $response['code'] = 902;
            $response['total'] = 0;
            $response['msg'] = $ex->getMessage();
            $response['error'] = TRUE;
        }
        return $response;
    }

    public function create(Request $request){
        $data = [
            'app' => env('APP_NAME'),
            'title' => 'Note',
        ];

        return view('notes.note', $data);        
    }

    public function create_note(Request $request){
        
        $response = [];
        try {
            
            $note_data = $request->all();
            NoteRepo::create_note($note_data);

            $response['success'] = TRUE;
            $response['msg'] = 'Note created successfully.';
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;       
    }


    public function update($note_id){
        $data = [
            'app' => env('APP_NAME'),
            'title' => 'Note',
        ];

        $data['note'] = NoteRepo::get_note($note_id);
        return view('notes.note', $data);        
    }

    public function update_note(Request $request){
        
        $response = [];
        try {
            
            $note_data = $request->all();

            NoteRepo::update_note($note_data);

            $response['success'] = TRUE;
            $response['msg'] = 'Note updated successfully.';
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;       
    }

    public function delete_note(Request $request){
        
        $response = [];
        try {
            
            $note_id = $request->input('note');

            NoteRepo::delete_note($note_id);

            $response['success'] = TRUE;
            $response['msg'] = 'Note deleted successfully.';
            
        } catch (Exception $ex) {
            $response['error'] = TRUE;
            $response['code'] = $ex->getCode();
            $response['msg'] = $ex->getMessage();
        }
        return $response;       
    }
}
