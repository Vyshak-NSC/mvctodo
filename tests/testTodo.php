<?php

require "./app/Models/Todo.php";
require "./config/db.php";

$todo = new Todo($pdo);
$data = $todo->getTodo(1);

echo "<pre>";
print_r($data);
echo "</pre>";