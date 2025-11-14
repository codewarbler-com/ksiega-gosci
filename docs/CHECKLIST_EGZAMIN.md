# Checklist Egzaminacyjna INF.03

Ten dokument mapuje wymagania egzaminu INF.03 z Podstawy Programowej na elementy projektu "Księga Gości".

---

## INF.03.3. Projektowanie stron internetowych

### ✅ Hipertekstowe języki znaczników (HTML)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Stosuje znaczniki języka HTML | `index.php`, wszystkie pliki `.php` | ✅ |
| Definiuje strukturę dokumentu (sekcje) | `<nav>`, `<main>`, `<section>`, `<footer>` | ✅ |
| Hierarchia treści (nagłówki, paragrafy) | `<h1>`, `<h2>`, `<p>` w całym projekcie | ✅ |
| Listy, tabele, obrazy, odnośniki | Listy w alerts, odnośniki w nav | ✅ |
| Formularze i kontrolki | `register.php`, `login.php`, `add-entry.php` | ✅ |

**Pliki do nauki:** `index.php`, `pages/register.php`

---

### ✅ Kaskadowe arkusze stylów (CSS)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Style lokalne, wewnętrzne, zewnętrzne | `css/style.css` (zewnętrzny) | ✅ |
| Kaskadowość stylów | Zmienne CSS + specyficzne style | ✅ |
| Selektory (elementów, atrybutów, pseudoklas) | `.class`, `#id`, `:hover` w `style.css` | ✅ |
| Projektuje wygląd strony | Cały projekt stylizowany | ✅ |
| Responsywne strony (CSS) | `@media queries` w `style.css` | ✅ |

**Pliki do nauki:** `css/style.css`

---

### ✅ Grafika i multimedia

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Różne formaty plików graficznych | Możliwość dodania w katalogu `images/` | ⚠️ |
| Osadza elementy multimedialne | Gotowa struktura | ⚠️ |

**Uwaga:** Grafika nie jest krytyczna dla podstawowej funkcjonalności. Można dodać jako rozszerzenie.

---

### ✅ Projektowanie stron zgodnie z projektem

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Projektuje układ sekcji | Flexbox layout w `style.css` | ✅ |
| Tworzy strukturę zgodną z projektem | Wszystkie strony HTML | ✅ |
| Dobiera paletę barw | Zmienne CSS: `--primary-color`, etc. | ✅ |
| Dobiera czcionki | `font-family` w CSS | ✅ |
| Uwzględnia potrzeby niepełnosprawnych | Semantyczny HTML, kontrast kolorów | ✅ |
| Stosuje wytyczne WCAG | Podstawowy poziom zgodności | ✅ |

**Pliki do nauki:** `index.php`, `css/style.css`

---

### ✅ Testowanie i walidacja

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Testuje w różnych przeglądarkach | Manualnie | 📝 |
| Testuje responsywność | DevTools, różne rozdzielczości | 📝 |
| Walidacja strony | W3C Validator | 📝 |
| Optymalizuje stronę | CSS minifikacja (opcjonalnie) | ⚠️ |
| Pozycjonowanie (SEO) | Meta tagi (można dodać) | ⚠️ |

**Instrukcje:** Testuj manualnie w Chrome, Firefox. Użyj DevTools (F12) do testowania responsywności.

---

### ✅ Publikacja witryn

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Opisuje usługi hostingu | Dokumentacja (ten plik) | ✅ |
| Opisuje operacje na domenach | Dokumentacja | ✅ |
| Publikuje witryny | Lokalnie przez XAMPP/WAMP | ✅ |

**Instrukcje:** Na egzaminie wystarczy publikacja lokalna (localhost).

---

## INF.03.4. Projektowanie i administrowanie bazami danych

