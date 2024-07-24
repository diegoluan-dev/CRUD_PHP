<?php
// Conectar ao banco de dados
$conn = new mysqli('localhost', 'root', '', 'cadastro_db');
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verificar se o ID foi passado na URL ou no formulário
$id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : '');

if ($id) {
    // Buscar o registro com o ID fornecido se não for uma submissão do formulário
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        $sql = "SELECT id, nome, email, telefone FROM cadastros WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
            $email = $row['email'];
            $telefone = $row['telefone'];
        } else {
            echo "Registro não encontrado";
            exit();
        }
    }
    
    // Verificar se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        // Atualizar o registro
        $sql = "UPDATE cadastros SET nome='$nome', email='$email', telefone='$telefone' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            // Redirecionar para index.php após atualizar
            header("Location: index.php");
            exit();
        } else {
            echo "Erro ao atualizar o registro: " . $conn->error;
        }

        $conn->close();
    }
} else {
    echo "ID não fornecido";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar Cadastro</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Atualizar Cadastro</h2>
        <form method="POST" action="atualizar.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $nome; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" value="<?php echo $telefone; ?>" required>
            </div>
            <input type="submit" value="Atualizar" class="btn btn-primary">
        </form>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>