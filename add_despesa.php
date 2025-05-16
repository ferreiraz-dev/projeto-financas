<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nova Despesa</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="container">
        <h2>Adicione sua Despesa</h2>
        <form action="processa_despesa.php" method="post">
            <label for="valor">Valor:</label>
            <input type="number" id="valor" name="valor" required step="0.01" min="0.01">

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4"></textarea>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <button type="submit" class="btn btn-submit">Adicionar Despesa</button>
            <button type="button" class="btn btn-back" onclick="window.location.href='index.php'">
                Voltar
            </button>
        </form>
    </div>
</body>

</html>


</html>