<?php 
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('MySql.php');

class Tarefa {

    private $mysql;

    //conectando com a tabela de usuarios no banco de dados
    public function __construct()
    {
        $this->mysql = new MySql('tarefas');
    }

    public function cadastrarTarefa($tarefa){
        return $this->mysql->inserir($tarefa);
    }

    public function buscarTodasTarefas()
    {
        return $this->mysql->buscar();
    }

    public function buscarPorTarefa(string $nome){
        $where = "nomeTarefa = '$nome'";
        return $this->mysql->buscar($where);
    }

    public function buscarPorTarefaId($id){
        $where = "id = $id";

        $tarefa = $this->mysql->buscar($where);

        if(count($tarefa) > 0){
            return $tarefa[0];
        }else {
            return false;
        }
    }
    
    public function deletarTarefaPorId($id){
        $where = "id = $id";
        return $this->mysql->deletar($where);
    }

    public function update($tarefa,$id){
        $where = "id = $id";
        return $this->mysql->atualizar($tarefa,$where);
    }
    
}

?>