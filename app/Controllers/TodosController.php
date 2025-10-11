<?php

class TodosController extends Controller{
    public function index(){
        $this->renderView('Todos', ['stylePath'=>'todos', 'aside'=>true]);
    }
}