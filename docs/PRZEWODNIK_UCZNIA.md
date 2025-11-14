# Przewodnik Ucznia - Jak się uczyć z tego projektu

Ten dokument wyjaśnia jak efektywnie wykorzystać projekt "Księga Gości" do nauki programowania webowego i przygotowania do egzaminu INF.03.

---

## PLAN NAUKI (4-6 tygodni)

### TYDZIEŃ 1: Podstawy i zrozumienie projektu

#### Dzień 1-2: Uruchomienie i eksploracja
- [ ] Uruchom projekt zgodnie z `INSTRUKCJA_START.md`
- [ ] Przetestuj wszystkie funkcje jako użytkownik
- [ ] Zaloguj się na różne konta testowe
- [ ] Dodaj kilka wpisów, przeglądaj, filtruj

#### Dzień 3-4: Baza danych
- [ ] Otwórz phpMyAdmin i zobacz strukturę bazy
- [ ] Przeanalizuj plik `sql/schema.sql`
- [ ] Zrozum relacje między tabelami (klucze obce)
- [ ] Zobacz przykładowe dane w tabelach
- [ ] Napisz własne zapytania SELECT w phpMyAdmin
- [ ] Naucz się podstawowych zapytań:
  - `SELECT * FROM users`
  - `SELECT * FROM entries WHERE user_id = 3`
  - `SELECT e.*, u.full_name FROM entries e JOIN users u ON e.user_id = u.id`

#### Dzień 5-7: Frontend (HTML/CSS)
- [ ] Otwórz `index.php` i przeanalizuj strukturę HTML
- [ ] Zobacz jak używane są znaczniki semantyczne (nav, main, article, footer)
- [ ] Otwórz `css/style.css` i przeanalizuj style
- [ ] Zrozum zmienne CSS (`--primary-color`, itp.)
- [ ] Zobacz jak działa responsywność (`@media queries`)
- [ ] Zmień kolory w zmiennych CSS i zobacz efekt
- [ ] Spróbuj zmienić fonty, rozmiary, odstępy

**Materiały do nauki:**
- HTML: https://www.w3schools.com/html/
- CSS: https://www.w3schools.com/css/
- Flexbox: https://flexboxfroggy.com/

---

### TYDZIEŃ 2: JavaScript i walidacja

#### Dzień 1-3: Podstawy JavaScript
- [ ] Otwórz `js/main.js` i przeanalizuj kod
- [ ] Zrozum `DOMContentLoaded`
- [ ] Naucz się `querySelector` i `getElementById`
- [ ] Zobacz jak działają `addEventListener`
- [ ] Eksperymentuj z `console.log()` w przeglądarce (F12)

#### Dzień 4-5: Walidacja formularzy
- [ ] Otwórz `js/validation.js`
- [ ] Przeanalizuj funkcję `validateRegistrationForm()`
- [ ] Zrozum jak działa `event.preventDefault()`
- [ ] Naucz się wyrażeń regularnych (RegEx):
  - `/^[a-zA-Z0-9_]+$/` - alfanumeryczne
  - `/^[^\s@]+@[^\s@]+\.[^\s@]+$/` - email
- [ ] **WYKONAJ ZADANIE 1** (walidacja email)
- [ ] **WYKONAJ ZADANIE 2** (walidacja hasła)
- [ ] **WYKONAJ ZADANIE 3** (walidacja wpisu)

#### Dzień 6-7: Testowanie i debugowanie
- [ ] Przetestuj wszystkie formularze
- [ ] Zobacz błędy w DevTools (F12 → Console)
- [ ] Naucz się używać `console.log()` do debugowania
- [ ] Przetestuj walidację z różnymi danymi

**Materiały do nauki:**
- JavaScript: https://javascript.info/
- RegEx: https://regexr.com/
- DevTools: https://developer.chrome.com/docs/devtools/

---

### TYDZIEŃ 3: PHP i backend

#### Dzień 1-2: Podstawy PHP
- [ ] Otwórz `config.php` i zrozum `define()`
- [ ] Zobacz `php/db-connection.php` i zrozum PDO
- [ ] Przeanalizuj `php/functions.php`
- [ ] Naucz się:
  - Zmienne: `$zmienna = 'wartość';`
  - Tablice: `$tablica = ['a', 'b', 'c'];`
  - Funkcje: `function nazwa() { }`
  - If/else: `if ($x > 5) { }`

#### Dzień 3-4: Prepared Statements i bezpieczeństwo
- [ ] Zrozum czym jest SQL Injection
- [ ] Zobacz jak prepared statements chronią przed SQL Injection
- [ ] Przeanalizuj przykłady w `index.php`:
  ```php
  $stmt = $db->prepare("SELECT * FROM entries WHERE id = ?");
  $stmt->execute([$id]);
  ```
- [ ] Zrozum różnicę między `?` a `:nazwany`
- [ ] Naucz się `password_hash()` i `password_verify()`

