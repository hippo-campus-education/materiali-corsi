<?php
// File: nav.php

/**
 * Variabile contenente tutte le voci del menu principale
 * senza filtro di ruolo per ora
 * @var array $menuItems
 */
$menuItems = array(
    "Clienti" => "dashboard.php",
    "Verifica Cassa" => "dashboard.php",
    "Tipi Transazioni" => "tipi_transazioni.php",
    "Agenzie" => "dashboard.php",
    "Utenti" => "users.php",
    "Ricerca" => "search-form.php",
    "Reset Password" => "reset-password.php",
    "Logout" => "logout.php"
);

/**
 * Funzione di servizio per generare list item con stile boilerplate
 * statico
 * @param string $menu_link file php del link nella anchor del menu
 * @param string $label etichetta che appare nel menu
 * @return string tag HTML list element item
 */
function voce_menu($menu_link, $label)
{
    return '<li class="nav-item"><a class="nav-link" href="' . $menu_link . '">' . $label . '</a></li>';
}
?>