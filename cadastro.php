<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="auth">
        <h2>Crie sua Conta</h2>

        <!-- Exemplo de mensagem de sucesso -->
        <!-- <div class="alert success">Cadastro realizado com sucesso!</div> -->

        <form action="processa_cadastro.php" method="post">
            <div class="form-group">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="form-group">
                <label for="login">Login:</label>
                <input type="text" id="login" name="login" required>
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>

            <div class="form-group">
                <label for="senha2">Confirme a senha</label>
                <input type="password" id="senha2" name="senha2" required>
            </div>

            <button type="submit" class="btn submit-auth">Cadastrar</button>
        </form>

        <div class="auth-footer">
            Já tem conta? <a href="login.php">Faça o login</a>
        </div>
    </div>
</body>

</html>