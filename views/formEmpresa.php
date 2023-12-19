<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário da empresa</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DA EMPRESA</h1>

    <a class="inserir" href="empresas.php">voltar para a listagem</a>

    <form action="salvarEmpresa.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $empresa->getId(); ?>">

        <label for="cnpj" title="Este campo é obrigatório!">CNPJ<span class="obrigatorio"> *</span></label>
        <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ da empresa" value="<?php echo $empresa->getCnpj(); ?>">

        <label for="numConvenio" title="Este campo é obrigatório!">Número do convênio<span class="obrigatorio"> *</span></label>
        <input name="numConvenio" id="numConvenio" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" placeholder="Número do convênio da empresa" value="<?php echo $empresa->getNumConvenio(); ?>" maxlength="4">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label>
        <input type="text" name="nome" id="nome" placeholder="Nome da empresa" value="<?php echo $empresa->getNome(); ?>">

        <label for="endereco" title="Este campo é obrigatório!">Endereço<span class="obrigatorio"> *</span></label>
        <input type="text" name="endereco" id="endereco" placeholder="Endereço da empresa" value="<?php echo $empresa->getEndereco(); ?>">

        <label for="telefoneCelular" title="Este campo é obrigatório!">Telefone celular<span class="obrigatorio"> *</span></label>
        <input type="text" name="telefoneCelular" id="telefoneCelular" placeholder="Telefone celular da empresa" value="<?php echo $empresa->getTelefoneCelular(); ?>">

        <label for="email" title="Este campo é obrigatório!">Email<span class="obrigatorio"> *</span></label>
        <input type="email" name="email" id="email" placeholder="Email da empresa" value="<?php echo $empresa->getEmail(); ?>">

        <label for="areas_id" title="Este campo é obrigatório!">Área<span class="obrigatorio"> *</span></label>
        <select name="areas_id" id="areas_id">
            <option value="-1">Selecione uma área</option>
            <?php
                foreach ($areas as $area) {
                    $selected = ($area->getId() == $empresa->getAreas_id()) ? 'selected' : '';
                    echo "<option value='" . $area->getId() . "' " . $selected . ">" . $area->getNome() . "</option>";
                }
            ?>
        </select>

        <label for="cidades_id" title="Este campo é obrigatório!">Cidade<span class="obrigatorio"> *</span></label>
        <select name="cidades_id" id="cidades_id">
            <option value="-1">Selecione uma cidade</option>
            <?php
                foreach ($cidades as $cidade) {
                    $selected = ($cidade->getId() == $empresa->getCidades_id()) ? 'selected' : '';
                    echo "<option value='" . $cidade->getId() . "' " . $selected . ">" . $cidade->getNome() . "</option>";
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
                var cnpj = $("#cnpj").val();
                var numConvenio = $("#numConvenio").val();
                var nome = $("#nome").val();
                var endereco = $("#endereco").val();
                var telefoneCelular = $("#telefoneCelular").val();
                var email = $("#email").val();
                var areas_id = $("#areas_id").val();
                var cidades_id = $("#cidades_id").val();

                if (cnpj === "" || numConvenio === "" || nome === "" || endereco === "" || telefoneCelular === "" ||
                    email === "" || areas_id === "-1" || cidades_id === "-1") {
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
            $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
        });
    </script>

</body>
</html>