<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <div class="auth">
        <h2>Faça seu Login</h2>

        <!-- Exemplo de mensagem de erro -->
        <!-- <div class="alert error">Usuário ou senha incorretos.</div> -->

        <form action="processa_login.php" method="post">
            <div class="form-group">
                <label for="login">Login</label>
                <input type="text" id="login" name="login" required>
                <!-- ícone opcional -->
                <!-- <span class="icon">@</span> -->
            </div>

            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
                <!-- ícone opcional -->
                <!-- <span class="icon">🔒</span> -->
            </div>

            <button type="submit" class="btn submit-auth">Entrar</button>
        </form>

        <div class="auth-footer">
            Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a>
        </div>
    </div>
</body>

</html>