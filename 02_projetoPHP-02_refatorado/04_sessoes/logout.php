<?php
/** 
 * Disciplina : Desenvolvimento Web II (DWII)
 * Aula       : 06 - Autenticação com sessões e cntrole de acesso
 * Arquivo    : 04_sessoes/includes/logout.php
 * Autor      : Felipe Moraes Bandeira
 */
session_start();
//limpa todos os dados das sessoes 
session_unset();
//destroi a sessao no servidor 
session_destroy();
//redireciona para o login
header('location: login.php');
exit;
?>