<?php
require_once 'config.php'; 
require_once '../classe/Usuarios.php';

// Crie uma instância da classe Usuarios
$usuario = new Usuarios();

// Obtenha os dados do formulário
$id_cliente = $_POST['id_cliente'];
$nomePet = $_POST['nomePet'];
$especiePet = $_POST['especie']; // Corrija para o nome do campo correto
$dataNascimento = $_POST['data_nascimento'];
$racaPet = $_POST['raca'];
$pesoPet = $_POST['peso'];
$sexoPet = $_POST['sexop'];
$porte = $_POST['porte'];

// Verifique se $especiePet é um ID válido
if (!is_numeric($especiePet)) {
    die('Erro: Espécie inválida.');
}

try {
    // Tenta inserir o novo pet
    $sql = "INSERT INTO pets (id_cliente, nomep, especie, data_nascimento, raca, peso, sexop, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $UsuarioSenha->prepare($sql);
    $stmt->execute([$id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte]);
    header('Location: ../perfil.php');
    exit;
} catch (PDOException $e) {
    // Se o insert falhar, tenta atualizar o pet
    if ($e->getCode() === '23000') { // Erro de violação de chave estrangeira
        try {
            // Tenta atualizar o pet existente
            $sql = "UPDATE pets SET id_cliente = ?, nomep = ?, especie = ?, data_nascimento = ?, raca = ?, peso = ?, sexop = ?, porte = ? WHERE id_cliente = ? AND nomep = ?";
            $stmt = $UsuarioSenha->prepare($sql);
            $stmt->execute([$id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte, $id_cliente, $nomePet]);
            header('Location: ../perfil.php');
            exit;
        } catch (PDOException $e) {
            echo "Erro ao atualizar o pet: " . $e->getMessage();
        }
    } else {
        echo "Erro ao cadastrar o pet: " . $e->getMessage();
    }
}
?>
