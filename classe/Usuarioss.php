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

    public function CadastroADM($email, $password, $passwordConfirm, $nivel)
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

    //lista as consultas do cliente
    public function listarAgendamentos($id_cliente)
    {
        try {
            // Script para buscar agendamentos do cliente
            $script = "SELECT a.*, u.email, s.name AS servico_nome 
                       FROM agendamentos a
                       JOIN usuarios u ON u.id_usuario = a.id_cliente
                       LEFT JOIN servico s ON s.id_servico = a.servico
                       WHERE a.id_cliente = :id_cliente";
                       
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $preparo->execute();
    
            // Fetch all agendamentos
            $agendamentos = $preparo->fetchAll(PDO::FETCH_ASSOC);
    
            // Busque os serviços
            $scriptServicos = "SELECT * FROM servico";
            $preparoServicos = $this->UsuarioSenha->prepare($scriptServicos);
            $preparoServicos->execute();
            $servicos = $preparoServicos->fetchAll(PDO::FETCH_ASSOC);
    
            // Busque o email do cliente
            $email = null;
            if (!empty($agendamentos)) {
                $email = $agendamentos[0]['email'];
            }
    
            return [
                'agendamentos' => $agendamentos,
                'email' => $email,
                'servicos' => $servicos
            ];
        } catch (PDOException $erro) {
            return [
                'error' => "Erro ao listar agendamentos: " . $erro->getMessage()
            ];
        }
    }
    
    
    //deleta a consulta do cliente
    public function deletarAgendamento($id_agendamento)
{
    try {
        $script = "DELETE FROM agendamentos WHERE id_agendamento = :id_agendamento";
        $preparo = $this->UsuarioSenha->prepare($script);
        $preparo->bindParam(':id_agendamento', $id_agendamento, PDO::PARAM_INT);
        $preparo->execute();

        return $preparo->rowCount(); // Retorna o número de linhas afetadas
    } catch (PDOException $erro) {
        return "Erro ao deletar agendamento: " . $erro->getMessage();
    }
}



    // Função para editar usuario
    public function EditarUsuarios($id_para_alterar, $email, $nivel)
    {
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
    public function obterUsuarioPorId($id_usuario)
    {
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
    public function AtualizarUsuario($id_cliente, $nome, $cpf, $telefone, $contato, $sexo, $cep, $cidade, $complemento, $numero_residencia, $estado, $senha = null) {
        try {
            if ($senha) {
                $script = "UPDATE clientes SET nome = :nome, cpf = :cpf, telefone = :telefone, contato = :contato, sexo = :sexo, CEP = :cep, cidade = :cidade, complemento = :complemento, numero_residencia = :numero_residencia, estado = :estado, senha = :senha WHERE id_cliente = :id_cliente";
            } else {
                $script = "UPDATE clientes SET nome = :nome, cpf = :cpf, telefone = :telefone, contato = :contato, sexo = :sexo, CEP = :cep, cidade = :cidade, complemento = :complemento, numero_residencia = :numero_residencia, estado = :estado WHERE id_cliente = :id_cliente";
            }
    
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $preparo->bindParam(':nome', $nome, PDO::PARAM_STR);
            $preparo->bindParam(':cpf', $cpf, PDO::PARAM_STR);
            $preparo->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $preparo->bindParam(':contato', $contato, PDO::PARAM_STR);
            $preparo->bindParam(':sexo', $sexo, PDO::PARAM_STR);
            $preparo->bindParam(':cep', $cep, PDO::PARAM_STR);
            $preparo->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $preparo->bindParam(':complemento', $complemento, PDO::PARAM_STR);
            $preparo->bindParam(':numero_residencia', $numero_residencia, PDO::PARAM_INT);
            $preparo->bindParam(':estado', $estado, PDO::PARAM_STR);
            
            if ($senha) {
                $preparo->bindParam(':senha', $senha, PDO::PARAM_STR);
            }
    
            return $preparo->execute();
        } catch (PDOException $erro) {
            return "Erro ao atualizar usuário: " . $erro->getMessage();
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
