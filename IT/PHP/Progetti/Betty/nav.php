<?php
// File: nav.php
require_once("config.php");
/**
 * Variabile contenente tutte le voci del menu principale
 * senza filtro di ruolo per ora
 * @var array $menuItems
 */
$menuItems = array(
    "Clienti" => BASE_PATH . "/dashboard.php",
    "Verifica Cassa" => BASE_PATH . "/dashboard.php",
    "Tipi Transazioni" => BASE_PATH . "/tipi_transazioni.php",
    "Agenzie" => BASE_PATH . "/dashboard.php",
    "Utenti" => BASE_PATH . "/users.php",
    "Ricerca" => BASE_PATH . "/search-form.php",
    "Reset Password" => BASE_PATH . "/reset-password.php",
    "Logout" => BASE_PATH . "/logout.php"
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