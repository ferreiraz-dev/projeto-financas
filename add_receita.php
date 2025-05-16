<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Receita</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <h2>Adicione sua Receita</h2>
        <form action="processa_receita.php" method="post">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" required step="0.01" min="0.01">

            <label for="fonte">Fonte:</label>
            <input type="text" id="fonte" name="fonte" required>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <button type="submit" class="btn btn-submit">Adicionar Receita</button>
            <button type="button" class="btn btn-back" onclick="window.location.href='index.php'">
                Voltar
            </button>
        </form>
    </div>
</body>

</html>