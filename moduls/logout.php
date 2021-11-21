<?php
session_start();

unset($_SESSION['id']);
unset($_SESSION['auth']);
unset($_SESSION['status']);

header('location: /tomasina/')
?>