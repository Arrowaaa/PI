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
       
    }

    // Função para cadastrar um novo usuário
    public function CadastroCliente($email, $password, $passwordConfirm)
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
            $select = "SELECT * FROM clientes WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($select);
            $preparo->bindParam(':email', $email);
            $preparo->execute();
            $resultado = $preparo->fetch();

            if ($resultado) {
                return "Usuário já existe";
            }

            // Hash da senha para criptografar
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Inserção do novo usuário
            $insert = "INSERT INTO clientes (email, senha, nivel) VALUES (:email, :senha, 'base')";
            $preparo = $this->UsuarioSenha->prepare($insert);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->execute();

            return "Usuário cadastrado com sucesso";
        } catch (PDOException $erro) {
            return "Erro ao tentar cadastrar: " . $erro->getMessage();
        }
    }

    public function CadastroADM($email, $password, $passwordConfirm,$nivel)
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
            if (empty($nivel)) {
                return "Nivel não informado";
            }
            $select = "SELECT * FROM usuarios WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($select);
            $preparo->bindParam(':email', $email);
            $preparo->execute();
            $resultado = $preparo->fetch();

            if ($resultado) {
                return "Usuário já existe";
            }
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $insert = "INSERT INTO usuarios (email, senha, nivel) VALUES (:email, :senha, :nivel)";
            $preparo = $this->UsuarioSenha->prepare($insert);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->bindParam(':nivel', $nivel);
            $preparo->execute();

            return "Usuário cadastrado com sucesso";
        } catch (PDOException $erro) {
            return "Erro ao tentar cadastrar: " . $erro->getMessage();
        }
    }

    public function CadastroPet($id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte)
    {
        try {
            $sql = "INSERT INTO pets (id_cliente, nomep, especie, data_nascimento, raca, peso, sexop, porte) 
                    VALUES (:id_cliente, :nomep, :especie, :data_nascimento, :raca, :peso, :sexop, :porte)";
            $stmt = $this->UsuarioSenha->prepare($sql);
            $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $stmt->bindParam(':nomep', $nomePet, PDO::PARAM_STR);
            $stmt->bindParam(':especie', $especiePet, PDO::PARAM_INT);
            $stmt->bindParam(':data_nascimento', $dataNascimento, PDO::PARAM_STR);
            $stmt->bindParam(':raca', $racaPet, PDO::PARAM_STR);
            $stmt->bindParam(':peso', $pesoPet, PDO::PARAM_STR);
            $stmt->bindParam(':sexop', $sexoPet, PDO::PARAM_STR);
            $stmt->bindParam(':porte', $porte, PDO::PARAM_STR);
            
            $stmt->execute();
            
            // Obter o último ID inserido
            $lastInsertId = $this->UsuarioSenha->lastInsertId();
            
            return $lastInsertId;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    
    public function Usuarios($id_cliente)
    {
        try {
            $script = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_cliente', $id_cliente);
            $preparo->execute();
            return $preparo->fetch();
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

            return $preparo->fetchAll();
        } catch (PDOException $erro) {
            return "Erro ao listar usuários: " . $erro->getMessage();
        }
    }

    public function listarAgendamentos($id_cliente) {
        try {
            // Consulta para obter agendamentos
            $scriptAgendamentos = "
                SELECT 
                    id_agendamento,
                    data_agendamento,
                    hora_agendamento,
                    servico
                FROM 
                    agendamentos
                WHERE 
                    id_cliente = :id_cliente";
                    
            $preparoAgendamentos = $this->UsuarioSenha->prepare($scriptAgendamentos);
            $preparoAgendamentos->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $preparoAgendamentos->execute();
            
            $agendamentos = $preparoAgendamentos->fetchAll(PDO::FETCH_ASSOC);
            
            // Consulta para obter e-mail do cliente
            $scriptEmail = "
                SELECT 
                    email
                FROM 
                    clientes
                WHERE 
                    id_cliente = :id_cliente";
                    
            $preparoEmail = $this->UsuarioSenha->prepare($scriptEmail);
            $preparoEmail->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $preparoEmail->execute();
            
            $email = $preparoEmail->fetchColumn();
            
            // Consulta para obter serviços
            $scriptServicos = "
                SELECT 
                    id_servico,
                    name
                FROM 
                    servico";
                    
            $preparoServicos = $this->UsuarioSenha->prepare($scriptServicos);
            $preparoServicos->execute();
            
            $servicos = $preparoServicos->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'agendamentos' => $agendamentos,
                'email' => $email,
                'servicos' => $servicos
            ];
            
        } catch (PDOException $erro) {
            echo "Erro ao listar dados: " . $erro->getMessage();
            return [];
        }
    }
    

    // Função para editar usuario
    public function EditarUsuarios($id_para_alterar, $email, $nivel) {
        try {
            $script = "UPDATE clientes SET email = :email, nivel = :nivel WHERE id_usuario = :id_para_alterar";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':nivel', $nivel);
            $preparo->bindParam(':id_para_alterar', $id_para_alterar);
            return $preparo->execute();
        } catch (PDOException $erro) {
            return "Erro ao atualizar usuário: " . $erro->getMessage();
        }
    }
    // Função para obter informação do usuario pelo id
    public function obterUsuarioPorId($id_usuario) {
        try {
            $script = "SELECT * FROM clientes WHERE id_usuario = :id_usuario";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_usuario', $id_usuario);
            $preparo->execute();
            return $preparo->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            return "Erro ao obter dados do usuário: " . $erro->getMessage();
        }
    }
    
    
     // Função para listar pets associados a um cliente
     public function listarPet($id_cliente)
     {
         try {
             $script = "SELECT * FROM pets WHERE id_cliente = :id_cliente";
             $preparo = $this->UsuarioSenha->prepare($script);
             $preparo->bindParam(':id_cliente', $id_cliente);
             $preparo->execute();
             return $preparo->fetchAll(PDO::FETCH_ASSOC);
         } catch (PDOException $erro) {
             return "Erro ao listar pets: " . $erro->getMessage();
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
}
