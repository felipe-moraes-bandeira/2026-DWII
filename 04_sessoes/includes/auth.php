<?php 
/** 
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 - Autenticação com sessões e cntrole de acesso
 * Arquivo    : 04_sessoes/includes/auth.php
 * Autor      : Felipe Moraes Bandeira
 */
/**
 * requer_login()
 * Vereficar se ha sessao ativa.
 * Se não houver, redireciona para o login e encerra.
 * Chamar no topo de qualquer pagina protegida.
 */
function requer_login(): void 
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['usuario'])){
        header('location: login.php');
        exit;
    }
}
/**
 * usuario_logado()
 * retornar o nome do usuario da sessao ou String vazia.
 */
function usuario_logado(): string 
{
    return $_SESSION['usuario'] ?? '';
}
?>