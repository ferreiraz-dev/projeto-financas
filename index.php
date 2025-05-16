<?php
session_start();
require_once 'database/conn.php';

// 1. Verifica login
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}
$userId = $_SESSION['usuario_id'];

// Busca os dados do usuário para usar no cabeçalho
$stmt = $conn->prepare("SELECT nome FROM usuarios WHERE id = ?");
$stmt->execute([$userId]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Caso queira garantir que encontrou algo:
if (!$usuario) {
    // usuário não existe — força logout
    session_destroy();
    header('Location: login.php');
    exit;
}


// 2. Total de receitas
$stmt = $conn->prepare("
    SELECT COALESCE(SUM(valor), 0) AS total_receitas 
    FROM receitas 
    WHERE usuario_id = ?
");
$stmt->execute([$userId]);
$totalReceitas = $stmt->fetchColumn();

// 3. Total de despesas
$stmt = $conn->prepare("
    SELECT COALESCE(SUM(valor), 0) AS total_despesas 
    FROM despesas 
    WHERE usuario_id = ?
");
$stmt->execute([$userId]);
$totalDespesas = $stmt->fetchColumn();

// 4. Saldo atual
$saldo = $totalReceitas - $totalDespesas;

// 5. Listagem de transações (receitas + despesas)
$stmt = $conn->prepare("
    SELECT valor, fonte AS descricao, data, 'Receita' AS tipo
    FROM receitas
    WHERE usuario_id = ?
    UNION ALL
    SELECT valor, descricao, data, 'Despesa'
    FROM despesas
    WHERE usuario_id = ?
    ORDER BY data DESC
");
$stmt->execute([$userId, $userId]);
$transacoes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Financeiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 2rem;
    }

    .card {
        display: inline-block;
        width: 30%;
        padding: 1rem;
        margin-right: 1%;
        background: #f5f5f5;
        border-radius: 8px;
    }

    .login a {
        text-decoration: none;
        color: #007BFF;
    }

    .login a:hover {
        color: rgb(41, 108, 180);
    }

    .valores a {
        text-decoration: none;
        color: #333;
        padding: 0.5rem;
        border: 1px solid #f5f5f5;
        border-radius: 4px;
        background: #f5f5f5;
    }

    .valores a:hover {
        color: rgb(60, 127, 199);
        background: #ddd;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 0.5rem;
        text-align: left;
    }

    th {
        background: #eee;
    }

    @media (max-width: 1560px) {

        body {
            margin: 0;
        }

        .cards {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .card {
            margin-bottom: 10px;
            width: 80%;

        }

        .valores {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .valores .receita {
            margin-bottom: 10px;
        }

        .table {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .table table {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 545px) {
        .card {
            align-items: center;
            padding: 0;
            width: 70%;
            margin-right: 0;
            margin-bottom: 1rem;
        }

        .valores a {
            text-align: center;
        }
    }
    </style>
</head>

<body>

    <div class="cards">
        <h1>Olá, <?= htmlspecialchars($usuario['nome'] ?? 'Usuário') ?></h1>
        <p class="login">Não é você? Entre <a href="./login.php">aqui</a>
        </p>
        <div class="card">
            <h3>Total de Receitas</h3>
            <p>R$ <?= number_format($totalReceitas, 2, ',', '.') ?></p>
        </div>
        <div class="card">
            <h3>Total de Despesas</h3>
            <p>R$ <?= number_format($totalDespesas, 2, ',', '.') ?></p>
        </div>
        <div class="card">
            <h3>Saldo Atual</h3>
            <p>R$ <?= number_format($saldo, 2, ',', '.') ?></p>
        </div>
    </div>
    <div class="valores">
        <h2>Adicionar Valores</h2>
        <a class="receita" href="./add_receita.php">Adicionar Receita</a>
        <a href="./add_despesa.php">Adicionar Despesa</a><br>
    </div>

    <div class="table">
        <h2>Movimentações Recentes</h2>
        <table>
            <tr>
                <th>Data</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Valor (R$)</th>
            </tr>
            <?php foreach ($transacoes as $t): ?>
            <tr>
                <td><?= date('d/m/Y', strtotime($t['data'])) ?></td>
                <td><?= $t['tipo'] ?></td>
                <td><?= htmlspecialchars($t['descricao']) ?></td>
                <td style="color: <?= $t['tipo']==='Receita' ? 'green' : 'red' ?>">
                    <?= number_format($t['valor'], 2, ',', '.') ?>
                </td>
            </tr>
            <?php endforeach ?>
        </table>
    </div>

</body>

</html>