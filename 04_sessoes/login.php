<?php 
/** 
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 - Autenticação com sessões e cntrole de acesso
 * Arquivo    : 04_sessoes/login.php
 * Autor      : Felipe Moraes Bandeira
 * Data       : 23/03/2026
 */

// session_start() DEVE ser a primeira coisa do arquivo 
session_start();

//Se já estiver logado, ir direto ao painel
if (isset($_SESSION['usuario'])){
    header('location: login.php');
    exit;
}

//Credenciais validas (fixas por enquanto - virão do BD na aula 07)
$USUARIO_VALIDO = 'admin';
$SENHA_VALIDA   = 'dwii2026';

$erro  = '';
$login = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $login = trim($_POST['usuario'] ?? '');
    $senha = trim($_POST['senha'] ?? '');

    if ($login === $USUARIO_VALIDO && $senha === $SENHA_VALIDA){
        //Credenciais corretas - novo ID sessão após login (segurança)
        session_regenerate_id(true);
        $_SESSION['usuario']  = $login;
        $_SESSION['logado_em'] = date('d/m/Y \à\s\ H:i');
        header('Location: painel.php');
        exit;
        } else {
            // Menssagem generica - nunca diga qual campo esta errado
            $erro = 'Usuario ou senha incorretos.';
        }
}

$titulo_pagina = 'Login - área Restrita';
$caminho_raiz  = '../';
$pagina_atual  = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
    
<div class="container" style="max-width: 420px;">
    <div class="form-container">

    <h1 class="titulo-secao" style="text-align: center; font-size: 22px;">
        🔐 área Restrita
    </h1>

    <?php if ($erro): ?>
        <div class="alert-erro">
            <p>
                ⛔<?php echo htmlspecialchars($erro); ?>
            </p>
        </div>
        <?php endif; ?>

        <form action="login.php" method="post">
            <label>Usuario:</label>
            <input type="text"
                name="usuario"
                value="<?php echo htmlspecialchars($login); ?>"
                autocomplete="username">

                <label>Senha:</label>
                <input type="password"
                       name="senha"
                       autocomplete="current-password">

                       <button type="submit">Entrar</button>
        </form>

        <p  
            <a href="../index.php" >
                voltar ao inicio
            </a>
        </p>
    </div>
</div>
<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>