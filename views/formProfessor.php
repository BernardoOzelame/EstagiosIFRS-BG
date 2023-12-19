<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do professor</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DO PROFESSOR</h1>

    <a  class="inserir" href="professores.php">voltar para a listagem</a>

    <form action="salvarProfessor.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $professor->getId(); ?>">

        <label for="siap" title="Este campo é obrigatório!">SIAP<span class="obrigatorio"> *</span></label> 
        <input type="number" name="siap" id="siap" placeholder="SIAP do professor" value="<?php echo $professor->getSiap(); ?>">
        
        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label> 
        <input type="text" name="nome" id="nome" placeholder="Nome do professor" value="<?php echo $professor->getNome(); ?>">
        
        <label for="email" title="Este campo é obrigatório!">Email<span class="obrigatorio"> *</span></label> 
        <input type="text" name="email" id="email" placeholder="Email do professor" value="<?php echo $professor->getEmail(); ?>">
        
        <label for="areas_id" title="Este campo é obrigatório!">Área<span class="obrigatorio"> *</span></label>
        <select name="areas_id" id="areas_id">
            <option value="-1">Selecione uma área</option>
            <?php
                foreach($areas as $area) {
                    $selected = ($area->getId() == $professor->getAreas_id()) ? 'selected' : '';
                    echo "<option value='" . $area->getId() . "' " . $selected . ">" . $area->getNome() . "</option>";
                }
            ?>
        </select>

        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                var siap = $("#siap").val();
                var nome = $("#nome").val();
                var email = $("#email").val();
                var areas_id = $("#areas_id").val();

                if (siap === "" || nome === "" || email === "" || areas_id === "-1"){
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