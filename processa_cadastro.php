<?php
require_once 'database/conn.php';

$nome  = $_POST['nome'];
$login = $_POST['login'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO usuarios (nome, login, senha) VALUES (?, ?, ?)");
$stmt->execute([$nome, $login, $senha]);

// JS alerta + redirect
echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href='login.php';
      </script>";

?>