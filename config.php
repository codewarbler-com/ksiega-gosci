<?php
/**
 * PLIK KONFIGURACYJNY
 * Księga Gości - Projekt INF.03
 *
 * Ten plik zawiera wszystkie ustawienia aplikacji
 */

// Zapobieganie bezpośredniemu dostępowi
if (!defined('APP_ACCESS')) {
    die('Direct access not permitted');
}

// ============================================
// KONFIGURACJA BAZY DANYCH
// ============================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'ksiega_gosci');
define('DB_USER', 'root');
define('DB_PASS', ''); // Puste dla XAMPP/WAMP
define('DB_CHARSET', 'utf8mb4');

// ============================================
// KONFIGURACJA APLIKACJI
// ============================================
define('APP_NAME', 'Księga Gości');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/ksiega-gosci');

// ============================================
// KONFIGURACJA SESJI
// ============================================
define('SESSION_NAME', 'ksiega_gosci_session');
define('SESSION_LIFETIME', 3600); // 1 godzina w sekundach

// ============================================
// KONFIGURACJA ZABEZPIECZEŃ
// ============================================
// Klucz do tokenów CSRF (zmień na własny losowy ciąg!)
define('CSRF_SECRET', 'twoj_tajny_klucz_' . md5(__DIR__));

// Maksymalna liczba prób logowania
define('MAX_LOGIN_ATTEMPTS', 5);

// Czas blokady po nieudanych próbach (w sekundach)
define('LOGIN_LOCKOUT_TIME', 900); // 15 minut

// ============================================
// USTAWIENIA TREŚCI
// ============================================
// Maksymalna długość tytułu wpisu
define('MAX_TITLE_LENGTH', 200);

// Maksymalna długość treści wpisu
define('MAX_CONTENT_LENGTH', 5000);

// Liczba wpisów na stronie
define('ENTRIES_PER_PAGE', 10);

// ============================================
// TRYB DEBUGOWANIA
// ============================================
// UWAGA: Ustaw na false w środowisku produkcyjnym!
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// ============================================
// STREFY CZASOWE
// ============================================
date_default_timezone_set('Europe/Warsaw');

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================
/*
WAŻNE:

1. Ten plik zawiera wszystkie konfiguracje aplikacji
2. Zmienne zdefiniowane przez define() są stałymi
3. Stałe są dostępne w całej aplikacji
4. CSRF_SECRET chroni przed atakami CSRF
5. DEBUG_MODE powinien być false w produkcji

ZADANIE DLA UCZNIA:
- Sprawdź, czy ustawienia bazy danych są poprawne
- Zmień CSRF_SECRET na własny losowy ciąg
- Zrozum, co robią poszczególne stałe
*/
