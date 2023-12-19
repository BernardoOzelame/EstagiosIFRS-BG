<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do documento</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DO DOCUMENTO</h1>

    <a  class="inserir" href="documentos.php">voltar para a listagem</a>

    <form action="salvarDocumento.php" method="POST" enctype="multipart/form-data" id="formulario">
        <input type="hidden" name="id" value="<?php echo $documento->getId(); ?>">

        <label for="infoEstagios_id" title="Este campo é obrigatório!">Estágio<span class="obrigatorio"> *</span></label>
        <select name="infoEstagios_id" id="infoEstagios_id">
            <option value="-1">Selecione um estágio</option>
            <?php
                foreach($infos as $info) {
                    $selected = ($info->getId() == $documento->getInfoEstagios_id()) ? 'selected' : '';
                    echo "<option value='" . $info->getId() . "' " . $selected . ">" . "ID do estágio: " . $info->getId() . " - " . "Aluno: " . $info->getAluno() . " - " . "Orientador: " . $info->getProfessorOrientador() . "</option>";
                }
            ?>
        </select>

        <label for="documento" title="Este campo é obrigatório!">Documento<span class="obrigatorio"> *</span></label>
        <select name="documento" id="documento">
            <option value="-1">Selecione o documento</option>
            <?php                     
                foreach ($docs as $doc) {
                    $selected = ($doc == $documento->getDocumento()) ? "selected" : "";
                    echo "<option value='" . $doc . "' " . $selected . ">" . $doc . "</option>";
                } 
            ?>
        </select>

        <label for="tipoDocumento" title="Este campo é obrigatório!">Tipo de documento<span class="obrigatorio"> *</span></label>
        <select name="tipoDocumento" id="tipoDocumento">
            <option value="-1">Selecione o tipo de documento</option>
            <?php                     
                foreach ($tipoDocumentos as $tipoDocumento) {
                    $selected = ($tipoDocumento == $documento->getTipoDocumento()) ? "selected" : "";
                    echo "<option value='" . $tipoDocumento . "' " . $selected . ">" . $tipoDocumento . "</option>";
                } 
            ?>
        </select>

        <div id="campoArquivo" style="display:none;">
            <label for="arquivo" title="Este campo é obrigatório!">Documento<span class="obrigatorio"> *</span></label>
            <input type="file" accept=".pdf, image/*" name="arquivo" id="arquivo">
        </div>

        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script>
        $(document).ready(function() {
            $("#tipoDocumento").change(function() {
                if ($(this).val() === "Digital") {
                    $("#campoArquivo").show();
                } else {
                    $("#campoArquivo").hide();
                }
            });

            $("#formulario").submit(function(event) {
                var infoEstagios_id = $("#infoEstagios_id");
                var documento  = $("#documento");
                var tipoDocumento = $("#tipoDocumento").val();
                var arquivo = $("#arquivo").val();

                if (tipoDocumento === "-1" || (tipoDocumento === "Digital" && arquivo === "")) {
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