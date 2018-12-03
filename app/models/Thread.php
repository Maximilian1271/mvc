<?php
namespace App\models;

use App\Core\Model;
use App\Libs\Sessions;

class Thread extends Model{
    protected $table_name = "threads";

    public function setThread($user_names, $message)
    {
        $author_id = Sessions::get('user_id');

        $user_names = str_replace(" ", "", $user_names);
        $user_names = explode(",", $user_names);

        $user = new User();
        $user_ids = $user->getIdsByUnames($user_names);
        array_push($user_ids, $author_id);

        $user_ids_str = implode("::", $user_ids); // 2::5::6
        $user_ids_str = ":" . $user_ids_str . ":"; // :2::5::6:

        $this->db->query("INSERT INTO {$this->table_name} (user_ids) VALUES ('$user_ids_str')");

        $last_id = $this->db->insert_id;

        $msg = new Message();
        $msg->setMessage($last_id, $author_id, $message);

        header('Location: ' . APP_URL . 'messages/view/' . $last_id);
        exit();
    }
}