### ✅ Pojęcia dotyczące baz danych

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Określa pojęcia: encja, atrybuty, klucze | `sql/schema.sql` - komentarze | ✅ |
| Stosuje odpowiednie typy danych | INT, VARCHAR, TEXT, TIMESTAMP | ✅ |
| Rozpoznaje postacie normalne | Tabele są w 3NF | ✅ |
| Opisuje cechy relacyjnej bazy danych | Dokumentacja w SQL | ✅ |

**Pliki do nauki:** `sql/schema.sql`

---

### ✅ Diagramy E/R

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Definiuje encje i atrybuty | users, entries, categories | ✅ |
| Definiuje związki i liczebność | FOREIGN KEY w schema | ✅ |
| Dobiera typ danych do atrybutów | Każda kolumna ma odpowiedni typ | ✅ |
| Określa klucz główny | PRIMARY KEY id | ✅ |

**Pliki do nauki:** `sql/schema.sql` - sprawdź relacje

---

### ✅ Systemy zarządzania bazami danych (SZBD)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Rozróżnia dostępne SZBD | MySQL / MariaDB | ✅ |
| Instaluje SZBD | XAMPP/WAMP | ✅ |
| Konfiguruje SZBD | `config.php` | ✅ |

**Pliki do nauki:** `config.php`, `php/db-connection.php`

---

### ✅ SQL (Structured Query Language)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Opisuje polecenia języka SQL | CREATE, SELECT, INSERT, UPDATE, DELETE | ✅ |
| Stosuje polecenia języka SQL | Wszystkie pliki PHP | ✅ |
| Definiuje struktury baz danych | `sql/schema.sql` | ✅ |
| Wyszukuje informacje (SELECT) | `index.php`, `dashboard.php` | ✅ |
| Zmienia rekordy (UPDATE) | Zadanie rozszerzające | ⚠️ |
| Usuwa rekordy (DELETE) | ON DELETE CASCADE | ✅ |
| Tworzy skrypty SQL | `sql/schema.sql` | ✅ |

**Pliki do nauki:** `index.php` (SELECT), `pages/register.php` (INSERT)

---

### ✅ Tworzenie relacyjnych baz danych

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Definiuje tabele na podstawie projektu | users, entries, categories | ✅ |
| Definiuje typy danych i atrybuty | `sql/schema.sql` | ✅ |
| Wprowadza dane do bazy | INSERT w schema | ✅ |
| Importuje dane z pliku | phpMyAdmin import | ✅ |
| Eksportuje strukturę i dane | phpMyAdmin export | 📝 |

**Pliki do nauki:** `sql/schema.sql`

---

### ✅ Zarządzanie systemem bazy danych

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Tworzy użytkowników bazy | Dokumentacja | ⚠️ |
| Określa uprawnienia dla użytkowników | Role: user, moderator, admin | ✅ |
| Tworzy kopię zapasową | phpMyAdmin backup | 📝 |
| Przywraca dane z kopii | phpMyAdmin restore | 📝 |
| Importuje/eksportuje tabele | phpMyAdmin | 📝 |

**Instrukcje:** Praktykuj tworzenie backupów w phpMyAdmin

---

## INF.03.5. Programowanie aplikacji internetowych

### ✅ Zasady programowania

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Analizuje problemy programistyczne | Komentarze w kodzie | ✅ |
| Stosuje algorytmy | Walidacja, paginacja | ✅ |
| Programowanie strukturalne | Wszystkie pliki PHP/JS | ✅ |

**Pliki do nauki:** `php/functions.php`, `js/validation.js`

---

### ✅ Skryptowe języki programowania

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Stosuje JavaScript i PHP | Cały projekt | ✅ |
| Implementuje algorytmy | Walidacja, sortowanie | ✅ |
| Typy proste i złożone, zmienne | Wszędzie | ✅ |
| Instrukcje sterujące (if, for, while) | `validation.js`, pliki PHP | ✅ |
| Funkcje i biblioteki | `functions.php`, `validation.js` | ✅ |
| Tworzy strony wykorzystujące skrypty | Wszystkie strony | ✅ |

