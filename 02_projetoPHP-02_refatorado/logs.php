<?php
/**
 * ======================================================================
 * ARQUIVO    : logs.php  
 * Disciplina : Desenvolvimento Web II (2026-DWII)
 * Autor      : Felipe Moraes Bandeira
 * Descrição  : Trilha de auditoria (Nível A) - Exibe o histórico de ações.
 * ======================================================================
 */

require_once __DIR__ . '/includes/auth.php';
require_once __DIR__ . '/includes/conexao.php';
requer_login();

$pdo = conectar();


$stmt = $pdo->query("SELECT * FROM logs ORDER BY id DESC");
$logs = $stmt->fetchAll();

$pagina_atual  = 'logs';
$titulo_pagina = 'Auditoria do Sistema | Portfólio DWII';
$caminho_raiz  = './';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <?php require_once __DIR__ . '/includes/cabecalho.php'; ?>
</head>
<body>
<main>
    <div class="container">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h1 class="titulo-secao" style="margin: 0;">📋 Trilha de Auditoria</h1>
            <a href="admin.php" class="btn-secundario">⬅️ Voltar ao Painel</a>
        </div>

        <div class="card" style="padding: 20px; margin-bottom: 20px; background: #0f0f0f;">
            <p style="margin: 0; color: #aaa; font-size: 14px;">
                ℹ️ Esta pagina registra todas as atividades criticas do sistema, como criaçao, ediçao e arquivamanto de proejtos.
            </p>
        </div>

        <?php if (empty($logs)): ?>
            <p class="texto-vazio" style="text-align: center;">Nenhum log registrado no sistema ainda.</p>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="tabela-admin tabela-logs">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                            <th class="centro">Ação</th>
                            <th>Detalhes</th>
                            <th>Registro Afetado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td style="color: #666;">#<?php echo (int) $log['id']; ?></td>
                                
                                <td>
                                    <strong><?php echo htmlspecialchars($log['usuario_login']); ?></strong>
                                </td>
                                
                                <td class="centro">
                                    <?php 
                                        
                                        $acao = strtoupper($log['acao']);
                                        $classe_acao = 'acao-' . strtolower($acao);
                                    ?>
                                    <span class="badge-acao <?php echo $classe_acao; ?>">
                                        <?php echo htmlspecialchars($acao); ?>
                                    </span>
                                </td>
                                
                                <td><?php echo htmlspecialchars($log['detalhes']); ?></td>
                                
                                <td>
                                    <span style="color: #888; font-size: 12px;">
                                        Tabela: <?php echo htmlspecialchars($log['tabela_afetada']); ?><br>
                                        ID: <?php echo (int) $log['registro_id']; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <p class="contador-projetos">
                <?php echo count($logs); ?> registro(s) de auditoria
            </p>
        <?php endif; ?>

    </div>
</main>
<?php require_once __DIR__ . '/includes/rodape.php'; ?>
</body>
</html>