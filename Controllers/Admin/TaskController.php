<?php
namespace Controllers\Admin;


use Controllers\BaseController;
use Models\Task;

class TaskController extends BaseController
{

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->taskModel = new Task();
    }

    /**
     * Show the list of task with pagination for admin
     */
    public function index(){
        $tasks = $this->taskModel->paginate(3);

        if(is_ajax()){
            view('admin/ajax/index', compact('tasks'));
        }
        else{
            view('admin/index', compact('tasks'));
        }

    }

    /**
     * Show edit form of task
     */
    public function edit(){
        $id = $_GET['id'];
        $task = $this->taskModel->find($id);

        view('admin/edit_task', compact('task'));
    }

    /**
     * Update task
     */
    public function update(){
        $id = $_POST['id'];
        $text = $_POST['text'];

        $this->taskModel->updateById($id, ['text' => $text]);

        $message = 'Task updated successfully!';
        set_flash_message($message);

        redirect('admin/index');
    }

    /**
     * Change the status of task
     */
    public function toggleStatus(){
        $task = $this->taskModel->find($_GET['id']);
        if($task['status'] == 1){
            $status = 0;
        }
        else{
            $status = 1;
        }

        $this->taskModel->updateById($_GET['id'], ['status' => $status]);

        echo $status;
    }
}