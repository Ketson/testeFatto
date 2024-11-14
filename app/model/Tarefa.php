<?php 



ini_set('display_errors', true);
error_reporting(E_ALL);

require_once('MySql.php');

class Tarefa {

    private $mysql;

    // Conectando com a tabela de tarefas no banco de dados
    public function __construct()
    {
        $this->mysql = new MySql('tarefas');
    }

    public function cadastrarTarefa($tarefa){
        // Obter o último valor de ordemApresentacao
        $ultimaTarefa = $this->mysql->buscar(null, 1, null, 'ordemApresentacao DESC');
        $ultimaOrdem = !empty($ultimaTarefa) ? $ultimaTarefa[0]['ordemApresentacao'] : 0;
    
        // Atribuir o próximo valor para ordemApresentacao
        $tarefa['ordemApresentacao'] = $ultimaOrdem + 1;
    
        // Inserir a tarefa com o novo valor de ordemApresentacao
        return $this->mysql->inserir($tarefa);
    }
    

    public function buscarTodasTarefas()
    {
        return $this->mysql->buscar(null, null, null, 'ordemApresentacao ASC');
    }
    

    // Método buscarPorTarefa modificado para incluir um parâmetro opcional $id
    public function buscarPorTarefa(string $nome, $id = null){
        $where = "nomeTarefa = '$nome'";
        
        // Se $id for fornecido, adiciona uma condição para ignorar o ID da tarefa atual
        if ($id !== null) {
            $where .= " AND id != $id";
        }

        return $this->mysql->buscar($where);
    }

    public function buscarPorTarefaId($id){
        $where = "id = $id";  // Certifique-se de que o nome da coluna é "id"
        $tarefa = $this->mysql->buscar($where);
        return count($tarefa) > 0 ? $tarefa[0] : null;
    }
    
    
    public function deletarTarefaPorId($id){
        $where = "id = $id";
        return $this->mysql->deletar($where);
    }

    public function update($tarefa, $id){
        $where = "id = $id";
        return $this->mysql->atualizar($tarefa, $where);
    }


    public function trocarOrdem($ordem1, $ordem2) {
        try {
            $sql = "UPDATE tarefas SET ordemApresentacao = CASE
                        WHEN ordemApresentacao = :ordem1 THEN :ordem2
                        WHEN ordemApresentacao = :ordem2 THEN :ordem1
                    END
                    WHERE ordemApresentacao IN (:ordem1, :ordem2)";
            
            // Usando o método getDb() para acessar a conexão PDO
            $stmt = $this->mysql->getDb()->prepare($sql);
            $stmt->bindParam(':ordem1', $ordem1, PDO::PARAM_INT);
            $stmt->bindParam(':ordem2', $ordem2, PDO::PARAM_INT);
    
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Erro ao trocar a ordem das tarefas: " . $ex->getMessage();
            return false;
        }
    }
    
    






    // Método para mover a tarefa para cima
    public function moverParaCima($id)
    {
        // Buscar a tarefa com o ID
        $tarefa = $this->buscarPorTarefaId($id);
        if (!$tarefa) {
            return false;  // Tarefa não encontrada
        }

        // Buscar a tarefa anterior à tarefa atual
        $ordemAnterior = $tarefa['ordemApresentacao'] - 1;
        $tarefaAnterior = $this->mysql->buscar("ordemApresentacao = $ordemAnterior");

        if (count($tarefaAnterior) > 0) {
            $this->trocarOrdem($tarefa['ordemApresentacao'], $tarefaAnterior[0]['ordemApresentacao']);
            return true;
        }

        return false;  // Não há tarefa acima
    }

    // Método para mover a tarefa para baixo
    public function moverParaBaixo($id)
    {
        // Buscar a tarefa com o ID
        $tarefa = $this->buscarPorTarefaId($id);
        if (!$tarefa) {
            return false;  // Tarefa não encontrada
        }

        // Buscar a próxima tarefa à tarefa atual
        $ordemProxima = $tarefa['ordemApresentacao'] + 1;
        $tarefaProxima = $this->mysql->buscar("ordemApresentacao = $ordemProxima");

        if (count($tarefaProxima) > 0) {
            $this->trocarOrdem($tarefa['ordemApresentacao'], $tarefaProxima[0]['ordemApresentacao']);
            return true;
        }

        return false;  // Não há tarefa abaixo
    }

    public function buscarTarefaPorOrdem($ordem)
{
    $where = "ordemApresentacao = $ordem";
    $tarefa = $this->mysql->buscar($where);
    return count($tarefa) > 0 ? $tarefa[0] : null;
}







}
?>
