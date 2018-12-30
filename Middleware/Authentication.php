<?php
namespace Middleware;

use Models\Admin;

class Authentication
{
    public function __construct()
    {
        $this->adminModel = new Admin();
    }

    /**
     * Redirect not authenticated requests to login page
     */
    public function handle(){
        if(!isset($_SESSION['id'])){
            redirect('/admin/login');
        }
        else{
            $admin = $this->adminModel->find($_SESSION['id']);
            if(!$admin){
                redirect('/admin/login');
            }
        }
    }
}