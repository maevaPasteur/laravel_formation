<?php
namespace App\Helper;

use DB;

class Helper
{
    public static function getNote(int $session_id, int $user_id) 
    {
        $note = DB::table('session_user')->where('session_id', $session_id)->where('user_id', $user_id)->value('note');

        return $note;
    }

    public static function getNotesFromUser(int $user_id) 
    {
        $notes = DB::table('session_user')->where('user_id', $user_id)->value('note');
        
        return $notes;
    }
}
?>