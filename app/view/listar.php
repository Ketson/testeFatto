<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

require_once('../model/Tarefa.php');

$tarefaModel = new Tarefa();

$tarefas = $tarefaModel->buscarTodasTarefas();

?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/8130779589.js" crossorigin="anonymous"></script>
    <title>Listagem das Tarefas</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="">Página inicial</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

            </ul>
            <a class="btn btn-outline-danger my-2 my-sm-0" href="">Sair</a>
        </div>
    </nav>
    <div class="container">

        <div class="row ">
            <div class="col-12 pt-3">
                <?php include('./components/alerts.php') ?>
                
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-9">
                                <h3>Listagem de Tarefas</h3>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-success btn-block" href="" data-toggle="modal" data-target="#cadastrar">Cadastrar Tarefa</a>
                            </div>
                        </div>
                    </div>
                    <div class="body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Custo</th>
                                    <th scope="col">Data Limite</th>
                                    <th scope="col">Ações</th>

                                </tr>
                            </thead>
                            <tbody>


                                <?php foreach ($tarefas as $tarefa) { ?>

                                    <?php if ($tarefa['custo'] >= 1000) { ?>
                                        <tr>
                                            <td style="background: #D4D856;"><?= $tarefa['id'] ?></td>
                                            <td style="background: #D4D856;"><?= $tarefa['nomeTarefa'] ?></td>
                                            <td style="background: #D4D856;">R$<?= $tarefa['custo'] ?>,00</td>
                                            <td style="background:#D4D856;"><?= date('d/m/Y', strtotime($tarefa['data'])) ?></td>

                                            <td style="background: #D4D856;">

                                                <div class="btn-group" role="group" aria-label="Exemplo básico">
                                                    <a class="btn btn-primary btn-sm" href="" data-toggle="modal" data-target="#editar<?= $tarefa['id'] ?>"><i class="fas fa-user-edit"></i></a>
                                                    <a href="../action/excluirTarefa.php?id=<?php echo $tarefa['id'] ?>" class="btn btn-danger btn-sm " onclick="return confirm('Deseja excluir essa tarefa?');"><i class="far fa-trash-alt"></i></a>

                                                </div>

                                            </td>
                                        </tr>


                                    <?php } else { ?>
                                        <tr>
                                            <td><?= $tarefa['id'] ?></td>
                                            <td><?= $tarefa['nomeTarefa'] ?></td>
                                            <td>R$<?= $tarefa['custo'] ?>,00</td>
                                            <td><?= date('d/m/Y', strtotime($tarefa['data'])) ?></td>

                                            <td>

                                                <div class="btn-group" role="group" aria-label="Exemplo básico">
                                                    <a class="btn btn-primary btn-sm" href="" data-toggle="modal" data-target="#editar<?= $tarefa['id'] ?>"><i class="fas fa-user-edit"></i></a>
                                                    <a href="../action/excluirTarefa.php?id=<?php echo $tarefa['id'] ?>" class="btn btn-danger btn-sm " onclick="return confirm('Deseja excluir essa tarefa?');"><i class="far fa-trash-alt"></i></a>

                                                </div>

                                            </td>
                                        </tr>

                                    <?php } ?>


                                <?php } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->

    <?php foreach ($tarefas as $tarefa) { ?>
        <div class="modal fade" id="editar<?= $tarefa['id'] ?>" tabindex="-1" aria-labelledby="editarModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm-1">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarModalLabel">Editar dados</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="../action/atualizarTarefa.php" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nomeTarefa" name="nomeTarefa" value="<?= $tarefa['nomeTarefa'] ?>">
                                <input type="hidden" name="id" value="<?= $tarefa['id'] ?>">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date">Custo</label>
                                    <input type="number" class="form-control" id="custo" name="custo" value="<?= $tarefa['custo'] ?>" step="0.01" min="0.01">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cpf">Data Limite</label>
                                    <input type="date" class="form-control" id="data" name="data" value="<?= $tarefa['data'] ?>">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="modal fade" id="cadastrar" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm-1">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastrarModalLabel">Cadastrar uma Tarefa
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../action/cadastrarTarefa.php" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" class="form-control" id="nomeTarefa" name="nomeTarefa">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="date">Custo</label>
                                <input type="number" class="form-control" id="custo" name="custo" step="0.01" min="0.01">
                            </div>
                    
                            <div class="form-group col-md-6">
                                <label for="cpf">Data Limite</label>
                                <input type="date" class="form-control" id="data" name="data">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->

</body>

</html>