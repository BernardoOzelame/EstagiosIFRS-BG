<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>

    <div id="mainContent" class="content">
        <div class="header">
            <i id="toggleBtn" class="icone fa-solid fa-bars" style="color: #f1f1f1;" onclick="toggleMenu()"></i>
            <img src="imgs/logoTeste.png" alt="Logotipo do IFRS" id="imgLogo">
            <span class="greeting">Olá, <?php echo (isset($_SESSION["usuario"]) ? $_SESSION["usuario"]->getNome() : ''); ?>!</span>
        </div>
    </div>

    <div class="sidebar">
        <i class="fas fa-times close-btn icone2"  style="color: #44A64A;" onclick="toggleMenu()"></i>
        <ul class="menu">
            <li>
                <a href="views/pgInicial.php" onclick="toggleMenu()">Página Inicial</a>
            </li>
            <li>
                <a href="infosEstagio.php" onclick="toggleMenu()">Informações Gerais</a>
            </li>
            <li>
                <a href="alunos.php" onclick="toggleMenu()">Alunos</a>
            </li>
            <li>
                <a href="professores.php" onclick="toggleMenu()">Professores</a>
            </li>
            <li>
                <a href="notasEstagio.php" onclick="toggleMenu()">Notas</a>
            </li>
            <li>
                <a href="cursos.php" onclick="toggleMenu()">Cursos</a>
            </li>
            <li>
                <a href="areas.php" onclick="toggleMenu()">Áreas</a>
            </li>
            <li>
                <a href="cidades.php" onclick="toggleMenu()">Cidades</a>
            </li>
            <li>
                <a href="supervisores.php" onclick="toggleMenu()">Supervisores</a>
            </li>
            <li>
                <a href="representantes.php" onclick="toggleMenu()">Representantes</a>
            </li>
            <li>
                <a href="empresas.php" onclick="toggleMenu()">Empresas</a>
            </li>
            <li>
                <a href="documentos.php" onclick="toggleMenu()">Documentos</a>
            </li>
            <li>
                <a href="usuarios.php" onclick="toggleMenu()">Usuários</a>
            </li>
            <div class="sair">
                <li>
                    <a id="sairA" href="logout.php" onclick="toggleMenu()"><i class="fa-regular fa-circle-left sairI" style="color: #f0f0f0;"></i>Sair</a>
                </li>
            </div>
        </ul>

    </div>

    <script>
        function toggleMenu() {
            var sidebar = document.querySelector('.sidebar');
            sidebar.style.width = sidebar.style.width === '250px' ? '0' : '250px';
        }
    </script>
    
</body>
</html>
