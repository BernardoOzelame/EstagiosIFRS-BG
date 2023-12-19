<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário da nota do estágio</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DA NOTA DO ESTÁGIO</h1>

    <a  class="inserir" href="notasEstagio.php">voltar para a listagem</a>

    <form action="salvarNotaEstagio.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $notaEstagio->getId(); ?>">

        <label for="infoEstagios_id" title="Este campo é obrigatório!">Estágio<span class="obrigatorio"> *</span></label>
        <select name="infoEstagios_id" id="infoEstagios_id">
            <option value="-1">Selecione um estágio</option>
            <?php
                foreach($infos as $info) {
                    $selected = ($info->getId() == $notaEstagio->getInfoEstagios_id()) ? 'selected' : '';
                    echo "<option value='" . $info->getId() . "' " . $selected . ">" . "ID do estágio: " . $info->getId() . " - " . "Aluno: " . $info->getAluno() . " - " . "Orientador: " . $info->getProfessorOrientador() . "</option>";
                }
            ?>
        </select>

        <label for="notaProfessorOrientador" title="Este campo é obrigatório!">Nota do professor orientador<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaProfessorOrientador" id="notaProfessorOrientador" placeholder="Nota do Professor Orientador" value="<?php echo $notaEstagio->getNotaProfessorOrientador(); ?>">
        

        <label for="notaProfessorCoOrientador" title="Este campo é obrigatório!">Nota do professor coorientador<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaProfessorCoOrientador" id="notaProfessorCoOrientador" placeholder="Nota do Professor Coorientador" value="<?php echo $notaEstagio->getNotaProfessorCoOrientador(); ?>">
        
        <label for="notaEmpresa" title="Este campo é obrigatório!">Nota da empresa<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaEmpresa" id="notaEmpresa" placeholder="Nota da Empresa" value="<?php echo $notaEstagio->getNotaEmpresa(); ?>">
        
        <label for="notaRepresentante" title="Este campo é obrigatório!">Nota do representante da empresa<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaRepresentante" id="notaRepresentante" placeholder="Nota do Representante da Empresa" value="<?php echo $notaEstagio->getNotaRepresentante(); ?>">
        
        <label for="notaSupervisor" title="Este campo é obrigatório!">Nota do supervisor da empresa<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaSupervisor" id="notaSupervisor" placeholder="Nota do Supervisor da Empresa" value="<?php echo $notaEstagio->getNotaSupervisor(); ?>">
        
        <label for="notaAluno" title="Este campo é obrigatório!">Nota do aluno<span class="obrigatorio"> *</span></label> 
        <input type="number" step="any" name="notaAluno" id="notaAluno" placeholder="Nota do Aluno" value="<?php echo $notaEstagio->getNotaAluno(); ?>">
        
        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                var infoEstagios_id = $("#infoEstagios_id").val();
                var notaProfessorOrientador = $("#notaProfessorOrientador").val();
                var notaProfessorCoOrientador = $("#notaProfessorCoOrientador").val();
                var notaEmpresa = $("#notaEmpresa").val();
                var notaSupervisor = $("#notaSupervisor").val();
                var notaRepresentante = $("#notaRepresentante").val();
                var notaAluno = $("#notaAluno").val();

                if (infoEstagios_id === "-1" || notaProfessorOrientador === "" || notaProfessorCoOrientador === "" || 
                notaEmpresa === "" || notaSupervisor === "" || notaRepresentante === "" ||
                notaAluno === ""){
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