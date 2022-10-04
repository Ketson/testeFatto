<?php 
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
date_default_timezone_set('America/Sao_Paulo');

$conexao = new mysqli ("localhost","root","","banco");
	mysqli_set_charset($conexao, "utf-8");

$id = $_POST['id'];

$arr_item = explode(",",$id);

$ordem = 1;

foreach($arr_item as $arr_item){
        $sql ="UPDATE tarefas SET ordemApresentacao = $ordem WHERE id = $arr_item";

        $execute = $concexao->query($sql) or die(mysqli_error($conexao));
    $ordem++;
}

?>
