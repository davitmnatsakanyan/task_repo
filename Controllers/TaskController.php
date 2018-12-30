<?php
namespace Controllers;

use Models\Task;

class TaskController extends BaseController
{
    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->taskModel = new Task();
    }

    /**
     * Show the list of task
     */
    public function all(){
        // validate data
        if(isset($_GET['type'])) {
            $this->validate($_GET, [
                'type' => 'in:asc,desc'
            ], '/');
        }

        $params = [];
        $params['order_by'] = isset($_GET['order_by']) && $_GET['order_by'] ? $_GET['order_by'] : 'id' ;
        $params['type'] = isset($_GET['type']) ? $_GET['type'] : 'asc';

        $tasks = $this->taskModel->paginate(3, $params);

        if(is_ajax()){
            view('task/ajax/all', compact('tasks'));
        }
        else{
            view('task/all', compact('tasks'));
        }
    }

    /**
     * Show form of new task
     */
    public function create(){

        view('task/create');
    }

    /**
     * Save the task
     */
    public function save(){
        // validate data
        $this->validate($_POST, [
            'user_name' => 'required',
            'email' => 'required|email',
            'text' => 'required',
        ],
            'task/create');

        $data = [];
        $data['user_name'] = $_POST['user_name'];
        $data['email'] = $_POST['email'];
        $data['text'] = $_POST['text'];
        $data['status'] = 0; // 0 - in progress; 1 - completed

        $this->taskModel->create($data);

        $message = 'Task created successfully!';
        set_flash_message($message);

        redirect('/');
    }

}