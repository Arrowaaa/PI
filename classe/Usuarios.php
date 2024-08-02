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
        try {
            // Inicializa a conexão PDO
            $this->UsuarioSenha = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->passwordbd);
            $this->UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }
    // Função para obter informação do usuario pelo id
    public function obterUsuarioPorId($id_cliente)
    {
        try {
            $script = "SELECT * FROM clientes WHERE id_cliente = :id_cliente";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_cliente', $id_cliente);
            $preparo->execute();
            return $preparo->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao obter cliente: " . $erro->getMessage() . "');</script>";
            return "Erro ao obter cliente: " . $erro->getMessage();
        }
    }

    // Função para listar usuários
    public function listarUsuarios($id_cliente = null)
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
            return $preparo->fetchAll();
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao listar usuários: " . $erro->getMessage() . "');</script>";
            return "Erro ao listar usuários: " . $erro->getMessage();
        }
    }

    // Função para usuários
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

    public function obterUsuarioPorEmail($email)
    {
        try {
            $script = "SELECT * FROM clientes WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':email', $email);
            $preparo->execute();
            return $preparo->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao obter cliente: " . $erro->getMessage() . "');</script>";
            return "Erro ao obter cliente: " . $erro->getMessage();
        }
    }

    // Função para cadastrar um novo cliente
    public function CadastroCliente($email, $cpf, $password, $passwordConfirm)
    {
        try {
            if (empty($email)) {
                return "Usuário não informado";
            }
            if (empty($cpf)) {
                return "CPF não informado";
            }
            if (empty($password)) {
                return "Senha não informada";
            }
            if ($password != $passwordConfirm) {
                return "Senhas não são iguais";
            }

            // Verifica se o cliente já existe
            $select = "SELECT * FROM clientes WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($select);
            $preparo->bindParam(':email', $email);
            $preparo->execute();
            $resultado = $preparo->fetch();

            if ($resultado) {
                echo "<script>alert('Usuário já existe!.');</script>";
                return "Usuário já existe";
            }

            // Hash da senha para criptografar
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            // Inserção do novo cliente
            $insert = "INSERT INTO clientes (email, cpf, senha, nivel) VALUES (:email, :cpf, :senha, 'base')";
            $preparo = $this->UsuarioSenha->prepare($insert);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':cpf', $cpf);
            $preparo->bindParam(':senha', $passwordHash);
            $preparo->execute();

            echo '<p class="alert alert-success">Cliente cadastrado com sucesso!!!</p>';
            echo '<script>setTimeout(function() { window.location.href = "../login.php"; }, 1800);</script>';
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao tentar cadastrar: " . $erro->getMessage() . "');</script>";
            return "Erro ao tentar cadastrar: " . $erro->getMessage();
        }
    }

    // Função para editar Cliente/Usuario
    public function EditarUsuarios($email, $cpf, $nivel)
    {
        try {
            // Atualizando o nível do usuário na tabela clientes
            $script = "UPDATE clientes SET cpf = :cpf, nivel = :nivel WHERE email = :email";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':email', $email);
            $preparo->bindParam(':cpf', $cpf);
            $preparo->bindParam(':nivel', $nivel);
            $resultado = $preparo->execute();

            // Atualizando o e-mail na tabela usuarios se for necessário
            // O e-mail não é atualizado nesse código, se precisar dessa atualização adicione conforme necessário
            return $resultado;
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao atualizar usuário: " . $erro->getMessage() . "');</script>";
            return "Erro ao atualizar usuário: " . $erro->getMessage();
        }
    }

    // Função para atualizar cliente
    public function AtualizarUsuario($id_cliente, $nome, $cpf, $telefone, $contato, $sexo, $cep, $cidade, $complemento, $numero_residencia, $estado, $senha = null)
    {
        try {
            if ($id_cliente) {
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

            if ($preparo->execute()) {
                echo "<script>alert('Usuário atualizado com sucesso!!');</script>";
                return "Usuário atualizado com sucesso!";
            } else {
                echo "<script>alert('Erro ao atualizar usuário.');</script>";
                return "Erro ao atualizar usuário.";
            }
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao atualizar usuário: " . $erro->getMessage() . "');</script>";
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
            echo "<script>alert('Erro ao deletar usuário: " . $erro->getMessage() . "');</script>";
            return "Erro ao deletar usuário: " . $erro->getMessage();
        }
    }

    //lista as consultas do cliente
    public function listarAgendamentos($id_cliente)
    {
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

    //deleta a consulta do cliente
    public function deletarAgendamento($id_agendamento)
    {
        try {
            $script = "DELETE FROM agendamentos WHERE id_agendamento = :id_agendamento";
            $preparo = $this->UsuarioSenha->prepare($script);
            $preparo->bindParam(':id_agendamento', $id_agendamento, PDO::PARAM_INT);
            $preparo->execute();

            if ($preparo->rowCount() > 0) {
                echo "<script>alert('Agendamento deletado com sucesso.');</script>";
            } else {
                echo "<script>alert('Nenhum agendamento encontrado para deletar.');</script>";
            }

            return $preparo->rowCount(); // Retorna o número de linhas afetadas
        } catch (PDOException $erro) {
            echo "<script>alert('Erro ao deletar agendamento: " . $erro->getMessage() . "');</script>";
            return "Erro ao deletar agendamento: " . $erro->getMessage();
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
            echo "<script>alert('Erro ao listar pets: " . $erro->getMessage() . "');</script>";
            return "Erro ao listar pets: " . $erro->getMessage();
        }
    }

    // Função para cadastrar pets do cliente
    public function CadastroPet($nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte)
    {
        try {
            $preparo = $this->UsuarioSenha->prepare("INSERT INTO pets ( nomep, especie, data_nascimento, raca, peso, sexop, porte) VALUES ( ?, ?, ?, ?, ?, ?, ?)");
            $preparo->execute([$nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte]);
            return true;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    // Função para atualizar pet do cliente
    public function AtualizarPet($id_pet, $id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte)
    {
        try {
            $sql = "UPDATE pets SET 
                        id_cliente = :id_cliente, 
                        nomep = :nomep, 
                        especie = :especie, 
                        data_nascimento = :data_nascimento, 
                        raca = :raca, 
                        peso = :peso, 
                        sexop = :sexop, 
                        porte = :porte 
                    WHERE id_pet = :id_pet";

            $preparo = $this->UsuarioSenha->prepare($sql);
            $preparo->bindParam(':id_pet', $id_pet, PDO::PARAM_INT);
            $preparo->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
            $preparo->bindParam(':nomep', $nomePet, PDO::PARAM_STR);
            $preparo->bindParam(':especie', $especiePet, PDO::PARAM_INT);
            $preparo->bindParam(':data_nascimento', $dataNascimento, PDO::PARAM_STR);
            $preparo->bindParam(':raca', $racaPet, PDO::PARAM_STR);
            $preparo->bindParam(':peso', $pesoPet, PDO::PARAM_STR);
            $preparo->bindParam(':sexop', $sexoPet, PDO::PARAM_STR);
            $preparo->bindParam(':porte', $porte, PDO::PARAM_STR);

            if ($preparo->execute()) {
                echo "<script>alert('Pet atualizado com sucesso!');</script>";
                return "Pet atualizado com sucesso!";
            } else {
                echo "<script>alert('Erro ao atualizar pet.');</script>";
                return "Erro ao atualizar pet.";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Erro ao deletar agendamento: " . $e->getMessage() . "');</script>";
            return "Erro ao atualizar pet: " . $e->getMessage();
        }
    }
}
