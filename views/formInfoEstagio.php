<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de informações gerais</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DE INFORMAÇÕES GERAIS</h1>

    <a class="inserir" href="infosEstagio.php">voltar para a listagem</a>

    <form action="salvarInfoEstagio.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $infoEstagio->getId(); ?>">

        <label for="alunos_id" title="Este campo é obrigatório!">Aluno<span class="obrigatorio"> *</span></label>
        <select name="alunos_id" id="alunos_id">
            <option value="-1">Selecione um aluno</option>
            <?php
                foreach ($alunos as $aluno) {
                    $selected = ($aluno->getId() == $infoEstagio->getAlunos_id()) ? 'selected' : '';
                    echo "<option value='" . $aluno->getId() . "' " . $selected . ">" . $aluno->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="cargaHoraria" title="Este campo é obrigatório!">Carga horária<span class="obrigatorio"> *</span></label>
        <input type="text" name="cargaHoraria" id="cargaHoraria" placeholder="Carga horaria do estágio" value="<?php echo $infoEstagio->getCargaHoraria(); ?>">

        <label for="inicio" title="Este campo é obrigatório!">Início<span class="obrigatorio"> *</span></label>
        <input type="date" name="inicio" id="inicio" placeholder="Início do estágio" value="<?php echo $infoEstagio->getInicio(); ?>">

        <label for="termino">Término</label>
        <input type="date" name="termino" id="termino" placeholder="Término do estágio" value="<?php echo $infoEstagio->getTermino(); ?>">

        <label for="previsaoFim" title="Este campo é obrigatório!">Previsão de fim<span class="obrigatorio"> *</span></label>
        <input type="date" name="previsaoFim" id="previsaoFim" placeholder="Previsão de fim do estágio" value="<?php echo $infoEstagio->getPrevisaoFim(); ?>">

        <label for="situacao" title="Este campo é obrigatório!">Situação do estágio<span class="obrigatorio"> *</span></label>
        <select name="situacao" id="situacao">
            <option value="null">Selecione uma situação</option>
            <?php
                foreach ($situacoes as $situacao) {
                    $selected = ($situacao == $infoEstagio->getSituacao()) ? "selected" : "";
                    echo "<option value='" . $situacao . "' " . $selected . ">" . $situacao . "</option>";
                }
            ?>
        </select>

        <label for="supervisores_id">Supervisor</label>
        <select name="supervisores_id" id="supervisores_id">
            <option value="null">Selecione uma supervisor</option>
            <?php
                foreach ($supervisores as $supervisor) {
                    $selected = ($supervisor->getId() == $infoEstagio->getSupervisores_id()) ? 'selected' : '';
                    echo "<option value='" . $supervisor->getId() . "' " . $selected . ">" . $supervisor->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="cursos_id" title="Este campo é obrigatório!">Curso<span class="obrigatorio"> *</span></label>
        <select name="cursos_id" id="cursos_id">
            <option value="null">Selecione um curso</option>
            <?php
                foreach ($cursos as $curso) {
                    $selected = ($curso->getId() == $infoEstagio->getCursos_id()) ? 'selected' : '';
                    echo "<option value='" . $curso->getId() . "' " . $selected . ">" . $curso->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="professorOrientador_id">Professor orientador</label>
        <select name="professorOrientador_id" id="professorOrientador_id">
            <option value="null">Selecione um professor orientador</option>
            <?php
                foreach ($professores as $professor) {
                    $selected = ($professor->getId() == $infoEstagio->getProfessorOrientador_id()) ? 'selected' : '';
                    echo "<option value='" . $professor->getId() . "' " . $selected . ">" . $professor->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="professorCoOrientador_id">Professor coorientador</label>
        <select name="professorCoOrientador_id" id="professorCoOrientador_id">
            <option value="null">Selecione um professor coorientador</option>
            <?php
                foreach ($professores as $professor) {
                    $selected = ($professor->getId() == $infoEstagio->getProfessorCoOrientador_id()) ? 'selected' : '';
                    echo "<option value='" . $professor->getId() . "' " . $selected . ">" . $professor->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="empresas_id">Empresa</label>
        <select name="empresas_id" id="empresas_id">
            <option value="null">Selecione uma empresa</option>
            <?php
                foreach ($empresas as $empresa) {
                    $selected = ($empresa->getId() == $infoEstagio->getEmpresas_id()) ? 'selected' : '';
                    echo "<option value='" . $empresa->getId() . "' " . $selected . ">" . $empresa->getNome() . "</option>";
                }
            ?>
        </select>

        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="jquery.mask.js"></script>
    
    <script>
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                var cargaHoraria = $("#cargaHoraria").val();
                var inicio = $("#inicio").val();
                var situacao = $("#situacao").val();
                var cursos_id = $("#cursos_id").val();
                var alunos_id = $("#alunos_id").val();

                if (cargaHoraria === "", inicio === "", situacao === "-1", cursos_id === "-1", alunos_id === "-1") {
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