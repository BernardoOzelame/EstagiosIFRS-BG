<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do supervisor</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DO SUPERVISOR</h1>

    <a  class="inserir" href="supervisores.php">voltar para a listagem</a>

    <form action="salvarSupervisor.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $supervisor->getId(); ?>">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label> 
        <input type="text" name="nome" id="nome" placeholder="Nome do representante" value="<?php echo $supervisor->getNome(); ?>">
            
        <label for="cargo" title="Este campo é obrigatório!">Cargo<span class="obrigatorio"> *</span></label> 
        <input type="text" name="cargo" id="cargo" placeholder="Cargo do supervisor" value="<?php echo $supervisor->getCargo(); ?>">
        
        <label for="empresas_id" title="Este campo é obrigatório!">Empresa<span class="obrigatorio"> *</span></label>
        <select name="empresas_id" id="empresas_id">
            <option value="-1">Selecione uma empresa</option>
            <?php
                foreach($empresas as $empresa) {
                    $selected = ($empresa->getId() == $supervisor->getEmpresas_id()) ? 'selected' : '';
                    echo "<option value='" . $empresa->getId() . "' " . $selected . ">" . $empresa->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="formacao" title="Este campo é obrigatório!">Formação<span class="obrigatorio"> *</span></label> 
        <input type="text" name="formacao" id="formacao" placeholder="Formação do supervisor" value="<?php echo $supervisor->getFormacao(); ?>">
        
        <label for="email" title="Este campo é obrigatório!">Email<span class="obrigatorio"> *</span></label> 
        <input type="email" name="email" id="email" placeholder="Email do supervisor" value="<?php echo $supervisor->getEmail(); ?>">
        
        <label for="telefoneCelular" title="Este campo é obrigatório!">Telefone celular<span class="obrigatorio"> *</span></label> 
        <input type="text" name="telefoneCelular" id="telefoneCelular" placeholder="Telefone celular do supervisor" value="<?php echo $supervisor->getTelefoneCelular(); ?>">

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
                var nome = $("#nome").val();
                var email = $("#email").val();
                var cargo = $("#cargo").val();
                var formacao = $("#formacao").val();
                var telefoneCelular = $("#telefoneCelular").val();
                var empresas_id = $("#empresas_id").val();

                if (nome === "" || email === "" || cargo === "" || formacao === "" ||
                telefoneCelular === "" || empresas_id === "-1"){
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
        });
    </script>

</body>
</html>