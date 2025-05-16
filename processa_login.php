<?php
session_start();
require_once 'database/conn.php';

$login = $_POST['login'];
$senha = $_POST['senha'];

$stmt = $conn->prepare("SELECT * FROM usuarios WHERE login = ?");
$stmt->execute([$login]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario && password_verify($senha, $usuario['senha'])) {
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['nome']       = $usuario['nome'];

    echo "<script>
            alert('Login efectuado com sucesso!');
            window.location.href='index.php';
          </script>";
} else {
    echo "<script>
            alert('Login ou senha inválidos!');
            window.location.href='login.php';
          </script>";
}
?>