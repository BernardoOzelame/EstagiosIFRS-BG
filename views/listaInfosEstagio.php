<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações gerais</title>
    <link rel="stylesheet" href="estilos/listas.css">
    <link rel="stylesheet" href="estilos/menu.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    
    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>INFORMAÇÕES GERAIS</h1>

    <div><a class="inserir" href="infoEstagio.php">inserir nova informação</a></div>
    
    <div class="pesquisar">
        <input type="text" id="pesquisa" placeholder="">
        <i class="fa-solid fa-magnifying-glass iconePesquisa"></i>
    </div>

    <div id="resultadoPesquisa">
        <table border="1" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aluno</th>
                    <th>Carga Horária</th>
                    <th>Início</th>
                    <th>Término</th>
                    <th>Previsão de Fim</th>
                    <th>Situação</th>
                    <th>Supervisor</th>
                    <th>Curso</th>
                    <th>Professor Orientador</th>
                    <th>Professor Coorientador</th>
                    <th>Empresa</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($infosEstagio as $infoEstagio) {
                        echo "<tr>";
                        echo "<td>" . $infoEstagio->getId() . "</td>";
                        echo "<td>" . $infoEstagio->getAluno() . "</td>";
                        echo "<td>" . $infoEstagio->getCargaHoraria() . "</td>";
                        echo "<td>" . (($infoEstagio->getInicio() == "0000-00-00" || empty($infoEstagio->getInicio())) ? 'Não informado' : date("d/m/Y", strtotime($infoEstagio->getInicio()))) . "</td>";
                        echo "<td>" . (($infoEstagio->getTermino() == "0000-00-00" || empty($infoEstagio->getTermino())) ? 'Não informado' : date("d/m/Y", strtotime($infoEstagio->getTermino()))) . "</td>";
                        echo "<td>" . (($infoEstagio->getPrevisaoFim() == "0000-00-00" || empty($infoEstagio->getPrevisaoFim())) ? 'Não informado' : date("d/m/Y", strtotime($infoEstagio->getPrevisaoFim()))) . "</td>";
                        $classeSituacao = '';
                        switch ($infoEstagio->getSituacao()) {
                            case 'Finalizado':
                                $classeSituacao = 'finalizado';
                                break;
                            case 'Em andamento':
                                $classeSituacao = 'emAndamento';
                                break;
                            case 'Não iniciado':
                                $classeSituacao = 'naoIniciado';
                                break;
                        }
                        echo "<td><div class='$classeSituacao'>" . $infoEstagio->getSituacao() . "</div></td>";
                        echo "<td>" . (empty($infoEstagio->getSupervisor()) ? 'Não informado' : $infoEstagio->getSupervisor()) . "</td>";
                        echo "<td>" . $infoEstagio->getCurso() . "</td>";
                        echo "<td>" . $infoEstagio->getProfessorOrientador() . "</td>";
                        echo "<td>" . (empty($infoEstagio->getProfessorCoOrientador()) ? 'Não informado' : $infoEstagio->getProfessorCoOrientador()) . "</td>";
                        echo "<td>" . (empty($infoEstagio->getEmpresa()) ? 'Não informado' : $infoEstagio->getEmpresa()) . "</td>";
                        echo "<td  class='tamanho2'>";
                            echo "<a class='acoes editar' href='infoEstagio.php?id=" . $infoEstagio->getId() . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                            echo "<a class='acoes excluir' href='#' data-id='" . $infoEstagio->getId() . "'><i class='fa-solid fa-trash-can'></i></a>";
                        echo "</td>";
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


        $(document).ready(function () {
            $(".excluir").on("click", function (e) {
                e.preventDefault();
                var idInfo = $(this).data('id');
                confirmarExclusao(idInfo);
            });

            function confirmarExclusao(idInfo) {
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
                        window.location.href = 'excluirInfoEstagio.php?id=' + idInfo;
                    }
                });
            }
        });
    </script>
    
</body>
</html>