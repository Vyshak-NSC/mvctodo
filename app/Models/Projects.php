<?php

class Projects{
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getProjectById($projectId){
        $projectId = trim($projectId);
        
        $stmt = $this->pdo->prepare("Select * from projects where project_id = ?");
        $stmt->execute([$projectId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // exit;
        if($result){
            $result['elapsed_time'] = $this->getElapsedTime(($result['created_at']));
            return ['success'=>true, 'data'=>$result];
        }
    }

    public function getAllProjects($userId){
        $stmt = $this->pdo->prepare("Select * from projects where user_id = :user_id");
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

    public function getRecentProjects($userId,$limit =  10){
        $query = "SELECT * FROM projects WHERE user_id = :user_id ORDER BY updated_at DESC LIMIT " . (int)$limit;
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
        $timezone = new DateTimeZone('Asia/kolkata');
        $createdTime = new DateTime($datetime,$timezone);
        
        $message = 'Just now';
        
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
                $plural = ($diff->$key > 1)? 's' : '';
                $message = $diff->$key . ' ' .$value . $plural;
                break;
            }
        }
        return "$message ago";
    }
}