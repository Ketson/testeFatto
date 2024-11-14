<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('../model/Tarefa.php');

$tarefaModel = new Tarefa();


if (isset($_POST['ordem'])) {
    $tarefaModel = new Tarefa();
    $ordemArray = explode(",", $_POST['ordem']);

    foreach ($ordemArray as $indice => $idTarefa) {
        // Atualizando a ordemApresentacao para cada tarefa
        $tarefaModel->update(['ordemApresentacao' => $indice + 1], $idTarefa);
    }

    echo "Ordem atualizada com sucesso!";
} else {
    echo "Erro: ordem não fornecida.";
}
?>