#### Dzień 5-7: Logowanie i sesje
- [ ] Otwórz `pages/login.php` i przeanalizuj
- [ ] Zrozum jak działają sesje (`$_SESSION`)
- [ ] Zobacz `initSession()` i `session_start()`
- [ ] Przeanalizuj proces logowania krok po kroku
- [ ] Zobacz jak sprawdzane jest hasło
- [ ] Zrozum `session_regenerate_id()` (zabezpieczenie)
- [ ] **WYKONAJ ZADANIE 6** (dodawanie wpisu)

**Materiały do nauki:**
- PHP: https://www.php.net/manual/pl/
- PDO: https://www.php.net/manual/pl/book.pdo.php
- Sesje: https://www.php.net/manual/pl/book.session.php

---

### TYDZIEŃ 4: Integracja i AJAX

#### Dzień 1-3: AJAX i Fetch API
- [ ] Otwórz `js/ajax-handlers.js`
- [ ] Zrozum czym jest AJAX
- [ ] Naucz się Fetch API:
  ```javascript
  fetch(url)
      .then(response => response.json())
      .then(data => console.log(data))
      .catch(error => console.error(error));
  ```
- [ ] Zobacz różnicę między GET i POST
- [ ] Zrozum Promises (`.then()` i `.catch()`)
- [ ] **WYKONAJ ZADANIE 4** (ładowanie wpisów AJAX)

#### Dzień 4-5: JSON i API
- [ ] Zrozum format JSON
- [ ] Naucz się `JSON.stringify()` i `JSON.parse()`
- [ ] Zobacz jak PHP zwraca JSON:
  ```php
  echo json_encode(['success' => true, 'data' => $data]);
  ```
- [ ] Przeanalizuj `jsonResponse()` w `functions.php`

#### Dzień 6-7: Pełna integracja
- [ ] Zobacz jak frontend i backend współpracują
- [ ] Prześledzić cały proces od kliknięcia do odpowiedzi:
  1. Użytkownik klika przycisk
  2. JavaScript wysyła AJAX
  3. PHP przetwarza dane
  4. PHP zwraca JSON
  5. JavaScript wyświetla wynik
- [ ] Przetestuj wszystko razem

**Materiały do nauki:**
- Fetch API: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API
- JSON: https://www.json.org/json-pl.html
- AJAX: https://javascript.info/fetch

---

### TYDZIEŃ 5-6: Zadania rozszerzające i praktyka

#### Do wyboru (wybierz minimum 3):
- [ ] **ZADANIE 7**: Wyszukiwanie wpisów
- [ ] **ZADANIE 8**: Sortowanie wpisów
- [ ] **ZADANIE 9**: Panel moderatora
- [ ] **ZADANIE 10**: Edycja własnych wpisów
- [ ] **ZADANIE 11**: API endpoint
- [ ] **ZADANIE 12**: Hamburger menu
- [ ] **ZADANIE 13**: Licznik znaków
- [ ] **ZADANIE 14**: Infinite scroll

---

## NAJWAŻNIEJSZE KONCEPTY DO OPANOWANIA

### 1. HTML5 - Semantyka
✓ Znaczniki semantyczne: `<nav>`, `<main>`, `<article>`, `<footer>`
✓ Formularze: `<form>`, `<input>`, `<textarea>`, `<select>`
✓ Atrybuty: `id`, `class`, `name`, `value`, `required`

### 2. CSS3 - Stylizacja i responsywność
✓ Selektory: `class`, `id`, `element`, `descendant`
✓ Box model: `margin`, `padding`, `border`, `width`, `height`
✓ Flexbox: `display: flex`, `justify-content`, `align-items`
✓ Media queries: `@media (max-width: 768px)`
✓ Zmienne CSS: `--variable-name`, `var(--variable-name)`

### 3. JavaScript - Interaktywność
✓ DOM: `getElementById`, `querySelector`, `addEventListener`
✓ Eventy: `click`, `submit`, `input`, `DOMContentLoaded`
✓ Walidacja: wyrażenia regularne, `if/else`
✓ AJAX: `fetch()`, Promises, `.then()`, `.catch()`
✓ Manipulacja DOM: `innerHTML`, `textContent`, `style`

### 4. PHP - Backend
✓ Zmienne: `$variable`
✓ Tablice: `$array = []`, `$_POST`, `$_GET`, `$_SESSION`
✓ Funkcje: `function name() {}`
✓ PDO: `prepare()`, `execute()`, `fetch()`, `fetchAll()`
✓ Sesje: `session_start()`, `$_SESSION`
✓ Haszowanie: `password_hash()`, `password_verify()`

### 5. MySQL - Baza danych
✓ CREATE TABLE, INSERT, SELECT, UPDATE, DELETE
✓ WHERE, ORDER BY, LIMIT, OFFSET
✓ JOIN (INNER JOIN, LEFT JOIN)
✓ Klucze: PRIMARY KEY, FOREIGN KEY
✓ Typy danych: INT, VARCHAR, TEXT, TIMESTAMP

