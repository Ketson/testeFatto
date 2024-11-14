<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

date_default_timezone_set('America/Sao_Paulo');

require_once('../model/Tarefa.php');

//instancia da classe
$tarefaModel = new Tarefa();

if($_POST['nomeTarefa'] == "" || $_POST['custo'] == "" || $_POST['data'] == ""){
    $_SESSION['danger'] = 'Todos os campos devem ser preenchidos!';
    header('Location: Location: http://localhost/testeFatto/app/view/listar.php');
    die();
}

$existeNomeTarefa = $tarefaModel->buscarPorTarefa($_POST['nomeTarefa']);
if(count($existeNomeTarefa) > 0){
    $_SESSION['danger'] = 'Tarefa já existe!';
    header('Location: http://localhost/testeFatto/');

}else {


$arrayTarefa = [
    'nomeTarefa' => htmlspecialchars($_POST['nomeTarefa']),
    'custo' => htmlspecialchars($_POST['custo']),
    'data' => htmlspecialchars($_POST['data'])
];

$tarefaModel->cadastrarTarefa($arrayTarefa);

$_SESSION['success'] = 'Tarefa Cadastrada com Sucesso!';
header('Location: http://localhost/testeFatto/');

}
?>