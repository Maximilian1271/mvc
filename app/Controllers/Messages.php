<?php

namespace App\Controllers;

use App\Core\UserController;
use App\Libs\Formbuilder;
use App\models\Thread;

class Messages extends UserController
{
    public function index() // Inbox
    {
        $this->view->render("messages/index");
    }

    public function create() // Neue Nachricht erstellen
    {
        if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
            $this->formCreateThread();
        }

        $form = new Formbuilder("insert-message");
        $form
            -> addInput("text", "users", "Beteilige User")
            -> addTextarea("message", "Nachricht")
            -> addButton("create-thread", "Neuen Thread erstellen")
        ;

        $data['form'] = $form->output();
        $this->view->render("messages/create", $data);
    }

    public function view($thread_id = null) // Detailnachricht
    {
        if ($thread_id !== null) {
            $this->view->render("messages/view");
        }
    }

    private function formCreateThread()
    {
        if (check_csrf($_POST['csrf'])) {

            // Validierung

            $thread = new Thread();
            $thread->setThread($_POST['users'], $_POST['message']);
        }
    }
}