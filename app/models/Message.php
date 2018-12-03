<?php
namespace App\models;

use App\Core\Model;

class Message extends Model
{
    protected $table_name = "messages";

    public function setMessage($thread_id, $user_id, $message)
    {
        $seen_by = ":$user_id:";
        $ts = time();

        $this->db->query("INSERT INTO {$this->table_name} (user_id, thread_id, message, seenby, created_at) VALUES ('$user_id', '$thread_id', '$message', '$seen_by', '$ts')");
    }
}