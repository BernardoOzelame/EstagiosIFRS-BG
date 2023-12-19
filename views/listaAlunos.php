<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="estilos/listas.css">
    <link rel="stylesheet" href="estilos/menu.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>ALUNOS</h1>

    <div><a class="inserir" href="aluno.php">inserir novo aluno</a></div>

    <div class="pesquisar">
        <input type="text" id="pesquisa" placeholder="">
        <i class="fa-solid fa-magnifying-glass iconePesquisa"></i>
    </div>

    <div id="resultadoPesquisa">
        <table border="1" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Matrícula</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>RG</th>
                    <th>Endereço</th>
                    <th>Telefone Celular</th>
                    <th>Ano do Estágio</th>
                    <th>Finalizou 2º ano?</th>
                    <th>Cidade</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    foreach($alunos as $aluno) {
                        echo "<tr>";
                        echo "<td>" . $aluno->getId() . "</td>";
                        echo "<td>" . $aluno->getMatricula() . "</td>";
                        echo "<td>" . $aluno->getNome() . "</td>";
                        echo "<td class='tamanho1'>" . $aluno->getEmail() . "</td>";
                        echo "<td>" . $aluno->getCpf() . "</td>";
                        echo "<td>" . $aluno->getRg() . "</td>";
                        echo "<td class='tamanho1'>" . $aluno->getEndereco() . "</td>";
                        echo "<td class='tamanho1'>" . $aluno->getTelefoneCelular() . "</td>";
                        echo "<td>" . $aluno->getAnoEstagio() . "</td>";
                        echo "<td>";
                            if ($aluno->getFinalizou2Ano() == 1) {
                                echo "Sim";
                            } else {
                                echo "Não";
                            }
                        echo "</td>";
                        echo "<td>" . $aluno->getCidade() . "</td>";
                        echo "<td>" . $aluno->getCurso() . "</td>";
                        echo "<td class='tamanho2'>";
                        echo "<a class='acoes editar' href='aluno.php?id=" . $aluno->getId() . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                        echo "<a class='acoes excluir' href='#' data-id='" . $aluno->getId() . "'><i class='fa-solid fa-trash-can'></i></a>";                    echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <div id="nenhumResultado">nenhum resultado encontrado</div>

    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#pesquisa").on("input", function () {
                var valorPesquisa = $(this).val().toLowerCase();
                var tabela = $("#tabela tbody tr");
                var mensagemNenhumResultado = $("#nenhumResultado");

                var resultadosEncontrados = false;

                tabela.each(function () {
                    var encontrou = false;
                    $(this).find('td').each(function () {
                        if ($(this).text().toLowerCase().indexOf(valorPesquisa) > -1) {
                            encontrou = true;
                            return false;
                        }
                    });
                    $(this).toggle(encontrou);
                    resultadosEncontrados = resultadosEncontrados || encontrou;
                });
                
                if (resultadosEncontrados) {
                    $("#tabela").show();
                    mensagemNenhumResultado.hide();
                } else {
                    $("#tabela").hide();
                    mensagemNenhumResultado.show();
                }
            });
        });

        $(document).ready(function () {
            $(".excluir").on("click", function (e) {
                e.preventDefault();
                var idAluno = $(this).data('id');
                confirmarExclusao(idAluno);
            });

            function confirmarExclusao(idAluno) {
                Swal.fire({
                    title: 'Tem certeza?',
                    text: 'Esta ação será irreversível!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, excluir!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'excluirAluno.php?id=' + idAluno;
                    }
                });
            }
        });
    </script>
    
</body>
</html>