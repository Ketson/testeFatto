<?php 
require_once('../../app/model/Tarefa.php');

$tarefaModel = new Tarefa();

$arrayTarefa = [
    'nomeTarefa' => 'Estudar',
    'custo' => '600',
    'data' => '1999-01-31'
];

$tarefaModel->cadastrarTarefa($arrayTarefa);

$arrayTarefa = [
    'nomeTarefa' => 'Prova',
    'custo' => '1500',
    'data' => '2000-01-10'
];

$tarefaModel->cadastrarTarefa($arrayTarefa);

$arrayTarefa = [
    'nomeTarefa' => 'Analise',
    'custo' => '999',
    'data' => '1999-01-31'
];

$tarefaModel->cadastrarTarefa($arrayTarefa);

?>