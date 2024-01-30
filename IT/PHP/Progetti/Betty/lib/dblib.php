<?php
$sql_tutti_clienti = "SELECT * FROM clienti";
$sql_tutte_agenzie = "SELECT * FROM agenzie";
$sql_tutti_utenti_join_agenzie = "SELECT users.*, nome_agenzia AS nomeagenzia FROM users JOIN agenzie ON users.agenzia_id=agenzie.id";
?>