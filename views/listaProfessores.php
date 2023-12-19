<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <link rel="stylesheet" href="estilos/listas.css">
    <link rel="stylesheet" href="estilos/menu.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    
    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>PROFESSORES</h1>

    <div><a class="inserir" href="professor.php">inserir novo professor</a></div>

    <div class="pesquisar">
        <input type="text" id="pesquisa" placeholder="">
        <i class="fa-solid fa-magnifying-glass iconePesquisa"></i>
    </div>

    <div id="resultadoPesquisa">
        <table border="1" id="tabela">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SIAP</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Área</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($professores as $professor) {
                        echo "<tr>";
                        echo "<td>" . $professor->getId() . "</td>";
                        echo "<td>" . $professor->getSiap() . "</td>";
                        echo "<td>" . $professor->getNome() . "</td>";
                        echo "<td>" . $professor->getEmail() . "</td>";
                        echo "<td>" . $professor->getArea() . "</td>";
                        echo "<td>";
                            echo "<a class='acoes editar' href='professor.php?id=" . $professor->getId() . "'><i class='fa-solid fa-pen-to-square'></i></a>";
                            echo "<a class='acoes excluir' href='#' data-id='" . $professor->getId() . "'><i class='fa-solid fa-trash-can'></i></a>";
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
                var idProf = $(this).data('id');
                confirmarExclusao(idProf);
            });

            function confirmarExclusao(idProf) {
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
                        window.location.href = 'excluirProfessor.php?id=' + idProf;
                    }
                });
            }
        });
    </script>
    
</body>
</html>