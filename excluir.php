<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'cadastro_db');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi enviado
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir registro da tabela
    $sql = "DELETE FROM cadastros WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro excluído com sucesso";
    } else {
        echo "Erro: " . $conn->error;
    }
}

$conn->close();
header('Location: index.php');
exit();
?>