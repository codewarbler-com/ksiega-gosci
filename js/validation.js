/**
 * WALIDACJA FORMULARZY
 * Księga Gości - Projekt INF.03
 *
 * W tym pliku znajdują się funkcje walidujące formularze
 * UWAGA: Niektóre funkcje wymagają uzupełnienia przez ucznia!
 */

/**
 * Walidacja formularza rejestracji
 *
 * @param {Event} event - Wydarzenie submit
 * @returns {boolean} - true jeśli formularz jest poprawny
 */
function validateRegistrationForm(event) {
    event.preventDefault(); // Zapobiegamy domyślnemu wysłaniu formularza

    const form = event.target;
    let isValid = true;

    // Czyszczenie poprzednich błędów
    clearFormErrors(form);

    // Pobieranie wartości z pól
    const username = form.username.value.trim();
    const email = form.email.value.trim();
    const fullName = form.full_name.value.trim();
    const password = form.password.value;
    const confirmPassword = form.confirm_password.value;

    // ====================================
    // WALIDACJA USERNAME
    // ====================================
    if (username === '') {
        showError('Nazwa użytkownika jest wymagana', 'username-error');
        isValid = false;
    } else if (username.length < 3) {
        showError('Nazwa użytkownika musi mieć minimum 3 znaki', 'username-error');
        isValid = false;
    } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
        showError('Nazwa użytkownika może zawierać tylko litery, cyfry i podkreślenie', 'username-error');
        isValid = false;
    }
    // lubie samochody
    // ====================================
    // TODO DLA UCZNIA - ZADANIE 1
    // ====================================
    // Uzupełnij walidację email
    // 1. Sprawdź czy pole email nie jest puste
    // 2. Sprawdź czy email jest w poprawnym formacie
    //    Użyj wyrażenia regularnego: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    // 3. Jeśli błąd, użyj showError('komunikat', 'email-error')
    // 4. Ustaw isValid = false jeśli walidacja nie przeszła

    // TWÓJ KOD TUTAJ:
    if (email === '') {
        showError('Email jest wymagany','email-error')
        isValid = false;
    }else if(email.length > 100){
        showError('Email jest za długi','email-error')
        isValid = false;
    }
    else if(/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)){
        showError('Niepoprawny format emaila','email-error')
        isValid = false;
    }

    // ====================================
    // WALIDACJA PEŁNEJ NAZWY
    // ====================================
    if (fullName === '') {
        showError('Imię i nazwisko jest wymagane', 'full_name-error');
        isValid = false;
    } else if (fullName.length < 3) {
        showError('Imię i nazwisko musi mieć minimum 3 znaki', 'full_name-error');
        isValid = false;
    }

    // ====================================
    // TODO DLA UCZNIA - ZADANIE 2
    // ====================================
    // Uzupełnij walidację hasła
    // 1. Sprawdź czy hasło nie jest puste
    // 2. Sprawdź czy hasło ma minimum 6 znaków
    // 3. (OPCJONALNIE) Sprawdź czy hasło zawiera:
    //    - przynajmniej jedną wielką literę
    //    - przynajmniej jedną cyfrę
    // 4. Użyj showError('komunikat', 'password-error')

    // TWÓJ KOD TUTAJ:
    if (password === '') {
       showError('Hasło jest wymagane','password-error')
       isValid = false;
    }else if(password.length < 6){
        showError('Hasło musi miec przynajmiej 6 znakow','password-error')
        isValid = false;
    }else if(!/[A-Z]/.test(password)){
        showError('Hasło musie mieć wielka litere','password-error')
        isValid = false;
    }else if(!/[0-9]/.test(password)){
        showError('Hasło musi zawierać jakaś cyfrę','password-error')
    }

    // ====================================
    // WALIDACJA POTWIERDZENIA HASŁA
    // ====================================
    if (confirmPassword === '') {
        showError('Potwierdzenie hasła jest wymagane', 'confirm_password-error');
        isValid = false;
    } else if (password !== confirmPassword) {
        showError('Hasła nie są identyczne', 'confirm_password-error');
        isValid = false;
    }

    // Jeśli wszystko OK, wyślij formularz
    if (isValid) {
        form.submit();
    }

    return isValid;
}

/**
 * Walidacja formularza logowania
 *
 * @param {Event} event - Wydarzenie submit
 * @returns {boolean} - true jeśli formularz jest poprawny
 */
function validateLoginForm(event) {
    event.preventDefault();

    const form = event.target;
    let isValid = true;

    clearFormErrors(form);

    const username = form.username.value.trim();
    const password = form.password.value;

    // Walidacja username
    if (username === '') {
        showError('Nazwa użytkownika jest wymagana', 'username-error');
        isValid = false;
    }

    // Walidacja hasła
    if (password === '') {
        showError('Hasło jest wymagane', 'password-error');
        isValid = false;
    }

    if (isValid) {
        form.submit();
    }

    return isValid;
}