### 6. Bezpieczeństwo
✓ SQL Injection → Prepared Statements
✓ XSS → `htmlspecialchars()`, `escapeHTML()`
✓ CSRF → Tokeny CSRF
✓ Hasła → `password_hash()`, NIGDY plain text!
✓ Walidacja → ZAWSZE po stronie serwera!

---

## METODYKA NAUKI

### 1. Czytaj kod z góry na dół
- Rozpocznij od początku pliku
- Czytaj komentarze - są tam wyjaśnienia
- Nie pomijaj niczego, nawet jeśli nie rozumiesz

### 2. Eksperymentuj
- Zmieniaj wartości i zobacz co się stanie
- Celowo wprowadź błąd i zobacz komunikat
- Dodaj `console.log()` lub `echo` żeby zobaczyć wartości

### 3. Debuguj
- Użyj DevTools (F12) w przeglądarce
- Zakładka Console - błędy JavaScript
- Zakładka Network - zapytania AJAX
- `console.log()` to Twój najlepszy przyjaciel!

### 4. Testuj wszystko
- Testuj z poprawnymi danymi
- Testuj z błędnymi danymi
- Testuj z pustymi polami
- Testuj na różnych rozdzielczościach ekranu

### 5. Dokumentuj
- Pisz notatki co zrozumiałeś
- Dodawaj komentarze do kodu
- Twórz listę pytań i szukaj odpowiedzi

---

## TYPOWE BŁĘDY I JAK ICH UNIKAĆ

### ❌ Błąd: Brak walidacji po stronie serwera
**Prawidłowo:** ZAWSZE waliduj dane w PHP, nawet jeśli masz walidację w JavaScript!

### ❌ Błąd: Wyświetlanie danych użytkownika bez escape
**Prawidłowo:** ZAWSZE używaj `escapeHTML()` lub `htmlspecialchars()`

### ❌ Błąd: Zapytania SQL bez prepared statements
**Prawidłowo:** ZAWSZE używaj prepared statements: `prepare()` + `execute()`

### ❌ Błąd: Przechowywanie haseł jako plain text
**Prawidłowo:** ZAWSZE używaj `password_hash()`

### ❌ Błąd: Brak tokenów CSRF w formularzach
**Prawidłowo:** ZAWSZE dodawaj `generateCSRFToken()` i sprawdzaj `verifyCSRFToken()`

---

## ZASOBY DO NAUKI

### Dokumentacja
- PHP: https://www.php.net/manual/pl/
- JavaScript: https://developer.mozilla.org/pl/
- MySQL: https://dev.mysql.com/doc/

### Tutoriale
- W3Schools: https://www.w3schools.com/
- JavaScript.info: https://javascript.info/
- PHP The Right Way: https://phptherightway.com/

### Narzędzia
- VS Code: https://code.visualstudio.com/
- Chrome DevTools: Wbudowane w przeglądarkę (F12)
- phpMyAdmin: Wbudowane w XAMPP/WAMP

---

## SPRAWDŹ SWOJĄ WIEDZĘ

Po zakończeniu nauki powinieneś umieć odpowiedzieć:

### HTML/CSS
- [ ] Co to są znaczniki semantyczne i dlaczego są ważne?
- [ ] Jak działa box model CSS?
- [ ] Co to jest Flexbox i jak go używać?
- [ ] Jak stworzyć responsywny design?

### JavaScript
- [ ] Jak działa DOM i jak nim manipulować?
- [ ] Co to jest event listener?
- [ ] Jak walidować formularze po stronie klienta?
- [ ] Czym są Promises i jak działają?

### PHP
- [ ] Co to są prepared statements i dlaczego są bezpieczne?
- [ ] Jak działają sesje w PHP?
- [ ] Jak hashować i weryfikować hasła?
- [ ] Jaka jest różnica między GET i POST?

### MySQL
- [ ] Jak stworzyć tabelę z kluczami obcymi?
- [ ] Co to jest JOIN i jak go używać?
- [ ] Jak zrobić paginację używając LIMIT i OFFSET?

### Bezpieczeństwo
- [ ] Co to jest SQL Injection i jak się chronić?
- [ ] Co to jest XSS i jak się chronić?
- [ ] Co to jest CSRF i jak się chronić?
- [ ] Dlaczego nigdy nie przechowujemy haseł jako plain text?

---

## PRZYGOTOWANIE DO EGZAMINU

### 2 tygodnie przed egzaminem:
1. Przejrzyj `CHECKLIST_EGZAMIN.md`
2. Zrób wszystkie obowiązkowe zadania
3. Przećwicz tworzenie projektu od zera
4. Czasomierz: spróbuj stworzyć prosty formularz w 30 minut

### 1 tydzień przed egzaminem:
1. Przećwicz zadania egzaminacyjne z poprzednich lat
2. Powtórz najważniejsze koncepty
3. Sprawdź czy pamiętasz składnię SQL, PHP, JavaScript

### Dzień przed egzaminem:
1. Przejrzyj notatki
2. Odpoczynij - nie ucz się na ostatnią chwilę
3. Przygotuj środowisko (XAMPP, edytor)

---

**Powodzenia w nauce! Praktyka czyni mistrza! 💪**
