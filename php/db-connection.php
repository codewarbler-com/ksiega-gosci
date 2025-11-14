<?php
/**
 * POŁĄCZENIE Z BAZĄ DANYCH
 * Księga Gości - Projekt INF.03
 *
 * Ten plik tworzy bezpieczne połączenie z bazą danych używając PDO
 */

// Definiujemy stałą dostępu
//define('APP_ACCESS', true);

// Ładujemy konfigurację
require_once __DIR__ . '/../config.php';

/**
 * Klasa Database
 * Singleton pattern - tylko jedno połączenie z bazą danych
 */
class Database {
    private static $instance = null;
    private $connection;

    /**
     * Konstruktor prywatny - zapobiega tworzeniu nowych instancji
     */
    private function __construct() {
        try {
            // DSN (Data Source Name) - informacje o połączeniu
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

            // Opcje PDO dla bezpieczeństwa
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,     // Rzucaj wyjątki przy błędach
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,           // Zwracaj tablice asocjacyjne
                PDO::ATTR_EMULATE_PREPARES   => false,                      // Używaj prawdziwych prepared statements
                PDO::ATTR_PERSISTENT         => false,                      // Nie używaj trwałych połączeń
            ];

            // Utworzenie połączenia
            $this->connection = new PDO($dsn, DB_USER, DB_PASS, $options);

        } catch (PDOException $e) {
            // Obsługa błędu połączenia
            if (DEBUG_MODE) {
                die("Błąd połączenia z bazą danych: " . $e->getMessage());
            } else {
                die("Błąd połączenia z bazą danych. Skontaktuj się z administratorem.");
            }
        }
    }

    /**
     * Pobierz instancję połączenia (Singleton)
     *
     * @return Database
     */
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Pobierz obiekt połączenia PDO
     *
     * @return PDO
     */
    public function getConnection() {
        return $this->connection;
    }

    /**
     * Zapobiegaj klonowaniu obiektu
     */
    private function __clone() {}

    /**
     * Zapobiegaj deserializacji obiektu
     */
    public function __wakeup() {
        throw new Exception("Cannot unserialize singleton");
    }
}

/**
 * Funkcja pomocnicza - szybki dostęp do połączenia
 *
 * @return PDO
 */
function getDB() {
    return Database::getInstance()->getConnection();
}

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================
/*
WYJAŚNIENIE:

1. PDO (PHP Data Objects)
   - Bezpieczny sposób łączenia się z bazą danych
   - Wspiera prepared statements (zabezpieczenie przed SQL Injection)
   - Działa z różnymi bazami danych (MySQL, PostgreSQL, SQLite)

2. Singleton Pattern
   - Zapewnia, że istnieje tylko jedno połączenie z bazą
   - Oszczędza zasoby serwera
   - Metoda getInstance() zwraca zawsze tę samą instancję

3. Prepared Statements
   - PDO::ATTR_EMULATE_PREPARES = false
   - Używa prawdziwych prepared statements na poziomie bazy
   - CHRONI PRZED SQL INJECTION!

4. Obsługa błędów
   - PDO::ERRMODE_EXCEPTION - rzuca wyjątki
   - W trybie DEBUG pokazujemy szczegóły błędu
   - W trybie produkcyjnym ukrywamy szczegóły

PRZYKŁAD UŻYCIA:

// Sposób 1:
$db = getDB();
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

// Sposób 2:
$db = Database::getInstance()->getConnection();
$stmt = $db->prepare("SELECT * FROM entries WHERE id = :id");
$stmt->execute(['id' => $id]);
$entry = $stmt->fetch();

ZADANIE DLA UCZNIA:
- Zrozum, czym jest Singleton Pattern
- Zobacz, jak tworzy się połączenie PDO
- Zapamiętaj opcje PDO dla bezpieczeństwa
- Naucz się używać prepared statements
*/