/**
 * Walidacja formularza dodawania wpisu
 *
 * @param {Event} event - Wydarzenie submit
 * @returns {boolean} - true jeśli formularz jest poprawny
 */
function validateEntryForm(event) {
    event.preventDefault();

    const form = event.target;
    let isValid = true;

    clearFormErrors(form);

    const title = form.title.value.trim();
    const content = form.content.value.trim();

    // ====================================
    // TODO DLA UCZNIA - ZADANIE 3
    // ====================================
    // Uzupełnij walidację formularza wpisu
    // 1. Sprawdź czy tytuł nie jest pusty
    // 2. Sprawdź czy tytuł ma minimum 5 znaków
    // 3. Sprawdź czy tytuł nie przekracza 200 znaków
    // 4. Sprawdź czy treść nie jest pusta
    // 5. Sprawdź czy treść ma minimum 10 znaków
    // 6. Użyj odpowiednich showError() dla 'title-error' i 'content-error'

    // TWÓJ KOD TUTAJ:
    if (title === '') {
        showError('Tytuł jest wymagany','title-error');
        isValid = false;
    }else if(title.length <5){
        showError('Tytuł musie miec min 5 znaków','title-error');
        isValid = false;
    }else if(title.length > 200){
        showError('Tytuł może mieć maksymalnie 200 znaków','title-error');
        isValid = false;
    }

    if(content === ''){
        showError('Treśc jeść jest wymagana','content-error');
        isValid = false;
    }else if(content.length < 10){
        showError('Treść musi miec minimum 10 znaków', 'content-error')
        isValid = false;
    }

    if (isValid) {
        form.submit();
    }

    return isValid;
}

/**
 * Walidacja w czasie rzeczywistym (real-time validation)
 * Pokazuje błędy podczas wpisywania
 *
 * @param {HTMLInputElement} input - Pole input
 * @param {Function} validationFunc - Funkcja walidująca
 * @param {string} errorId - ID elementu błędu
 */
function validateOnInput(input, validationFunc, errorId) {
    input.addEventListener('input', function() {
        const value = this.value.trim();
        const errorMessage = validationFunc(value);

        if (errorMessage) {
            showError(errorMessage, errorId);
        } else {
            hideError(errorId);
        }
    });
}

/**
 * Przykładowe funkcje walidacyjne do użycia z validateOnInput
 */
const validators = {
    username: function(value) {
        if (value === '') return 'Nazwa użytkownika jest wymagana';
        if (value.length < 3) return 'Minimum 3 znaki';
        if (!/^[a-zA-Z0-9_]+$/.test(value)) return 'Tylko litery, cyfry i podkreślenie';
        return null;
    },

    email: function(value) {
        if (value === '') return 'Email jest wymagany';
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) return 'Nieprawidłowy format email';
        return null;
    },

    password: function(value) {
        if (value === '') return 'Hasło jest wymagane';
        if (value.length < 6) return 'Minimum 6 znaków';
        return null;
    }
};

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================

/*
WYJAŚNIENIE:

1. event.preventDefault()
   - Zapobiega domyślnej akcji (wysłaniu formularza)
   - Daje nam kontrolę nad walidacją

2. trim()
   - Usuwa białe znaki z początku i końca
   - "  test  ".trim() => "test"

3. Wyrażenia regularne (RegEx)
   - /^[a-zA-Z0-9_]+$/ - tylko litery, cyfry, podkreślenie
   - /^[^\s@]+@[^\s@]+\.[^\s@]+$/ - format email
   - test() - sprawdza czy pasuje

4. Walidacja po stronie klienta
   - Poprawia UX (natychmiastowa informacja zwrotna)
   - NIE ZASTĘPUJE walidacji po stronie serwera!
   - Zawsze waliduj również w PHP!

5. Real-time validation
   - validateOnInput() - walidacja podczas wpisywania
   - Używa event listener 'input'
   - Lepsze doświadczenie użytkownika

PRZYKŁAD UŻYCIA:

// W HTML formularza:
<form onsubmit="return validateRegistrationForm(event)">

// Real-time validation:
const usernameInput = document.getElementById('username');
validateOnInput(usernameInput, validators.username, 'username-error');

ZADANIA DO WYKONANIA:
1. Uzupełnij walidację email (TODO ZADANIE 1)
2. Uzupełnij walidację hasła (TODO ZADANIE 2)
3. Uzupełnij walidację formularza wpisu (TODO ZADANIE 3)

WSKAZÓWKI:
- Użyj struktury if-else jak w przykładach
- Pamiętaj o showError() i hideError()
- Ustaw isValid = false przy błędzie
- Sprawdź czy wszystko działa w przeglądarce

ZADANIE ROZSZERZAJĄCE:
- Dodaj real-time validation do wszystkich formularzy
- Dodaj walidację siły hasła (słabe/średnie/silne)
- Dodaj licznik znaków dla treści wpisu
*/
