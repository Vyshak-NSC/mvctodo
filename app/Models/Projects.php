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

    public function getAllProjects(){
        $stmt = $this->pdo->prepare("Select * from projects");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if($result){
            return ['success'=>true, 'data'=>$result];
        }
    }
}