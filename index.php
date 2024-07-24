<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuários</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Cadastro de Usuários</h2>
        <form method="POST" action="cadastrar.php">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="text" id="telefone" name="telefone" class="form-control" required>
            </div>
            <input type="submit" value="Cadastrar" class="btn btn-primary">
        </form>
        
        <h2 class="mt-4">Usuários Cadastrados</h2>
        <table class="table table-striped table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conectar ao banco de dados
                $conn = new mysqli('localhost', 'root', '', 'cadastro_db');
                if ($conn->connect_error) {
                    die("Conexão falhou: " . $conn->connect_error);
                }

                // Buscar registros
                $sql = "SELECT id, nome, email, telefone FROM cadastros";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["id"]. "</td>
                                <td>" . $row["nome"]. "</td>
                                <td>" . $row["email"]. "</td>
                                <td>" . $row["telefone"]. "</td>
                                <td>
                                    <a href='atualizar.php?id=" . $row["id"] . "' class='btn btn-warning btn-sm'>Atualizar</a>
                                    <a href='excluir.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm'>Excluir</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum registro encontrado</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>