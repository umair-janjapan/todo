<?php

namespace App\Repository\Notes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

use App\Repository\Notes\Note;


use App\Repository\Common\AppRepository;
use App\Repository\Users\UserRepository as UserRepo;




class NoteRepository {

    public static function get_note($note_id){
        return Note::find($note_id);
    }
    
    public static function get_all_notes($current = 0, $row_count = 0, $search_options = []) {
        
        extract($search_options);
        
        $current = $current-1;
        if($current < 1){
            $current = 0;
        }


        $notes = Note::Where($where)->offset($current)->limit($row_count)->orderBy('note_id', 'desc');

        return $notes->get();
    }

    public static function create_note($note_data) {
        
        $note_data['created_by'] = UserRepo::get_app_user_id();
        $note_data['updated_by'] = $note_data['created_by'];
        return Note::create($note_data);
    }

    public static function update_note($note_data) {
        
        extract($note_data);
        $user_id = UserRepo::get_app_user_id();

        $note = Note::where([
            ['created_by', $user_id],['note_id',$note_id],
        ])->first();

        if(!$note){
            throw new Exception("You are not authorized to update this note.", 1);
        }

        $note->title = $title;
        $note->description = $description;

        $note->updated_by = $user_id;
        $note->updated_at = date('Y-m-d H:i:s');

        $note->save();

    }

    public static function delete_note($note_id) {
        
        $user_id = UserRepo::get_app_user_id();

        $note = Note::where([
            ['created_by', $user_id],['note_id',$note_id],
        ])->first();

        if(!$note){
            throw new Exception("You are not authorized to update this note.", 1);
        }

        $note->deleted_by = $user_id;
        $note->deleted_at = date('Y-m-d H:i:s');
        $note->save();
        //$note->delete();

    }
}
