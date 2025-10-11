<?php

class Todo{
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getTodo($id){
        $id = trim($id);
        $stmt = $this->pdo->prepare("Select * from todos where id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getAllTodo(){
        $stmt = $this->pdo->prepare("Select * from todos");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }
}