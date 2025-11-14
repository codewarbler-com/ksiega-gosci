-- ============================================
-- KSIĘGA GOŚCI - Baza Danych
-- Projekt edukacyjny dla egzaminu INF.03
-- ============================================

-- Usunięcie istniejącej bazy (jeśli istnieje)
DROP DATABASE IF EXISTS ksiega_gosci;

-- Utworzenie bazy danych
CREATE DATABASE ksiega_gosci CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Użycie bazy danych
USE ksiega_gosci;

-- ============================================
-- Tabela: users (użytkownicy)
-- Przechowuje dane użytkowników systemu
-- ============================================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('user', 'moderator', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    INDEX idx_username (username),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabela: categories (kategorie wpisów)
-- Przechowuje kategorie dla wpisów
-- ============================================
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE,
    description TEXT,
    color VARCHAR(7) DEFAULT '#007bff',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_name (name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Tabela: entries (wpisy do księgi gości)
-- Przechowuje wpisy użytkowników
-- ============================================
CREATE TABLE entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    category_id INT NULL,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,
    is_approved BOOLEAN DEFAULT TRUE,
    ip_address VARCHAR(45),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    INDEX idx_user_id (user_id),
    INDEX idx_category_id (category_id),
    INDEX idx_created_at (created_at),
    INDEX idx_approved (is_approved)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- DANE TESTOWE
-- ============================================

-- Dodanie przykładowych kategorii
INSERT INTO categories (name, description, color) VALUES
('Ogólne', 'Wpisy ogólne i różne', '#007bff'),
('Podziękowania', 'Podziękowania i słowa uznania', '#28a745'),
('Sugestie', 'Sugestie i pomysły na ulepszenia', '#ffc107'),
('Pytania', 'Pytania do administratora', '#17a2b8');

-- Dodanie przykładowych użytkowników
-- HASŁO dla wszystkich: test123
-- Hash wygenerowany przez password_hash('test123', PASSWORD_DEFAULT)
INSERT INTO users (username, email, password_hash, full_name, role) VALUES
('admin', 'admin@example.com', '$2y$10$Xl7bJgLr.MyFYqbvbkbJQuUGis/4ZrTTCCBbwPVNn3cC9mGKBYhu.', 'Administrator Systemu', 'admin'),
('moderator', 'moderator@example.com', '$2y$10$Xl7bJgLr.MyFYqbvbkbJQuUGis/4ZrTTCCBbwPVNn3cC9mGKBYhu.', 'Jan Moderator', 'moderator'),
('jankowalski', 'jan@example.com', '$2y$10$Xl7bJgLr.MyFYqbvbkbJQuUGis/4ZrTTCCBbwPVNn3cC9mGKBYhu.', 'Jan Kowalski', 'user'),
('annanowak', 'anna@example.com', '$2y$10$Xl7bJgLr.MyFYqbvbkbJQuUGis/4ZrTTCCBbwPVNn3cC9mGKBYhu.', 'Anna Nowak', 'user');

-- Dodanie przykładowych wpisów
INSERT INTO entries (user_id, category_id, title, content, ip_address) VALUES
(3, 1, 'Pierwsze wrażenia', 'Witam! To mój pierwszy wpis w tej księdze gości. System wygląda bardzo profesjonalnie i jest łatwy w obsłudze.', '192.168.1.100'),
(4, 2, 'Dziękuję za świetną pracę!', 'Chciałabym podziękować za stworzenie tego systemu. Jest prosty, przejrzysty i bardzo funkcjonalny.', '192.168.1.101'),
(3, 3, 'Sugestia - ciemny motyw', 'Czy możliwe byłoby dodanie ciemnego motywu? Byłoby to świetne rozwiązanie dla użytkowników pracujących wieczorami.', '192.168.1.100'),
(4, 4, 'Pytanie o edycję wpisów', 'Czy jest możliwość edycji własnych wpisów po ich dodaniu? Nie mogę znaleźć takiej opcji.', '192.168.1.101'),
(3, 2, 'Rewelacyjny projekt!', 'Świetna robota! Uczę się właśnie do egzaminu INF.03 i ten projekt bardzo mi pomaga zrozumieć wszystkie koncepty.', '192.168.1.100');

-- ============================================
-- WIDOKI (opcjonalnie - dla zaawansowanych)
-- ============================================

-- Widok pokazujący wpisy z informacjami o użytkownikach
CREATE VIEW entries_with_users AS
SELECT
    e.id,
    e.title,
    e.content,
    e.created_at,
    e.is_approved,
    u.username,
    u.full_name,
    c.name AS category_name,
    c.color AS category_color
FROM entries e
INNER JOIN users u ON e.user_id = u.id
LEFT JOIN categories c ON e.category_id = c.id
ORDER BY e.created_at DESC;

-- ============================================
-- INFORMACJE DLA UCZNIA
-- ============================================

/*
WAŻNE INFORMACJE:

1. POŁĄCZENIE Z BAZĄ:
   - Host: localhost
   - Baza: ksiega_gosci
   - User: root (dla XAMPP/WAMP)
   - Hasło: (puste dla XAMPP/WAMP)

2. TESTOWE KONTA:
   - Admin: admin / test123
   - Moderator: moderator / test123
   - Użytkownik: jankowalski / test123

3. RELACJE:
   - entries.user_id -> users.id (klucz obcy)
   - entries.category_id -> categories.id (klucz obcy)
   - ON DELETE CASCADE = przy usunięciu użytkownika, usuń jego wpisy
   - ON DELETE SET NULL = przy usunięciu kategorii, ustaw NULL

4. INDEKSY:
   - Dodane indeksy przyspieszają wyszukiwanie
   - idx_username, idx_email dla szybkiego logowania
   - idx_created_at dla sortowania wpisów

5. ZABEZPIECZENIA:
   - Hasła przechowywane jako hash (password_hash)
   - NIGDY nie przechowuj haseł jako tekst!
   - Używaj prepared statements w PHP

6. ZADANIA DLA UCZNIA:
   - Zaimportuj ten plik do phpMyAdmin
   - Sprawdź strukturę tabel
   - Zobacz relacje w widoku Designer
   - Przetestuj zapytania SELECT JOIN
*/
