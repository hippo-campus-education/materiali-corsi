<?php
$sql_tutti_clienti = "SELECT * FROM clienti";
$sql_tutte_agenzie = "SELECT * FROM agenzie";
$sql_transazioni_clienti = "SELECT clienti.cognome AS cogn, clienti.nome AS nom, tipi_transazioni.movimento AS mov, tipi_transazioni.tipo_transazione AS tipo_tr, importo FROM transazioni JOIN clienti ON transazioni.cliente_id=clienti.id JOIN tipi_transazioni ON transazioni.tipo_transazione_id=tipi_transazioni.id";
$sql_tutti_utenti_join_agenzie = "SELECT users.*, nome_agenzia AS nomeagenzia FROM users JOIN agenzie ON users.agenzia_id=agenzie.id";
?>