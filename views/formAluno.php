<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do aluno</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DO ALUNO</h1>

    <a class="inserir" href="alunos.php">voltar para a listagem</a>

    <form action="salvarAluno.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $aluno->getId(); ?>">

        <label for="matricula" title="Este campo é obrigatório!">Matrícula<span class="obrigatorio"> *</span></label> 
        <input type="number" name="matricula" id="matricula" placeholder="Matrícula do aluno" value="<?php echo $aluno->getMatricula(); ?>">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label> 
        <input type="text" name="nome" id="nome" placeholder="Nome do aluno" value="<?php echo $aluno->getNome(); ?>">
        
        <label for="cursos_id" title="Este campo é obrigatório!">Curso<span class="obrigatorio"> *</span></label>
        <select name="cursos_id" id="cursos_id">
            <option value="-1">Selecione um curso</option>
            <?php
                foreach($cursos as $curso) {
                    $selected = ($curso->getId() == $aluno->getCursos_id()) ? 'selected' : '';
                    echo "<option value='" . $curso->getId() . "' " . $selected . ">" . $curso->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="email" title="Este campo é obrigatório!">Email<span class="obrigatorio"> *</span></label>
        <input type="email" name="email" id="email" placeholder="Email do aluno" value="<?php echo $aluno->getEmail(); ?>">
        
        <label for="cpf" title="Este campo é obrigatório!">CPF<span class="obrigatorio"> *</span></label>
        <input type="text" name="cpf" id="cpf" placeholder="CPF do aluno" value="<?php echo $aluno->getCpf(); ?>">
        
        <label for="rg" title="Este campo é obrigatório!">RG<span class="obrigatorio"> *</span></label> 
        <input name="rg" id="rg" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" placeholder="RG do aluno" value="<?php echo $aluno->getRg(); ?>" maxlength="10">
        
        <label for="telefoneCelular" title="Este campo é obrigatório!">Telefone Celular<span class="obrigatorio"> *</span></label>
        <input type="text" name="telefoneCelular" id="telefoneCelular" placeholder="Telefone celular do aluno" value="<?php echo $aluno->getTelefoneCelular(); ?>">
    
        
        <label for="endereco" title="Este campo é obrigatório!">Endereço<span class="obrigatorio"> *</span></label>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço do aluno" value="<?php echo $aluno->getEndereco(); ?>">
        
        <label for="cidades_id" title="Este campo é obrigatório!">Cidade<span class="obrigatorio"> *</span></label>
        <select name="cidades_id" id="cidades_id">
            <option value="-1">Selecione uma cidade</option>
            <?php
                foreach($cidades as $cidade) {
                    $selected = ($cidade->getId() == $aluno->getCidades_id()) ? 'selected' : '';
                    echo "<option value='" . $cidade->getId() . "' " . $selected . ">" . $cidade->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="anoEstagio" title="Este campo é obrigatório!">Ano do estágio<span class="obrigatorio"> *</span></label>
        <input name="anoEstagio" id="anoEstagio" 
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
        type="number" placeholder="Ano do Estágio do aluno" value="<?php echo $aluno->getAnoEstagio(); ?>"
        maxlength="4">

        <label for="finalizou2ano" title="Este campo é obrigatório!">Aluno finalizou o 2º ano?<span class="obrigatorio"> *</span></label> 
        <select name="finalizou2ano" id="finalizou2ano">
            <option value="-1" <?php echo ($aluno->getFinalizou2Ano() == -1) ? 'selected' : ''; ?>>Selecione uma opção</option>
            <option value="1" <?php echo ($aluno->getFinalizou2Ano() == 1) ? 'selected' : ''; ?>>Sim</option>
            <option value="0" <?php echo ($aluno->getFinalizou2Ano() == 0) ? 'selected' : ''; ?>>Não</option>
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
                var matricula = $("#matricula")
                var nome = $("#nome").val();
                var email = $("#email").val();
                var cpf = $("#cpf").val();
                var rg = $("#rg").val();
                var endereco = $("#endereco").val();
                var telefoneCelular = $("#telefoneCelular").val();
                var anoEstagio = $("#anoEstagio").val();
                var finalizou2ano = $("#finalizou2ano").val();
                var cidades_id = $("#cidades_id").val();
                var cursos_id = $("#cursos_id").val();

                if (matricula === "" || nome === "" || email === "" || cpf === "" || rg === "" ||
                    endereco === "" || telefoneCelular === "" || anoEstagio === "" || finalizou2ano === "-1" ||
                    cidades_id === "-1" || cursos_id === "-1") {
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

            $('#telefoneCelular').mask('(00) 00000-0000');
            $('#cpf').mask('000.000.000-00', {reverse: true});
        });
    </script>

</body>
</html>