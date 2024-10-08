<?php
require_once 'config.php';
require_once '../classe/Usuarios.php';

$usuario = new Usuarios($UsuarioSenha);


$id_cliente = $_POST['id_cliente'];
$nomePet = $_POST['nomep'];
$especiePet = $_POST['especie'];
$dataNascimento = $_POST['data_nascimento'];
$racaPet = $_POST['raca'];
$pesoPet = $_POST['peso'];
$sexoPet = $_POST['sexop'];
$porte = $_POST['porte'];

if (!is_numeric($especiePet)) {
    die('Erro: Espécie inválida.');
}

try {
    // Tenta inserir o novo pet
    $sql = "INSERT INTO pets (id_cliente, nomep, especie, data_nascimento, raca, peso, sexop, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $UsuarioSenha->prepare($sql);
    $stmt->execute([$id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte]);
    echo "<script>alert('Pet Cadastrado Com Sucesso!!');</script>";
    echo '<script>setTimeout(function() { window.location.href = "../perfil.php"; },);</script>'; 
    exit;
} catch (PDOException $e) {
    // Se o insert falhar, tenta atualizar o pet
    if ($e->getCode() === '23000') { // Erro de violação de chave estrangeira
        try {
            // Tenta atualizar o pet existente
            $sql = "UPDATE pets SET id_cliente = ?, nomep = ?, especie = ?, data_nascimento = ?, raca = ?, peso = ?, sexop = ?, porte = ? WHERE id_cliente = ? AND nomep = ?";
            $stmt = $UsuarioSenha->prepare($sql);
            $stmt->execute([$id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte, $id_cliente, $nomePet]);
            echo "<script>alert('Pet Cadastrado Com Sucesso!!');</script>";
            echo '<script>setTimeout(function() { window.location.href = "../perfil.php"; },);</script>';
            exit;
        } catch (PDOException $e) {
            echo "Erro ao atualizar o pet: " . $e->getMessage();
        }
    } else {
        echo "Erro ao cadastrar o pet: " . $e->getMessage();
    }
}
