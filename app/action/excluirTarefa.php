<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
date_default_timezone_set('America/Sao_Paulo');

require_once('../model/Tarefa.php');

$tarefaModel = new tarefa();

$tarefa = $tarefaModel->buscarPorTarefaId($_GET['id']);
$tarefaModel->deletarTarefaPorId($_GET['id']);

$_SESSION['danger'] = 'A tarefa foi excluida!';
header('Location: http://localhost/testeFatto/');
