<?php
namespace Controllers;

use Models\Admin;

class AuthController extends BaseController
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    /**
     * show admin login form
     */
    public function getLogin(){

        view('auth/login');
    }

    /**
     * Check the credentials and Authenticate the admin
     */
    public function postLogin(){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $admin = $this->adminModel->selectByCredentials(['username' => $username, 'password' => $password]);
        if($admin){ // Authentication passed
            $_SESSION['id'] = $admin['id'];
            redirect('admin/index');
        }
        else{ // Authentication failed
            $message = 'Incorrect credentials';
            set_flash_errors($message);
            redirect('/admin/login');
        }
    }

    /**
     * Admin logout
     */
    public function logout(){
        unset($_SESSION['id']);
        redirect('admin/login');
    }
}