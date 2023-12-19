<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seção de Estágios</title>
    <link rel="stylesheet" href="estilos/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    
    <div class="container">
        <div class="borda">
            <img src="imgs/logoIFRS.png" class="logo">
        </div>
        <div class="formLogin">
            <h1>LOGIN</h1>
            <form action="fazerLogin.php" method="post" onsubmit="return validar()">
                <label for="login">Usuário</label>
                <input class="inputs" placeholder="Usuário" type="text" name="login" id="login">
                <br>
                <div class="input-container">
                    <label for="senha">Senha</label>
                    <input class="inputs" placeholder="Senha" type="password" name="senha" id="senha">
                    <i class="toggle-icon far fa-eye" id="mostrarSenhaIcon"></i>
                </div>

                <div class="enviar">
                    <button type="submit">Acessar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('mostrarSenhaIcon').addEventListener('click', function() {
            var senhaInput = document.getElementById('senha');
            var icon = document.getElementById('mostrarSenhaIcon');

            var tipo = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
            senhaInput.setAttribute('type', tipo);

            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });

    
        function validar() {
        var usuario = document.getElementById('login').value;
        var senha = document.getElementById('senha').value;

        $.ajax({
            type: 'POST',
            url: 'fazerLogin.php',
            data: { login: usuario, senha: senha },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // SweetAlert para usuário e senha corretos
                    Swal.fire({
                        icon: 'success',
                        title: 'Login realizado com sucesso!',
                        text: 'Bem-vindo de volta!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = 'views/pgInicial.php';
                    });
                } else {
                    // SweetAlert para usuário ou senha incorretos
                    Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro',
                        text: 'Usuário ou senha incorretos. Tente novamente.',
                        confirmButtonText: 'Voltar',
                        confirmButtonColor: '#F27474',
                        customClass: {
                            confirmButton: 'btn-voltar'
                            },
                        });
                }
            },
            error: function(error) {
                console.error('Erro ao processar o login: ', error);
            }
        });
            return false; // Evita o envio do formulário
        }

    </script>
    
</body>
</html>