<?php


function arrange_valdiation_errors($errors) {
    $keys = $errors->keys();
    $new_errors = [];
    foreach ($keys as $key) {
        $new_errors[$key] = $errors->first($key);
    }
   // display_admin_debug($new_errors);
    return $new_errors;
}

function has_logged_in(){
    if (Session::has('2do_user_id') && Session::has('2do_logged_in')) {

        return TRUE;
    }

    return FALSE;
}
?>
