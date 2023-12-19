<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário do representante</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>
    <?php 
        include("views/includes/menu.php");
    ?>
    <h1>FORMULÁRIO DO REPRESENTANTE</h1>
    <a  class="inserir" href="representantes.php">voltar para a listagem</a>
    <form action="salvarRepresentante.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $representante->getId(); ?>">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label>
        <input type="text" name="nome" id="nome" placeholder="Nome do representante" value="<?php echo $representante->getNome(); ?>">
    
        <label for="funcao" title="Este campo é obrigatório!">Função<span class="obrigatorio"> *</span></label> 
        <input type="text" name="funcao" id="funcao" placeholder="Função do representante" value="<?php echo $representante->getFuncao(); ?>">
    
        <label for="empresas_id" title="Este campo é obrigatório!">Empresa<span class="obrigatorio"> *</span></label>
        <select name="empresas_id" id="empresas_id">
            <option value="-1">Selecione uma empresa</option>
            <?php
                foreach($empresas as $empresa) {
                    $selected = ($empresa->getId() == $representante->getEmpresas_id()) ? 'selected' : '';
                    echo "<option value='" . $empresa->getId() . "' " . $selected . ">" . $empresa->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="cpf" title="Este campo é obrigatório!">CPF<span class="obrigatorio"> *</span></label> 
        <input type="text" name="cpf" id="cpf" placeholder="CPF do representante" value="<?php echo $representante->getCpf(); ?>">
        
        <label for="rg" title="Este campo é obrigatório!">RG<span class="obrigatorio"> *</span></label> 
        <input name="rg" id="rg" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type = "number" placeholder="RG do representante" value="<?php echo $representante->getRg(); ?>" maxlength = "9">

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
                var funcao = $("#funcao").val();
                var cpf = $("#cpf").val();
                var rg = $("#rg").val();
                var empresas_id = $("#empresas_id").val();

                if (nome === "" || funcao === "" || cpf === "" || rg === "" || empresas_id === "-1"){
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

            $('#cpf').mask('000.000.000-00', {reverse: true});
        });
    </script>

</body>
</html>


