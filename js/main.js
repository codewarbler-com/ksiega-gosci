/**
 * GŁÓWNY PLIK JAVASCRIPT
 * Księga Gości - Projekt INF.03
 */

// Czekaj aż DOM będzie gotowy
document.addEventListener('DOMContentLoaded', function() {
    console.log('Księga Gości - Aplikacja załadowana');

    // Inicjalizacja
    initAlertClose();
    initMobileMenu();
});

/**
 * Zamykanie alertów (flash messages)
 */
function initAlertClose() {
    const alerts = document.querySelectorAll('.alert');

    alerts.forEach(alert => {
        // Automatyczne ukrywanie po 5 sekundach
        setTimeout(() => {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => {
                alert.remove();
            }, 500);
        }, 5000);
    });
}

/**
 * Menu mobilne - hamburger
 */
function initMobileMenu() {
    // TODO: Można dodać hamburger menu dla urządzeń mobilnych
    // Jest to zadanie rozszerzające dla ucznia
}

/**
 * Funkcja pomocnicza - pokazywanie/ukrywanie elementu
 *
 * @param {string} elementId - ID elementu
 * @param {boolean} show - true = pokaż, false = ukryj
 */
function toggleElement(elementId, show) {
    const element = document.getElementById(elementId);
    if (element) {
        element.style.display = show ? 'block' : 'none';
    }
}

/**
 * Funkcja pomocnicza - pokazywanie błędu
 *
 * @param {string} message - Treść komunikatu
 * @param {string} elementId - ID elementu do wyświetlenia błędu
 */
function showError(message, elementId) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

/**
 * Funkcja pomocnicza - ukrywanie błędu
 *
 * @param {string} elementId - ID elementu błędu
 */
function hideError(elementId) {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
}

/**
 * Funkcja pomocnicza - czyszczenie wszystkich błędów w formularzu
 *
 * @param {HTMLFormElement} form - Element formularza
 */
function clearFormErrors(form) {
    const errorElements = form.querySelectorAll('.form-error');
    errorElements.forEach(error => {
        error.textContent = '';
        error.style.display = 'none';
    });
}

// ============================================
// INFORMACJE DLA UCZNIA
// ============================================

/*
WYJAŚNIENIE KODU:

1. DOMContentLoaded
   - Wydarzenie wywoływane gdy HTML jest gotowy
   - Bezpieczne miejsce do inicjalizacji JavaScript

2. querySelector / querySelectorAll
   - querySelector('.class') - pierwszy element
   - querySelectorAll('.class') - wszystkie elementy
   - Zwraca NodeList (podobny do tablicy)

3. forEach
   - Iteracja po wszystkich elementach
   - alerts.forEach(alert => { ... })

4. setTimeout
   - Opóźnienie wykonania funkcji
   - setTimeout(() => { kod }, 5000) - 5 sekund

5. Arrow Functions
   - Skrócona składnia funkcji
   - () => { kod }
   - alert => { kod }

6. Style inline
   - element.style.property = 'value'
   - element.style.opacity = '0'

PRZYKŁAD UŻYCIA:

// Pokazanie błędu
showError('To pole jest wymagane', 'email-error');

// Ukrycie błędu
hideError('email-error');

// Ukrycie/pokazanie elementu
toggleElement('success-message', true);

ZADANIE DLA UCZNIA:
- Zrozum event DOMContentLoaded
- Zobacz jak działają setTimeout i transitions
- Naucz się querySelector
- Zaimplementuj hamburger menu (zadanie rozszerzające)
*/
