<?php
class Usuarios
{
    public function CadastroUsuario($user, $password, $passwordConfirm)
    {
        $host = '62.72.62.1';
        $dbname = 'u687609827_edilson';
        $username = 'u687609827_edilson';
        $passwordbd = '>2Ana=]b';

        try {
            if (empty($user)) {
                return "<br>Usuário não informado";
            }

            if (empty($password)) {
                return "<br>Senha não informada";
            }

            if ($password != $passwordConfirm) {
                return "<br>Senhas não são iguais";
            }

            $UsuarioSenha = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordbd);
            $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $select = "SELECT * FROM usuarios WHERE usuario = :usuario";
            $preparo = $UsuarioSenha->prepare($select);
            $preparo->bindParam(':usuario', $user);
            $preparo->execute();
            $resultado = $preparo->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return "<br>Usuário já existe";
                
            }
            
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            
            $insert = "INSERT INTO usuarios (usuario, senha) VALUES (:usuario, :senha)";
            $preparo = $UsuarioSenha->prepare($insert);
            $preparo->bindParam(':usuario', $user);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->execute();

            return "Usuário cadastrado com sucesso";

        } catch (PDOException $erro) {
            return "Erro ao tentar cadastrar: " . $erro->getMessage();
        }
    }

    public function listar1Usuarios($id_usuario)
    {
        $host = '62.72.62.1';
        $dbname = 'u687609827_edilson';
        $username = 'u687609827_edilson';
        $password = '>2Ana=]b';

        $UsuarioSenha = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $script = "SELECT * FROM usuario WHERE id = " . $id_usuario;

        $lista = $UsuarioSenha->query($script)->fetch();

        return $lista;
    }

    public function AtualizarUsuario($id_alterar, $user, $password, $passwordConfirm)
    {
        try {

            $host = '62.72.62.1';
            $dbname = 'u687609827_edilson';
            $username = 'u687609827_edilson';
            $passwordbd = '>2Ana=]b';

            if (empty($user)) {
                return "<br>Usuário não informado";
            }

            if (empty($password)) {
                return "<br>Senha não informada";
            }

            if ($password != $passwordConfirm) {
                return "<br>Senhas não são iguais";
            }

            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $passwordbd);


            $script = "UPDATE usuarios SET usuario = :usuario, senha = :senha WHERE id = :id_usuario";
            $preparo = $conn->prepare($script);


            $valores = [
                ':usuario' => $user,
                ':senha' => $password,
                ':id' => $id_alterar
            ];


            $preparo->execute($valores);

            return "Informações alteradas com sucesso" . $id_alterar;
        } catch (PDOException $erro) {
            return "Informações não alteradas <br>" . $erro->getMessage();
        }
    }
}
