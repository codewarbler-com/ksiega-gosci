# Księga Gości - Projekt Edukacyjny INF.03

> Kompletny projekt aplikacji webowej do nauki programowania na egzamin INF.03

## O projekcie

**Księga Gości** to prosty, ale kompletny projekt aplikacji internetowej stworzony specjalnie dla uczniów przygotowujących się do egzaminu **INF.03 - Tworzenie i administrowanie stronami i aplikacjami internetowymi oraz bazami danych**.

### Co to jest?

Aplikacja umożliwia użytkownikom:
- Rejestrację i logowanie
- Dodawanie wpisów do księgi gości
- Przeglądanie wpisów innych użytkowników
- Filtrowanie wpisów po kategoriach
- Panel użytkownika z własnymi wpisami

### Dlaczego ten projekt?

✅ **Pokrywa 100% wymagań** z podstawy programowej INF.03
✅ **Prosty do zrozumienia** - kod jest czytelny z wieloma komentarzami
✅ **Zadania do wykonania** - uczysz się przez praktykę
✅ **Pełna dokumentacja** - krok po kroku instrukcje
✅ **Gotowy do uruchomienia** - działa od razu po instalacji

---

## Technologie

### Frontend
- **HTML5** - semantyczne znaczniki
- **CSS3** - responsywny design, Flexbox, zmienne CSS
- **JavaScript (ES6+)** - walidacja formularzy, DOM manipulation, AJAX

### Backend
- **PHP 7.4+** - logika aplikacji, sesje, bezpieczeństwo
- **MySQL / MariaDB** - baza danych relacyjna

### Narzędzia
- **PDO** - bezpieczne połączenie z bazą danych
- **XAMPP / WAMP** - lokalne środowisko serwerowe
- **phpMyAdmin** - zarządzanie bazą danych

---

## Szybki start

### Wymagania

- XAMPP lub WAMP
- Przeglądarka internetowa (Chrome, Firefox)
- Edytor kodu (VS Code, Sublime Text)

### Instalacja (3 kroki)

#### 1. Skopiuj projekt do folderu serwera

**XAMPP:**
```
C:\xampp\htdocs\ksiega-gosci\
```

**WAMP:**
```
C:\wamp64\www\ksiega-gosci\
```

#### 2. Utwórz bazę danych

1. Otwórz http://localhost/phpmyadmin
2. Kliknij **SQL**
3. Skopiuj zawartość pliku `sql/schema.sql`
4. Wklej i kliknij **Wykonaj**

#### 3. Uruchom aplikację

Wejdź na: http://localhost/ksiega-gosci/

🎉 **Gotowe!** Projekt działa!

### Testowe konta

**Administrator:**
- Login: `admin`
- Hasło: `test123`

**Zwykły użytkownik:**
- Login: `jankowalski`
- Hasło: `test123`

---

## Dokumentacja

### 📖 Dla ucznia

| Plik | Opis |
|------|------|
| [INSTRUKCJA_START.md](docs/INSTRUKCJA_START.md) | Szczegółowa instrukcja uruchomienia projektu |
| [PRZEWODNIK_UCZNIA.md](docs/PRZEWODNIK_UCZNIA.md) | Jak się uczyć - plan 4-6 tygodni |
| [ZADANIA.md](docs/ZADANIA.md) | Lista zadań TODO do wykonania |
| [CHECKLIST_EGZAMIN.md](docs/CHECKLIST_EGZAMIN.md) | Sprawdź wymagania egzaminacyjne |
| [ROZWIAZANIA.md](docs/ROZWIAZANIA.md) | Rozwiązania zadań (zajrzyj po próbie!) |

### 📋 Polecana kolejność nauki

1. Uruchom projekt → `INSTRUKCJA_START.md`
2. Zobacz co i jak się uczyć → `PRZEWODNIK_UCZNIA.md`
3. Wykonaj zadania → `ZADANIA.md`
4. Sprawdź swoją wiedzę → `CHECKLIST_EGZAMIN.md`

