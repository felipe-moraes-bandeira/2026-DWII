<?php

/** 
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 - Autenticação com sessões e cntrole de acesso
 * Arquivo    : 04_sessoes/includes/publico.php
 * Autor      : Felipe Moraes Bandeira
 */

session_start();
$logado = isset($_SESSION['usuario']);

$titulo_pagina = 'página publica';
$caminho_raiz = '../';
$pagina_atual = '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php  require_once __DIR__ . '/../includes/cabecalho.php'; ?>
</head>
<body>
    <div class="container" style="text-align: center;">
         
    <H1 class="titulo-secao">🌐 página pública</H1>
    <p> Este conteudo é visivel para qualquer visitante, sem login.</p>

    <?php if ($logado): ?>
        <p>Ola, <strong><?php echo htmlspecialchars($_SESSION ['usuario']); ?> </strong>! 
            Voce ja esta autenticado.</p>
            <a href="painel.php"
   style="background: #3ba34a; color: white; padding: 10px 24px;
   border-radius: 6px; text-decoration: none;
   font-weight: bold;">
   Ir ao Painel
</a>
<?php else: ?>
<a href="login.php"
   style="background: #3b579d; color: white; padding: 10px 24px;
   border-radius: 6px; text-decoration: none;
   font-weight: bold;">
   🔒 Acessar Área Restrita
</a>

<?php endif; ?>

</div>

<?php require_once __DIR__ . '/../includes/rodape.php'; ?>
</body>
</html>