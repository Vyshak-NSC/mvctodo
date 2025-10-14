<?php

class Tasks{
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getTask($id){
        $id = trim($id);
        $stmt = $this->pdo->prepare("Select * from tasks where id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getAllTasks(){
        $stmt = $this->pdo->prepare("Select * from tasks");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }
}