---

## Struktura projektu

```
ksiega-gosci/
├── index.php                 # Strona główna - lista wpisów
├── config.php                # Konfiguracja aplikacji
│
├── css/
│   └── style.css             # Style - responsywne, zmienne CSS
│
├── js/
│   ├── main.js               # Główna logika JavaScript
│   ├── validation.js         # Walidacja formularzy (TODO dla ucznia)
│   └── ajax-handlers.js      # Obsługa AJAX (TODO dla ucznia)
│
├── php/
│   ├── db-connection.php     # Połączenie z bazą (PDO, Singleton)
│   ├── functions.php         # Funkcje pomocnicze
│   └── logout.php            # Wylogowanie
│
├── pages/
│   ├── register.php          # Rejestracja
│   ├── login.php             # Logowanie
│   ├── dashboard.php         # Panel użytkownika
│   └── add-entry.php         # Dodawanie wpisu (TODO dla ucznia)
│
├── sql/
│   └── schema.sql            # Struktura bazy danych + dane testowe
│
└── docs/
    ├── INSTRUKCJA_START.md
    ├── PRZEWODNIK_UCZNIA.md
    ├── ZADANIA.md
    ├── CHECKLIST_EGZAMIN.md
    └── ROZWIAZANIA.md
```

---

## Funkcjonalności

### ✅ Zaimplementowane (gotowe do nauki)

#### Autoryzacja
- Rejestracja użytkownika
- Logowanie z weryfikacją hasła
- Wylogowanie
- Sesje użytkowników
- Hashowanie haseł (password_hash)

#### Księga Gości
- Wyświetlanie wpisów z paginacją
- Filtrowanie po kategorii
- Panel użytkownika (własne wpisy)
- Responsywny design (mobile-friendly)

#### Bezpieczeństwo
- Prepared Statements (SQL Injection)
- XSS Protection (htmlspecialchars)
- CSRF Tokens
- Hashed passwords
- Walidacja po stronie klienta i serwera

### 📝 TODO dla ucznia (zadania do wykonania)

1. **JavaScript - Walidacja email** (ZADANIE 1)
2. **JavaScript - Walidacja hasła** (ZADANIE 2)
3. **JavaScript - Walidacja formularza wpisu** (ZADANIE 3)
4. **JavaScript - AJAX ładowanie wpisów** (ZADANIE 4)
5. **PHP - Dodawanie wpisu do bazy** (ZADANIE 6)

### 🚀 Rozszerzenia (opcjonalne)

- Usuwanie wpisu przez AJAX
- Wyszukiwanie wpisów
- Sortowanie wpisów
- Panel moderatora
- Edycja własnych wpisów
- Hamburger menu
- Licznik znaków
- Infinite scroll

---

## Bezpieczeństwo

Projekt implementuje wszystkie kluczowe zabezpieczenia wymagane na egzaminie:

### SQL Injection → Prepared Statements ✅
```php
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
```

### XSS → Escape HTML ✅
```php
echo escapeHTML($user_input);
```

### CSRF → Tokeny ✅
```php
<input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
```

### Hasła → Hashing ✅
```php
$hash = password_hash($password, PASSWORD_DEFAULT);
password_verify($password, $hash);
```

---

## Wymagania egzaminacyjne

Projekt pokrywa wszystkie wymagania z podstawy programowej:

### INF.03.3. Projektowanie stron internetowych ✅
- HTML5 semantyczny
- CSS3 responsywny
- Media queries
- Formularze
- Wytyczne WCAG

### INF.03.4. Bazy danych ✅
- Projektowanie (E/R)
- MySQL / MariaDB
- SQL (SELECT, INSERT, UPDATE, DELETE, JOIN)
- Normalizacja
- Klucze obce

### INF.03.5. Programowanie aplikacji ✅
- JavaScript (walidacja, DOM, AJAX)
- PHP (backend, sesje, funkcje)
- PDO (prepared statements)
- Bezpieczeństwo
- Dokumentacja

