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
            $result = array_map(function($project){
                $project['elapsed_time'] = $this->getElapsedTime(($project['created_at']));
                return $project;
            }, $result);

            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getAllTasks($userId){
        $stmt = $this->pdo->prepare("Select * from tasks where user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            $result = array_map(function($project){
                $project['elapsed_time'] = $this->getElapsedTime(($project['created_at']));
                return $project;
            }, $result);

            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getRecentTasks($userId,$limit =  10){
        $query = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY updated_at DESC LIMIT " . (int)$limit;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if($result){
            $result = array_map(function($project){
                $project['elapsed_time'] = $this->getElapsedTime(($project['created_at']));
                return $project;
            }, $result);

            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getElapsedTime($datetime){
        $now = new DateTime();
        $createdTime = new DateTime($datetime);

        $diff = $now->diff($createdTime);
        $weeks = floor($diff->d / 7);
        $diff->d %= 7;
        $diff->w = $weeks;

        $units = [
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        ];

        foreach($units as $key => $value){
            if($diff->$key){
                $message = $diff->$key . rtrim($key,'s');
                break;
            }
        }
        return $diff->format("$message ago");
    }
}