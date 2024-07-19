<?php
class Usuarios
{
    private $host = '62.72.62.1';
    private $dbname = 'u687609827_edilson';
    private $username = 'u687609827_edilson';
    private $passwordbd = '>2Ana=]b';
    private $UsuarioSenha;

    public function __construct()
    {
        $this->UsuarioSenha = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->passwordbd);
        $this->UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Função para cadastrar um novo usuário
    public function CadastroUsuario($email, $password, $passwordConfirm)
    {
        try {
            if (empty($email)) {
                return "Usuário não informado";
            }
            if (empty($password)) {
                return "Senha não informada";
            }
            if ($password != $passwordConfirm) {
                return "Senhas não são iguais";
            }

            // Verifica se o usuário já existe
            $select = "SELECT * FROM usuarios WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($select);
            $preparo->bindParam(':email', $email);
            $preparo->execute();
            $resultado = $preparo->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                return "Usuário já existe";
            }

            // Hash da senha para criptografar
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Inserção do novo usuário
            $insert = "INSERT INTO usuarios (email, senha) VALUES (:email, :senha)";
            $preparo = $this->UsuarioSenha->prepare($insert);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->execute();

            return "Usuário cadastrado com sucesso";
        } catch (PDOException $erro) {
            return "Erro ao tentar cadastrar: " . $erro->getMessage();
        }
    }
    public function Usuarios($id_cliente)
    {
        try {
            $script = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_cliente', $id_cliente);
            $preparo->execute();
            return $preparo->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            return "Erro ao listar usuário: " . $erro->getMessage();
        }
    }
    // Função para listar usuários
    public function listarUsuarios($id_cliente = null)
    {
        try {
            $script = "SELECT * FROM usuarios";
            if ($id_cliente !== null) {
                $script .= " WHERE id_usuario = :id_usuario";
            }
            $preparo = $this->UsuarioSenha->prepare($script);
            if ($id_cliente !== null) {
                $preparo->bindParam(':id_usuario', $id_cliente);
            }
            $preparo->execute();

            return $preparo->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            return "Erro ao listar usuários: " . $erro->getMessage();
        }
    }

    // Função para listar clientes
    public function listarClientes($id_cliente = null)
    {
        try {
            $script = "SELECT * FROM clientes";
            if ($id_cliente !== null) {
                $script .= " WHERE id_cliente = :id_cliente";
            }
            $preparo = $this->UsuarioSenha->prepare($script);
            if ($id_cliente !== null) {
                $preparo->bindParam(':id_cliente', $id_cliente);
            }
            $preparo->execute();

            return $preparo->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            return "Erro ao listar clientes: " . $erro->getMessage();
        }
    }
    // Função para listar um pet pelo ID do cliente
    public function listarPet($id_cliente)
    {
        try {

            // Tenta atualizar o cliente
            $script = "UPDATE clientes SET email = :email, senha = :senha WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->bindParam(':id_cliente', $id_cliente);
            $preparo->execute();

            if ($preparo->rowCount() === 0) {
                // Se não encontrar, tenta atualizar o usuário
                $script = "UPDATE usuarios SET email = :email, senha = :senha WHERE id_usuario = :id_usuario";
                $preparo = $this->UsuarioSenha->prepare($script);
                $preparo->bindParam(':email', $email);
                $preparo->bindParam(':senha', $passwordHash);
                $preparo->bindParam(':id_usuario', $id);
                $preparo->execute();
            }

            return "Informações alteradas com sucesso";
        } catch (PDOException $erro) {
            return "Informações não alteradas <br>" . $erro->getMessage();
        }
    }

    // Função para atualizar um usuário ou cliente
    public function atualizarUsuario($id, $email, $password, $passwordConfirm)
    {
        try {
            if (empty($email)) {
                return "Usuário não informado";
            }
            if (empty($password)) {
                return "Senha não informada";
            }
            if ($password != $passwordConfirm) {
                return "Senhas não são iguais";
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Atualiza cliente se existir
            $script = "UPDATE clientes SET email = :email, senha = :senha WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->bindParam(':id_cliente', $id);
            $preparo->execute();

            if ($preparo->rowCount() === 0) {
                // Se não encontrar, atualiza usuário
                $script = "UPDATE usuarios SET email = :email, senha = :senha WHERE id_usuario = :id_usuario";
                $preparo = $this->UsuarioSenha->prepare($script);
                $preparo->bindParam(':email', $email);
                $preparo->bindParam(':senha', $passwordHash);
                $preparo->bindParam(':id_usuario', $id);
                $preparo->execute();
            }

            return "Informações alteradas com sucesso";
        } catch (PDOException $erro) {
            return "Informações não alteradas: " . $erro->getMessage();
        }
    }

    // Função para deletar um usuário
    public function deletarUsuario($id_usuario)
    {
        try {
            $script = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->execute([
                ":id_usuario" => $id_usuario
            ]);

            return $preparo->rowCount();
        } catch (PDOException $erro) {
            return "Erro ao deletar usuário: " . $erro->getMessage();
        }
    }

    // Função para deletar um cliente
    public function deletarCliente($id_cliente)
    {
        try {
            $script = "DELETE FROM clientes WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->execute([
                ":id_cliente" => $id_cliente
            ]);

            return $preparo->rowCount();
        } catch (PDOException $erro) {
            return "Erro ao deletar cliente: " . $erro->getMessage();
        }
    }
}
