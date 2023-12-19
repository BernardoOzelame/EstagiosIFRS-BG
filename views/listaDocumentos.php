<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
    <link rel="stylesheet" href="estilos/listas.css">
    <link rel="stylesheet" href="estilos/menu.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    
    <?php 
        include("views/includes/menu.php");
    ?>
    <h1>DOCUMENTOS</h1>

    <div><a class="inserir" href="documento.php">inserir novo documento</a></div>

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
                    <th>Documento</th>
                    <th>Tipo de Documento</th>
                    <th>URL do Arquivo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $diretorio = 'uploads/';

                    foreach($documentos as $documento){
                        echo "<tr>";
                        echo "<td>" . $documento->getId() . "</td>";
                        $infoCorreta = null;
                        foreach($infos as $info){
                            if($info->getId() == $documento->getInfoEstagios_id()){
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
                        echo "<td class='tamanhoDefinido'>" . "<b>ID do estágio: </b>" . $documento->getInfoEstagios_id() . " <br><b>Aluno(a): </b>" . $alunoNome . " " . $alunoUltimoSobrenome . " <br><b>Orientador(a): </b>" . $professorNome . " " . $professorUltimoSobrenome . "</td>";
                        echo "<td>" . $documento->getDocumento() . "</td>";
                        echo "<td>" . $documento->getTipoDocumento() . "</td>";
                        
                        echo "<td>";
                            $enderecoArquivo = $diretorio . $documento->getEnderecoArquivo();
                            if (!empty($documento->getEnderecoArquivo()) && file_exists($enderecoArquivo)) {
                                echo '<a href="' . $enderecoArquivo . '" target="_blank">' . $documento->getEnderecoArquivo() . '</a>';
                            } else {
                                echo 'Não informado';
                            }
                        echo "</td>";
                        echo "<td>";
                            echo "<a class='acoes editar' href='documento.php?id=" . $documento->getId() . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                            echo "<a class='acoes excluir' href='#' data-id='" . $documento->getId() . "'><i class='fa-solid fa-trash-can'></i></a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    function extrairNomeUltimoSobrenome($nomeCompleto) {
                        $nomes = explode(' ', $nomeCompleto);
                        $nome = $nomes[0];
                        $ultimoSobrenome = end($nomes);
                    
                        return [$nome, $ultimoSobrenome];
                    }
                ?>
            </tbody>
        </table>
        
        <div id="nenhumResultado">Nenhum resultado encontrado</div>

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
                var idDocumento = $(this).data('id');
                confirmarExclusao(idDocumento);
            });

            function confirmarExclusao(idDocumento) {
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
                        window.location.href = 'excluirDocumento.php?id=' + idDocumento;
                    }
                });
            }
        });
    </script>   
    
</body>
</html>

