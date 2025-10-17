    <?php

    class Tasks{
        public $pdo;

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function getParentProject($taskId){
            $stmt = $this->pdo->prepare("SELECT name from projects,tasks WHERE projects.project_id = tasks.project_id AND tasks.task_id = ?");
            $stmt->execute([$taskId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }

        public function getTask($taskId){
            $taskId = trim($taskId);
            $stmt = $this->pdo->prepare("Select * from tasks where task_id = ?");
            $stmt->execute([$taskId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if($result){
                $result['elapsed_time'] = $this->getElapsedTime(($result['created_at']));
                $result['project_name'] = $this->getParentProject($taskId)['name'] ?? 'No Project';

                return ['success'=>true, 'data'=>$result];
            }
        }

        public function getAllTasks($userId){
            $stmt = $this->pdo->prepare("Select * from tasks where user_id = :user_id");
            $stmt->execute(['user_id' => $userId]);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if($result){
                $result = array_map(function($task){
                    $task['elapsed_time'] = $this->getElapsedTime(($task['created_at']));
                    $task['project_name'] = $this->getParentProject($task['task_id'])['name'] ?? 'No Project';
                    return $task;
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
                $result = array_map(function($task){
                    $task['elapsed_time'] = $this->getElapsedTime(($task['created_at']));
                    $task['project_name'] = $this->getParentProject($task['task_id'])['name'] ?? 'No Project';
                    return $task;
                }, $result);

                return ['success'=>true, 'data'=>$result];
            }
        }

        public function getElapsedTime($datetime){
            $now = new DateTime();
            $timezone = new DateTimeZone('Asia/kolkata');
            $createdTime = new DateTime($datetime,$timezone);
            
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
                    $plural = ($diff->$key   > 1)? 's' : '';
                    $message = $diff->$key . ' ' .$value . $plural;
                    break;
                }
            }
            return "$message ago";
        }
    }