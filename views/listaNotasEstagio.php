<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas do Estágio</title>
    <link rel="stylesheet" href="estilos/listas.css">
    <link rel="stylesheet" href="estilos/menu.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    
    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>NOTAS DO ESTÁGIO</h1>

    <div><a class="inserir" href="notaEstagio.php">inserir nova nota</a></div>

    <div class="pesquisar">
        <input type="text" id="pesquisa" placeholder="">
        <i class="fa-solid fa-magnifying-glass iconePesquisa"></i>
    </div>

    <div id="resultadoPesquisa">
        <table border="1" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estágio</th>
                    <th>Nota do Professor Orientador</th>
                    <th>Nota do Professor Coorientador</th>
                    <th>Nota da Empresa</th>
                    <th>Nota do Representante</th>
                    <th>Nota do Supervisor</th>
                    <th>Nota do Aluno</th>
                    <th>Nota Final</th>
                    <th>Situação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($notasEstagio as $notaEstagio) {
                        echo "<tr>";
                        echo "<td>" . $notaEstagio->getId() . "</td>";

                        $infoCorreta = null;
                        foreach($infos as $info){
                            if($info->getId() == $notaEstagio->getInfoEstagios_id()){
                                $infoCorreta = $info;
                                break;
                            }
                        }
                        if($infoCorreta){
                            $alunoNomeCompleto = $infoCorreta->getAluno();
                            $professorNomeCompleto = $infoCorreta->getProfessorOrientador();

                            // Extrair o nome e o último sobrenome do aluno
                            list($alunoNome, $alunoUltimoSobrenome) = extrairNomeUltimoSobrenome($alunoNomeCompleto);

                            // Extrair o nome e o último sobrenome do professor
                            list($professorNome, $professorUltimoSobrenome) = extrairNomeUltimoSobrenome($professorNomeCompleto);
                        }
                        echo "<td class='tamanhoDefinido'>" . "<b>ID do estágio: </b>" . $notaEstagio->getInfoEstagios_id() . " <br><b>Aluno(a): </b>" . $alunoNome . " " . $alunoUltimoSobrenome . " <br><b>Orientador(a): </b>" . $professorNome . " " . $professorUltimoSobrenome . "</td>";
                        


                        echo "<td>" . $notaEstagio->getNotaProfessorOrientador() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaProfessorCoOrientador() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaEmpresa() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaRepresentante() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaSupervisor() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaAluno() . "</td>";
                        echo "<td>" . $notaEstagio->getNotaFinal() . "</td>";
                        echo "<td>" . $notaEstagio->getSituacao() . "</td>";
                        echo "<td class='tamanho2'>";
                            echo "<a class='acoes editar' href='notaEstagio.php?id=" . $notaEstagio->getId() . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                            echo "<a class='acoes excluir' href='#' data-id='" . $notaEstagio->getId() . "'><i class='fa-solid fa-trash-can'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }

                    function extrairNomeUltimoSobrenome($nomeCompleto) {
                        $nomes = explode(' ', $nomeCompleto);
                        $ultimoNome = array_pop($nomes);
                        $nome = implode(' ', $nomes);
                    
                        return [$nome, $ultimoNome];
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
                var idNota = $(this).data('id');
                confirmarExclusao(idNota);
            });

            function confirmarExclusao(idNota) {
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
                        window.location.href = 'excluirNotaEstagio.php?id=' + idNota;
                    }
                });
            }
        });
    </script>
    
</body>
</html>