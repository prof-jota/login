<?php
if (!isset($_SESSION)) {
    session_start();
}
// Destroi todas as sessões
session_destroy();

// Redireciona de volta para o login
header("Location: index.php");
exit();
?>