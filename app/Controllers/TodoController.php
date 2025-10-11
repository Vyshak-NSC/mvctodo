<?php

class TodoController extends Controller{
    public function index(){
        $this->renderView('Todo');
    }
}