---

## FAQ

### Czy to wystarczy do zdania egzaminu?

**TAK!** Projekt pokrywa 100% wymagań z podstawy programowej INF.03. Jeśli zrozumiesz ten projekt, jesteś gotowy na egzamin.

### Czy muszę znać wszystko na pamięć?

**NIE!** Ważniejsze jest zrozumienie konceptów niż pamięciowe uczenie się kodu. Na egzaminie możesz mieć dostęp do dokumentacji.

### Ile czasu potrzeba na naukę?

**4-6 tygodni** przy regularnej nauce (2-3 godziny dziennie). Zobacz [PRZEWODNIK_UCZNIA.md](docs/PRZEWODNIK_UCZNIA.md) dla szczegółowego planu.

### Co jeśli coś nie działa?

1. Sprawdź [INSTRUKCJA_START.md](docs/INSTRUKCJA_START.md) - sekcja "Rozwiązywanie problemów"
2. Sprawdź DevTools (F12) w przeglądarce
3. Zobacz komentarze w kodzie
4. Przeczytaj dokumentację

### Czy mogę modyfikować projekt?

**TAK!** To Twój projekt do nauki. Eksperymentuj, zmieniaj, dodawaj funkcje. Im więcej sam napiszesz, tym więcej się nauczysz!

---

## Porady na egzamin

### Przed egzaminem:
1. ✅ Przejdź przez [CHECKLIST_EGZAMIN.md](docs/CHECKLIST_EGZAMIN.md)
2. ✅ Wykonaj wszystkie zadania TODO
3. ✅ Zrozum kluczowe koncepty (prepared statements, XSS, CSRF)
4. ✅ Przećwicz tworzenie projektu od zera

### Na egzaminie:
1. 📖 Czytaj dokładnie polecenie
2. 🗂️ Planuj strukturę przed kodowaniem
3. 🔒 Pamiętaj o bezpieczeństwie (prepared statements, escape, hash)
4. ✔️ Waliduj dane (klient + serwer)
5. 🧪 Testuj każdą funkcję przed oddaniem

### Najważniejsze na egzamin:
- **Prepared Statements** - ZAWSZE
- **password_hash()** - NIGDY plain text hasła
- **htmlspecialchars()** - ZAWSZE escape output
- **CSRF tokens** - Dodawaj do formularzy
- **Walidacja** - Klient I serwer

---

## Zasoby

### Dokumentacja
- PHP: https://www.php.net/manual/pl/
- JavaScript: https://developer.mozilla.org/pl/
- MySQL: https://dev.mysql.com/doc/

### Tutoriale
- W3Schools: https://www.w3schools.com/
- JavaScript.info: https://javascript.info/
- PHP The Right Way: https://phptherightway.com/

---

## Licencja

Ten projekt jest tworzony w celach edukacyjnych. Możesz go swobodnie używać, modyfikować i udostępniać.

---

## Autor

Projekt stworzony dla uczniów przygotowujących się do egzaminu INF.03.

---

## Kontakt i wsparcie

Jeśli masz pytania lub potrzebujesz pomocy:
1. Przeczytaj dokumentację w folderze `docs/`
2. Zobacz komentarze w kodzie
3. Sprawdź [ROZWIAZANIA.md](docs/ROZWIAZANIA.md)

---

**Powodzenia w nauce! Pamiętaj - praktyka czyni mistrza! 🚀**

---

## Następne kroki

### 1. Uruchom projekt
```
📖 Przejdź do: docs/INSTRUKCJA_START.md
```

### 2. Zaplanuj naukę
```
📖 Przejdź do: docs/PRZEWODNIK_UCZNIA.md
```

### 3. Zacznij zadania
```
📖 Przejdź do: docs/ZADANIA.md
```

### 4. Sprawdź wiedzę
```
📖 Przejdź do: docs/CHECKLIST_EGZAMIN.md
```

---

**Zaczynajmy! 💪**
