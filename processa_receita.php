<?php 

    session_start();
    require_once 'database/conn.php';

    $valor = $_POST['valor'];
    $fonte = $_POST['fonte'];
    $data = $_POST['data'];
    $usuario_id = $_SESSION['usuario_id'];
    
    // Verifica se o usuário está logado
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->execute([$usuario_id]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Insere a receita no banco de dados
        $stmt = $conn->prepare("INSERT INTO receitas (usuario_id, valor, fonte, data) VALUES (?, ?, ?, ?)");
        $stmt->execute([$usuario_id, $valor, $fonte, $data]);


        echo "<script>
                alert('Receita adicionada com sucesso!');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Usuário não encontrado!');
                window.location.href='login.php';
              </script>";
    }
    ?>