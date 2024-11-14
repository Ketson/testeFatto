<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('../model/Tarefa.php');

session_start();


if (isset($_POST['moverParaCima'])) {
    $id = $_POST['id'];
    $tarefa = new Tarefa();
    $tarefa->moverParaCima($id);
} elseif (isset($_POST['moverParaBaixo'])) {
    $id = $_POST['id'];
    $tarefa = new Tarefa();
    $tarefa->moverParaBaixo($id);
}

header('Location: http://localhost/testeFatto/app/view/index.php'); // Redireciona de volta para a página de tarefas
exit;
