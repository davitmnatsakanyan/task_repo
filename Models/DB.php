<?php
namespace Models;

use PDO;
use PDOException;

class DB
{
    protected $con;
    protected $table;
    protected $pdo;

    public function __construct(){
        try {
            $host = conf('database.host');
            $dbname = conf('database.name');
            $username = conf('database.username');
            $password = conf('database.password');

            $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function create($data){

        $keys = implode(',', array_keys($data));

        $array_keys = array_keys($data);
        foreach ($array_keys as $i => $key){
            $array_keys[$i] = ':'.$key;
        }

        $placeholders = implode(',', $array_keys);

        $sql = "INSERT INTO $this->table ($keys) VALUES ($placeholders)";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute($data);

    }

    public function all(){
        $data = $this->pdo->query("SELECT * FROM $this->table")->fetchAll();

        $response = [];
        foreach ($data as $row) {
            array_push($response, $row);
        }

        return $response;
    }

    public function paginate($per_page, $params = []){
        if(isset($_GET['page']))
            $page = $_GET['page'];
        else
            $page = 1;

        $order_by = '';
        if($params) {
            $order_by = 'ORDER BY ' . $params['order_by'] . ' ' . $params['type'];
        }

        $offset = ($page - 1)*$per_page;
        $data = $this->pdo->query("SELECT * FROM $this->table $order_by LIMIT $offset, $per_page")->fetchAll();

        $response['items'] = [];
        foreach ($data as $row) {
            array_push($response['items'], $row);
        }

        $response['total'] = count($this->all());
        $response['last_page'] = ceil($response['total']/$per_page);
        $response['per_page'] = $per_page;
        $response['current_page'] = $page;

        return $response;
    }

    public function find($id){
        $query = "SELECT * FROM $this->table WHERE `id`=:id";
        $stmt= $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch();

        return $data;
    }

    public function updateById($id, $data){

        $placeholders = [];
        foreach ($data as $k => $value){
            array_push($placeholders, $k.'=:'.$k);
        }
        $placeholders = implode(',', $placeholders);

        $query = "UPDATE $this->table SET $placeholders WHERE `id`=$id";
        $stmt= $this->pdo->prepare($query);
        $stmt->execute($data);
    }

}