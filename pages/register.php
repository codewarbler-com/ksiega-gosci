<?php
/**
 * STRONA REJESTRACJI
 * Formularz rejestracji nowego użytkownika
 */

define('APP_ACCESS', true);
require_once '../config.php';
require_once '../php/functions.php';
require_once '../php/db-connection.php';

initSession();

// Jeśli już zalogowany, przekieruj
if (isLoggedIn()) {
    redirect('../index.php');
}

// Obsługa formularza
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Weryfikacja tokenu CSRF
    if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
        $errors[] = 'Nieprawidłowy token bezpieczeństwa';
    } else {
        // Pobranie danych z formularza
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $full_name = trim($_POST['full_name'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Walidacja po stronie serwera (ZAWSZE!)
        if (empty($username)) {
            $errors[] = 'Nazwa użytkownika jest wymagana';
        } elseif (!validateUsername($username)) {
            $errors[] = 'Nieprawidłowa nazwa użytkownika (3-50 znaków, alfanumeryczne)';
        }

        if (empty($email)) {
            $errors[] = 'Email jest wymagany';
        } elseif (!validateEmail($email)) {
            $errors[] = 'Nieprawidłowy format email';
        }

        if (empty($full_name)) {
            $errors[] = 'Imię i nazwisko jest wymagane';
        }

        if (empty($password)) {
            $errors[] = 'Hasło jest wymagane';
        } elseif (!validatePassword($password)) {
            $errors[] = 'Hasło musi mieć minimum 6 znaków';
        }

        if ($password !== $confirm_password) {
            $errors[] = 'Hasła nie są identyczne';
        }

        // Jeśli brak błędów, sprawdź czy użytkownik już istnieje
        if (empty($errors)) {
            $db = getDB();

            // Sprawdź czy username istnieje
            $stmt = $db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $errors[] = 'Nazwa użytkownika jest już zajęta';
            }

            // Sprawdź czy email istnieje
            $stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $errors[] = 'Email jest już zarejestrowany';
            }

            // Jeśli wszystko OK, zarejestruj użytkownika
            if (empty($errors)) {
                // Hash hasła (ZAWSZE hashuj hasła!)
                $password_hash = password_hash($password, PASSWORD_DEFAULT);

                // Dodaj użytkownika do bazy
                $stmt = $db->prepare("
                    INSERT INTO users (username, email, password_hash, full_name, role)
                    VALUES (?, ?, ?, ?, 'user')
                ");

                if ($stmt->execute([$username, $email, $password_hash, $full_name])) {
                    setFlashMessage('Rejestracja zakończona sukcesem! Możesz się teraz zalogować.', 'success');
                    redirect('login.php');
                } else {
                    $errors[] = 'Błąd podczas rejestracji. Spróbuj ponownie.';
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - <?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="nav-brand">
                <h1><a href="../index.php"><?php echo APP_NAME; ?></a></h1>
            </div>
            <div class="nav-menu">
                <a href="../index.php" class="nav-link">Strona Główna</a>
                <a href="login.php" class="nav-link">Logowanie</a>
                <a href="register.php" class="nav-link active">Rejestracja</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="form-container">
            <h2>Rejestracja</h2>
            <p>Utwórz nowe konto w Księdze Gości</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo escapeHTML($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="register.php" onsubmit="return validateRegistrationForm(event)">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label for="username">Nazwa użytkownika *</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        value="<?php echo escapeHTML($_POST['username'] ?? ''); ?>"
                        required
                    >
                    <div id="username-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        value="<?php echo escapeHTML($_POST['email'] ?? ''); ?>"
                        required
                    >
                    <div id="email-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="full_name">Imię i nazwisko *</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        class="form-control"
                        value="<?php echo escapeHTML($_POST['full_name'] ?? ''); ?>"
                        required
                    >
                    <div id="full_name-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">Hasło *</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required
                    >
                    <div id="password-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Powtórz hasło *</label>
                    <input
                        type="password"
                        id="confirm_password"
                        name="confirm_password"
                        class="form-control"
                        required
                    >
                    <div id="confirm_password-error" class="form-error"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Zarejestruj się</button>
            </form>

            <p style="margin-top: 1.5rem; text-align: center;">
                Masz już konto? <a href="login.php">Zaloguj się</a>
            </p>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 <?php echo APP_NAME; ?>. Projekt edukacyjny INF.03.</p>
        </div>
    </footer>

    <script src="../js/main.js"></script>
    <script src="../js/validation.js"></script>
</body>
</html>
