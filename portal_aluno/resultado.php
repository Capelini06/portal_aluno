<?php

session_start();

$aluno = $_SESSION["aluno"] ?? null;

$mensagem = $_SESSION["mensagem"] ?? "";
unset($_SESSION["mensagem"]);

include "includes/cabecalho.php";
?>
<h2>Resultado do cadastro</h2>
<?php if ($mensagem !== ""): ?>
    <p><?= htmlspecialchars($mensagem, ENT_QUOTES, "UTF-8") ?></p>
<?php endif; ?>
<?php if ($aluno !== null): ?>
    <p>Nome: <?= htmlspecialchars($aluno["nome"], ENT_QUOTES, "UTF-8") ?></p>
    <p>E-mail: <?= htmlspecialchars($aluno["email"], ENT_QUOTES, "UTF-8") ?></p>
    <p>Idade: <?= (int) $aluno["idade"] ?></p>
<?php else: ?>
    <p>Nenhum aluno cadastrado nesta sessão.</p>
<?php endif; ?>
<p><a href="cadastro.php">Novo cadastro</a> | <a href="logout.php">Encerrar sessão</a></p>
<?php
include "includes/rodape.php";
?>
