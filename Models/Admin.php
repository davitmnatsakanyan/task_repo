<?php
namespace Models;

class Admin extends DB
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'admins';
    }

    public function selectByCredentials($credentials){
        $username = $credentials['username'];
        $password = $credentials['password'];

        $stmt = $this->pdo->prepare("SELECT * FROM $this->table WHERE `username`=:username");
        $stmt->execute(['username' => $username]);
        $data = $stmt->fetchAll();

        $admin = [];
        foreach ($data as $row) {
            if(password_verify($password, $row['password'])){
                $admin = $row;
                break;
            }
        }

        return $admin;
    }
}