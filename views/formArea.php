<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário da área</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DA ÁREA</h1>

    <a class="inserir" href="areas.php">voltar para a listagem</a>

    <form action="salvarArea.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $area->getId(); ?>">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label>
        <input type="text" name="nome" id="nome" placeholder="Nome da área" value="<?php echo $area->getNome(); ?>">

        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                var nome = $("#nome").val();

                if (nome === "") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro',
                        text: 'Preencha todos os campos antes de enviar o formulário.',
                        confirmButtonText: 'Voltar',
                        confirmButtonColor: '#F27474',
                        customClass: {
                            confirmButton: 'btn-voltar'
                        },
                    });
                    event.preventDefault();
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: 'Formulário enviado com sucesso!',
                        showConfirmButton: false
                    });
                }
            });
        });
    </script>

</body>
</html>