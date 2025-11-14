<?php
/**
 * FUNKCJE POMOCNICZE
 * Księga Gości - Projekt INF.03
 *
 * Ten plik zawiera funkcje używane w całej aplikacji
 */

//define('APP_ACCESS', true);
require_once __DIR__ . '/../config.php';

/**
 * Rozpocznij sesję jeśli nie jest aktywna
 */
function initSession() {
    if (session_status() === PHP_SESSION_NONE) {
        session_name(SESSION_NAME);
        session_start();
    }
}

/**
 * Wygeneruj token CSRF
 *
 * @return string
 */
function generateCSRFToken() {
    initSession();
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Sprawdź token CSRF
 *
 * @param string $token
 * @return bool
 */
function verifyCSRFToken($token) {
    initSession();
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Zabezpiecz przed XSS - escape HTML
 *
 * @param string $text
 * @return string
 */
function escapeHTML($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

/**
 * Sprawdź czy użytkownik jest zalogowany
 *
 * @return bool
 */
function isLoggedIn() {
    initSession();
    return isset($_SESSION['user_id']) && isset($_SESSION['username']);
}

/**
 * Sprawdź czy użytkownik ma daną rolę
 *
 * @param string $role
 * @return bool
 */
function hasRole($role) {
    initSession();
    if (!isLoggedIn()) {
        return false;
    }
    return isset($_SESSION['role']) && $_SESSION['role'] === $role;
}

/**
 * Przekieruj na inną stronę
 *
 * @param string $url
 */
function redirect($url) {
    header("Location: $url");
    exit;
}

/**
 * Wymagaj zalogowania - przekieruj jeśli niezalogowany
 *
 * @param string $redirectUrl
 */
function requireLogin($redirectUrl = 'index.php') {
    if (!isLoggedIn()) {
        redirect($redirectUrl);
    }
}

/**
 * Walidacja email
 *
 * @param string $email
 * @return bool
 */
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Walidacja username (alfanumeryczny, 3-50 znaków)
 *
 * @param string $username
 * @return bool
 */
function validateUsername($username) {
    return preg_match('/^[a-zA-Z0-9_]{3,50}$/', $username);
}

/**
 * Walidacja hasła (min. 6 znaków)
 *
 * @param string $password
 * @return bool
 */
function validatePassword($password) {
    return strlen($password) >= 6;
}

/**
 * Ustaw komunikat flash (sesja)
 *
 * @param string $message
 * @param string $type (success, error, warning, info)
 */
function setFlashMessage($message, $type = 'info') {
    initSession();
    $_SESSION['flash_message'] = [
        'message' => $message,
        'type' => $type
    ];
}

/**
 * Pobierz i usuń komunikat flash
 *
 * @return array|null
 */
function getFlashMessage() {
    initSession();
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $message;
    }
    return null;
}

/**
 * Formatuj datę
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function formatDate($date, $format = 'd.m.Y H:i') {
    return date($format, strtotime($date));
}

/**
 * Skróć tekst do określonej długości
 *
 * @param string $text
 * @param int $length
 * @param string $suffix
 * @return string
 */
function truncateText($text, $length = 100, $suffix = '...') {
    if (mb_strlen($text) <= $length) {
        return $text;
    }
    return mb_substr($text, 0, $length) . $suffix;
}

/**
 * Pobierz adres IP użytkownika
 *
 * @return string
 */
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}

/**
 * Zwróć odpowiedź JSON
 *
 * @param array $data
 * @param int $statusCode
 */
function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================
/*
WYJAŚNIENIE FUNKCJI:

1. CSRF (Cross-Site Request Forgery)
   - generateCSRFToken() - tworzy unikalny token
   - verifyCSRFToken() - sprawdza poprawność tokena
   - Chroni przed atakami CSRF

2. XSS (Cross-Site Scripting)
   - escapeHTML() - zabezpiecza przed XSS
   - Używaj ZAWSZE przy wyświetlaniu danych użytkownika!

3. Sesje
   - initSession() - bezpieczne rozpoczęcie sesji
   - Flash messages - komunikaty wyświetlane raz

4. Autoryzacja
   - isLoggedIn() - sprawdza czy zalogowany
   - hasRole() - sprawdza rolę użytkownika
   - requireLogin() - wymusza logowanie

5. Walidacja
   - validateEmail() - sprawdza format email
   - validateUsername() - sprawdza username
   - validatePassword() - sprawdza hasło

PRZYKŁAD UŻYCIA:

// Zabezpieczenie przed XSS
echo escapeHTML($user_input);

// CSRF w formularzu
<input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

// Sprawdzenie CSRF
if (!verifyCSRFToken($_POST['csrf_token'])) {
    die('Invalid CSRF token');
}

// Komunikat flash
setFlashMessage('Wpis dodany pomyślnie!', 'success');

// Wymagaj logowania
requireLogin('login.php');

ZADANIE DLA UCZNIA:
- Zrozum każdą funkcję
- Zobacz, jak chronimy przed XSS i CSRF
- Naucz się używać flash messages
- Zapamiętaj funkcje walidacji
*/
