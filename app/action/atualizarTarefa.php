<?php


ini_set('display_errors', true);
error_reporting(E_ALL);

// Inclua o arquivo da classe Tarefa
require_once('../model/Tarefa.php');

session_start();

$tarefaModel = new Tarefa();

$id = intval($_POST['id']);

// Modificar a chamada de `buscarPorTarefa` para incluir o ID da tarefa atual
$existeNomeTarefa = $tarefaModel->buscarPorTarefa($_POST['nomeTarefa'], $id);
if (count($existeNomeTarefa) > 0) {
    $_SESSION['danger'] = 'Tarefa já existe!';
    header('Location: http://localhost/testeFatto/app/view/index.php');
} else {
    $tarefa = [
        'nomeTarefa' => $_POST['nomeTarefa'],
        'custo' => $_POST['custo'],
        'data' => $_POST['data'] 
    ];

    $tarefaModel->update($tarefa, $id);

    $_SESSION['success'] = 'Tarefa Atualizada com Sucesso!';
    header('Location: http://localhost/testeFatto/app/view/index.php');
}

?>