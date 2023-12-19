<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/pgInicial.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Página Inicial</title>
</head>
<body>

    <?php
        require_once("../vendor/autoload.php");
        session_start();
    ?>

    <div class="sair">
        <a class="sairA" href="../logout.php"><i class="fa-regular fa-circle-left sairI" style="color: #f0f0f0;"></i>  Sair</a>
    </div>

    <div class="container">
        <div class="alinha-textos">
            <h1>SEÇÃO DE ESTÁGIOS</h1>
            
            <hr>

            <div class="texto">
                <p id='defTam'>Bem-vindo(a) ao portal de estágios do IFRS - <i>Campus</i> Bento Gonçalves, <b><?php echo (isset($_SESSION["usuario"]) ? $_SESSION["usuario"]->getNome() : ''); ?></b>!</p>
                <p>Aqui, abrimos as portas para que as oportunidades se transformem em experiências incríveis. Cada desafio é uma chance de crescimento, tanto pessoal quanto profissional. Não estamos apenas conectando estudantes a estágios; estamos construindo trampolins para o sucesso e a realização. Vamos embarcar juntos nessa jornada de descobertas e conquistas!</p>
            </div>
        </div>

        <div class="img">
            <img src="../imgs/download.png">
        </div>
    </div>

    <div class="cards-container">
        <a class="card" href="../infosEstagio.php">
            INFORMAÇÕES GERAIS
        </a>

        <a class="card" href="../alunos.php">
            ALUNOS
        </a>

        <a class="card" href="../professores.php">
            PROFESSORES
        </a>

        <a class="card" href="../notasEstagio.php">
            NOTAS
        </a>

        <a class="card" href="../cursos.php">
            CURSOS
        </a>

        <a class="card" href="../areas.php">
            ÁREAS
        </a>

        <a class="card" href="../cidades.php">
            CIDADES
        </a>

        <a class="card" href="../supervisores.php">
            SUPERVISORES

        <a class="card" href="../representantes.php">
            REPRESENTANTES
        </a>

        <a class="card" href="../empresas.php">
            EMPRESAS
        </a>

        <a class="card" href="../documentos.php">
            DOCUMENTOS
        </a>

        <a class="card" href="../usuarios.php">
            USUÁRIOS
        </a>
    </div>

</body>
</html>