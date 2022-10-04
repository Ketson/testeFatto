<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

require_once('../model/Tarefa.php');

$tarefaModel = new Tarefa();

$existeNomeTarefa = $tarefaModel->buscarPorTarefa($_POST['nomeTarefa']);
if(count($existeNomeTarefa) > 0){
    $_SESSION['danger'] = 'Tarefa já existe!';
    header('Location: http://localhost/testeFatto/app/view/index.php');
}else {

$tarefa = [
    'nomeTarefa' => $_POST['nomeTarefa'],
    'custo' => $_POST['custo'],
    'data' => $_POST['data'] 
];

$id = intval($_POST['id']);

$tarefaModel->update($tarefa,$id);

$_SESSION['success'] = 'Tarefa Atualizada com Sucesso!';
header('Location: http://localhost/testeFatto/app/view/index.php');
}
?>