<?php

namespace Model;

use Model\VO\UsuarioVO;
use Util\Database;

final class UsuarioModel extends Model {

    public function selectAll($vo = null) {
        $db = new Database();
        $data = $db->select("SELECT * FROM usuarios ORDER BY id ASC");

        $array = [];

        foreach($data as $row){
            $vo = new UsuarioVO($row["id"], $row["nome"], $row["login"], $row["senha"], $row["tipoUsuario"]);
            array_push($array, $vo);
        }

        return $array;
    }

    public function selectOne($vo = null) { 
        $db = new Database();

        $query = "SELECT * FROM usuarios where id = :id";
        $binds = [":id" => $vo->getId()]; 
        $data = $db->select($query, $binds);

        if(count($data) == 0 ) {
            return null;
        }

        return new UsuarioVO($data[0]["id"], $data[0]["nome"], $data[0]["login"], $data[0]["senha"], $data[0]["tipoUsuario"]); // [0] = chave primária 0
    }

    public function insert($vo) {
        $db = new Database();
        $query = "INSERT INTO usuarios (nome, login, senha, tipousuario) VALUES (:nome, :login, :senha, :tipoUsuario)";
        $binds = [":nome" => $vo->getNome(), ":login" =>$vo->getLogin(), ":senha" => sha1($vo->getSenha()), ":tipoUsuario" =>$vo->getTipoUsuario()]; // sha1 -> criptografar as senhas

        $success = $db->execute($query, $binds);

        if($success) {
            return $db->getLastInsertedId();
        } else {
            return null;
        }
    }

    public function update($vo) {   
        $db = new Database();
        $binds = [
            ":nome" => $vo->getNome(),
            ":login" => $vo->getLogin(),
            ":tipoUsuario" => $vo->getTipoUsuario(),
            ":id" => $vo->getId()
        ];

        if(empty($vo->getSenha())){ //verificando se a senha está vazia; é pq ele não digitou/editou a senha na edição
            $query = "UPDATE usuarios SET nome = :nome, login = :login, tipoUsuario = :tipoUsuario WHERE id = :id";
        } else{
            $query = "UPDATE usuarios SET nome = :nome, login = :login, senha = :senha, tipoUsuario = :tipoUsuario WHERE id = :id";
            $binds["senha"] = sha1($vo->getSenha());
        }

        return $db->execute($query, $binds);
    }

    public function delete($vo) {
        $db = new Database(); 
        $query = "DELETE FROM usuarios WHERE id = :id";
        $binds = [
            ":id" => $vo->getId()
        ];

        return $db->execute($query, $binds);
    }

    public function doLogin($vo){
        $db = new Database();
        $query = "SELECT * FROM usuarios WHERE login = :login";
        $binds = [":login" => $vo->getLogin()];
    
        $data = $db->select($query, $binds);
    
        if(count($data) == 0){
            return false; // Usuário não encontrado
        }
    
        // Itera sobre os resultados e verifica a senha
        foreach ($data as $row) {
            if (sha1($vo->getSenha()) === $row["senha"]) {
                $usuario = new UsuarioVO($row["id"], $row["nome"], $row["login"], $row["senha"], $row["tipoUsuario"]);
    
                $_SESSION["usuario"] = $usuario;
    
                return true; // Credenciais corretas
            }
        }
    
        return false; // Senha incorreta
    }
    
    public function checkLogin(){
        if(empty($_SESSION["usuario"])){
            return false;
        } 

        $tipo = $_SESSION["usuario"]->getTipoUsuario();
        $paginaAtual = explode("/", $_SERVER["REQUEST_URI"]);
        $paginaAtual = array_reverse($paginaAtual);
        $arrPaginaSemId = explode("?", $paginaAtual[0]);
        $paginaSemId = $arrPaginaSemId[0];
        $permissoes = [
            "Administrador" => ["pgInicial.php", "empresas.php", "empresa.php", "salvarEmpresa.php", "excluirEmpresa.php", "supervisores.php", "supervisor.php", "salvarSupervisor.php", "excluirSupervisor.php", "representantes.php", "representante.php", "salvarRepresentante.php", "excluirRepresentante.php", "infosEstagio.php", "infoEstagio.php", "salvarInfoEstagio.php", "excluirInfoEstagio.php", "documentos.php", "documento.php", "salvarDocumento.php", "excluirDocumento.php", "alunos.php", "aluno.php", "salvarAluno.php", "excluirAluno.php", "area.php", "areas.php", "salvarArea.php", "excluirArea.php", "cidades.php", "cidade.php", "salvarCidade.php", "excluirCidade.php", "cursos.php", "curso.php", "salvarCurso.php", "excluirCurso.php", "professor.php", "professores.php", "salvarProfessor.php", "excluirProfessor.php", "usuario.php", "usuarios.php", "salvarUsuario.php", "excluirUsuario.php", "notasEstagio.php", "notaEstagio.php", "salvarNotaEstagio.php", "excluirNotaEstagio.php"],
            "Empresa" => ["pgInicial.php", "empresas.php", "supervisores.php", "supervisor.php", "salvarSupervisor.php", "excluirSupervisor.php", "representantes.php", "representante.php", "salvarRepresentante.php", "excluirRepresentante.php", "infosEstagio.php", "documentos.php", "documento.php", "salvarDocumento.php", "excluirDocumento.php", "alunos.php"],
            "Estagiário" => ["pgInicial.php", "empresas.php", "supervisores.php", "representantes.php", "professores.php", "documentos.php", "documento.php", "salvarDocumento.php", "excluirDocumento.php"]
        ];

        $permissoesDoUsuario = $permissoes[$_SESSION["usuario"]->getTipoUsuario()];
        
        if (!in_array($paginaSemId, $permissoesDoUsuario)) {
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>';
            echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>';
            echo '<style>';
            echo 'body {
                font-family: "Century Gothic", Arial, Helvetica, sans-serif;
                background-color: #f1f1f1;
            }';
            echo '</style>';
            echo '<script>
                    $(document).ready(function(){
                        Swal.fire({
                            icon: "error",
                            title: "Ocorreu um erro",
                            text: "Você não tem permissão para acessar esta página! Entre em contato com algum administrador.",
                            confirmButtonText: "Voltar",
                            confirmButtonColor: "#F27474",
                        }).then(function() {
                            window.location.href = "views/pgInicial.php";
                        });
                    });
                  </script>';
            exit();
        }

        return true;
    }

    public function logout(){
        $_SESSION["usuario"] = null;
    }
}