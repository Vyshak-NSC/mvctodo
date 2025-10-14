<?php

class Projects{
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getProjects($id){
        $id = trim($id);
        $stmt = $this->pdo->prepare("Select * from projects where id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getAllProjects($userId){
        $stmt = $this->pdo->prepare("Select * from projects where user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getRecentProjects($userId,$limit =  10){
        $query = "SELECT name,description, task_count FROM projects WHERE user_id = :user_id ORDER BY updated_at DESC LIMIT " . (int)$limit;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }
}