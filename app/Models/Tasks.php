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

    public function getAllTasks($userId){
        $stmt = $this->pdo->prepare("Select * from tasks where user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getRecentTasks($userId,$limit =  10){
        $query = "SELECT title,description, status FROM tasks WHERE user_id = :user_id ORDER BY updated_at DESC LIMIT " . (int)$limit;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }
}