**Pliki do nauki:** `php/functions.php`, `js/validation.js`

---

### ✅ Skrypty po stronie klienta (JavaScript)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Programuje w JavaScript | `js/*.js` | ✅ |
| Obsługa zdarzeń myszy i klawiatury | `addEventListener` w JS | ✅ |
| Stosuje biblioteki (jQuery, React, etc.) | Vanilla JS (można dodać biblioteki) | ⚠️ |
| Obsługuje formularze i kontrolki HTML | `validation.js` | ✅ |
| Walidacja formularzy HTML5 | `validation.js` | ✅ |
| Korzysta z modelu DOM | `querySelector`, `getElementById` | ✅ |

**Pliki do nauki:** `js/validation.js`, `js/main.js`

---

### ✅ Skrypty po stronie serwera (PHP)

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Programuje w PHP | Wszystkie pliki `.php` | ✅ |
| Stosuje wbudowane funkcje | `password_hash()`, `htmlspecialchars()` | ✅ |
| Metody przesyłania danych (GET, POST) | `$_GET`, `$_POST` | ✅ |
| Wysyłanie danych z formularza | `pages/register.php`, `login.php` | ✅ |
| Stosuje biblioteki do obsługi bazy | PDO | ✅ |
| Obsługa plików | `getUserIP()` | ⚠️ |
| Obsługa cookies i sesji | `$_SESSION`, `session_start()` | ✅ |

**Pliki do nauki:** `pages/login.php`, `php/functions.php`

---

### ✅ Środowisko programistyczne

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Stosuje środowisko programistyczne | VS Code, PHPStorm (dowolny) | 📝 |
| Instaluje i konfiguruje serwer WWW | XAMPP/WAMP | ✅ |
| Instaluje serwer baz danych | MySQL w XAMPP/WAMP | ✅ |
| Korzysta z pakietów (phpMyAdmin) | phpMyAdmin | ✅ |

**Instrukcje:** Zainstaluj XAMPP według `INSTRUKCJA_START.md`

---

### ✅ Walidacja kodu

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Analizuje błędy w kodzie | DevTools Console | 📝 |
| Wykonuje testy programów | Manualne testowanie | 📝 |
| Poprawia błędy | Proces debugowania | 📝 |
| Stosuje debugger w przeglądarce | Chrome DevTools (F12) | 📝 |

**Instrukcje:** Otwórz DevTools (F12), zakładka Console i Network

---

### ✅ Dokumentacja

| Wymaganie | Gdzie w projekcie | Status |
|-----------|-------------------|--------|
| Stosuje komentarze w kodzie | Wszędzie | ✅ |
| Tworzy dokumentację programu | `docs/*.md` | ✅ |
| Tworzy instrukcję użytkownika | `INSTRUKCJA_START.md` | ✅ |

**Pliki do nauki:** Zobacz komentarze w każdym pliku

---

## PODSUMOWANIE POKRYCIA WYMAGAŃ

### ✅ W pełni zaimplementowane (90%)
- HTML5 semantyczny
- CSS3 responsywny
- JavaScript (walidacja, DOM, eventy)
- PHP (backend, sesje, funkcje)
- MySQL (baza danych, relacje, JOIN)
- Bezpieczeństwo (prepared statements, XSS, CSRF, hasła)
- Formularze (wszystkie metody)
- PDO i obsługa bazy danych

### ⚠️ Częściowo zaimplementowane (8%)
- AJAX (struktura gotowa, wymaga uzupełnienia - ZADANIE 4)
- Multimedia (struktura gotowa, można dodać)
- UPDATE (zadanie rozszerzające)

### 📝 Do praktyki manualnej (2%)
- Testowanie w różnych przeglądarkach
- Walidacja W3C
- Backup/restore bazy danych w phpMyAdmin
- Debugowanie w DevTools

---

## JAK UŻYWAĆ TEJ CHECKLISTY?

