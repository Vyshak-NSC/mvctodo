<?php

class TasksController extends Controller{
    public function index(){
        $this->renderView('Tasks', ['stylePath'=>'tasks']);
    }
}