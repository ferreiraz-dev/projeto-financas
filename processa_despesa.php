<?php 

session_start();
require_once 'database/conn.php';

$valor = $_POST['valor'];
$categoria = $_POST['categoria'];
$descricao = $_POST['descricao'];
$data = $_POST['data'];
$usuario_id = $_SESSION['usuario_id'];

    // Verifica se o usuário está logado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Insere a despesa no banco de dados
    if ($usuario) {
        $stmt = $conn->prepare("INSERT INTO despesas (usuario_id, valor, categoria, descricao, data) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$usuario_id, $valor, $categoria, $descricao, $data]);

        echo "<script>
                alert('Despesa adicionada com sucesso!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Usuário não encontrado!');
                window.location.href='login.php';
              </script>";
    }
?>