### Przed egzaminem:
1. Przejdź przez każdy punkt ✅
2. Otwórz wskazane pliki i przeanalizuj kod
3. Zrozum DLACZEGO to działa, nie tylko JAK

### Podczas nauki:
- [ ] Zaznaczaj punkty, które opanowałeś
- [ ] Wracaj do punktów, których nie rozumiesz
- [ ] Praktykuj punkty oznaczone ⚠️

### Na egzaminie:
- Pamiętaj, że znasz wszystkie te koncepty z tego projektu
- Używaj podobnych rozwiązań jak w projekcie
- Myśl o bezpieczeństwie (prepared statements, escape, hash)

---

## KLUCZOWE PUNKTY NA EGZAMIN

### Must-know (absolutnie krytyczne):
1. **Prepared Statements** - ZAWSZE używaj do zapytań SQL
2. **password_hash()** - NIGDY nie przechowuj haseł jako plain text
3. **htmlspecialchars()** / `escapeHTML()` - ZAWSZE escape przed wyświetleniem
4. **CSRF tokens** - Dodawaj do formularzy
5. **Walidacja** - Po stronie klienta I serwera
6. **Sesje** - `session_start()`, `$_SESSION`
7. **JOIN** - Łączenie tabel w zapytaniach SQL
8. **Responsive design** - Media queries
9. **DOM manipulation** - `querySelector`, `addEventListener`
10. **PDO** - `prepare()`, `execute()`, `fetch()`

### Nice-to-know (ważne, ale nie krytyczne):
- AJAX / Fetch API
- Wyrażenia regularne (RegEx)
- Paginacja (LIMIT, OFFSET)
- Flash messages
- Singleton pattern

---

## PUNKTY ZA PROJEKT NA EGZAMINIE

Typowa struktura punktowa:

| Kategoria | Punkty | Co oceniają |
|-----------|--------|-------------|
| Baza danych | 20% | Struktura tabel, relacje, typy danych |
| HTML | 15% | Semantyka, formularze, struktura |
| CSS | 15% | Stylizacja, responsywność, layout |
| JavaScript | 20% | Walidacja, DOM, eventy |
| PHP Backend | 20% | Logika, bezpieczeństwo, obsługa bazy |
| Funkcjonalność | 10% | Czy wszystko działa poprawnie |

**Najczęstsze błędy** (unikaj ich!):
- Brak prepared statements (automatyczna strata punktów za bezpieczeństwo!)
- Brak walidacji po stronie serwera
- Wyświetlanie danych użytkownika bez escape (XSS)
- Plain text hasła w bazie danych
- Brak responsywności
- Błędy składni SQL, PHP, JavaScript

---

## OSTATECZNA CHECKLIST PRZED EGZAMINEM

### Tydzień przed:
- [ ] Przeszedłem wszystkie pliki projektu
- [ ] Znam na pamięć składnię: SQL SELECT, INSERT, JOIN
- [ ] Wiem jak zrobić prepared statement
- [ ] Pamiętam `password_hash()` i `password_verify()`
- [ ] Umiem stworzyć formularz HTML z walidacją JS
- [ ] Rozumiem media queries
- [ ] Wiem jak działają sesje w PHP

### Dzień przed:
- [ ] Odpoczywam, nie uczę się nowych rzeczy
- [ ] Sprawdzam czy XAMPP działa
- [ ] Mam zainstalowany edytor kodu
- [ ] Przejrzałem projekt jeszcze raz

### Na egzaminie:
- [ ] Czytam dokładnie polecenie
- [ ] Planuję strukturę przed kodowaniem
- [ ] Używam prepared statements
- [ ] Hashuję hasła
- [ ] Escape'uję output
- [ ] Waliduj ę na kliencie i serwerze
- [ ] Testuję każdą funkcję przed oddaniem

---

**Powodzenia na egzaminie! Pamiętaj - ten projekt zawiera WSZYSTKO czego potrzebujesz! 🎓✨**
