<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de usuário</title>
    <link rel="stylesheet" href="estilos/forms.css">
    <link rel="stylesheet" href="estilos/menu.css">
</head>
<body>

    <?php 
        include("views/includes/menu.php");
    ?>

    <h1>FORMULÁRIO DO USUÁRIO</h1>

    <a class="inserir"  href="usuarios.php">voltar para a listagem</a>

    <form action="salvarUsuario.php" method="POST" id="formulario">
        <input type="hidden" name="id" value="<?php echo $usuario->getId(); ?>">

        <label for="nome" title="Este campo é obrigatório!">Nome<span class="obrigatorio"> *</span></label>
        <input type="text" name="nome" id="nome" placeholder="Nome do Usuário" value="<?php echo $usuario->getNome(); ?>">
        
        <label for="tipoUsuario" title="Este campo é obrigatório!">Tipo de usuário<span class="obrigatorio"> *</span></label>
        <select name="tipoUsuario" id="tipoUsuario">
            <option value="-1">Selecione o tipo de usuário</option>
            <?php                     
                foreach ($tiposUsuario as $tipoUsuario) {
                    $selected = ($tipoUsuario == $usuario->getTipoUsuario()) ? "selected" : "";
                    echo "<option value='" . $tipoUsuario . "' " . $selected . ">" . $tipoUsuario . "</option>";
                } 
            ?>
        </select>

        <label for="login" title="Este campo é obrigatório!">Login<span class="obrigatorio"> *</span></label> 
        <input type="text" name="login" id="login" placeholder="Login do Usuário" value="<?php echo $usuario->getLogin(); ?>">
        
        <div class="input-container">
            <label for="nome">Senha<span class="obrigatorio"> *</span></label> 
            <input class="inputs" placeholder="Senha do Usuário" type="password" name="senha" id="senha" value="">
            <i class="toggle-icon far fa-eye" id="mostrarSenhaIcon"></i>
        </div>

        <div class="alinha-botao">
            <button type="submit">Salvar</button>
        </div>

    </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        document.getElementById('mostrarSenhaIcon').addEventListener('click', function() {
            var senhaInput = document.getElementById('senha');
            var icon = document.getElementById('mostrarSenhaIcon');

            var tipo = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
            senhaInput.setAttribute('type', tipo);

            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
        $(document).ready(function() {
            $("#formulario").submit(function(event) {
                var nome = $("#nome").val();
                var login = $("#login").val();
                var senha = $("#senha").val();
                var tipoUsuario = $("#tipoUsuario").val();

                if (nome === "" || login === "" || tipoUsuario === "-1"){
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