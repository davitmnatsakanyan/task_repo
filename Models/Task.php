<?php
namespace Models;

class Task extends DB
{

    public function __construct()
    {
        parent::__construct();
        $this->table = 'tasks';
    }
}