<?php
/**
 * STRONA LOGOWANIA
 * Formularz logowania użytkownika
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
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        // Walidacja
        if (empty($username)) {
            $errors[] = 'Nazwa użytkownika jest wymagana';
        }

        if (empty($password)) {
            $errors[] = 'Hasło jest wymagane';
        }

        // Jeśli brak błędów, sprawdź dane logowania
        if (empty($errors)) {
            $db = getDB();

            // Pobierz użytkownika z bazy
            $stmt = $db->prepare("
                SELECT id, username, password_hash, full_name, role, is_active
                FROM users
                WHERE username = ?
            ");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            // Sprawdź czy użytkownik istnieje i hasło się zgadza
            if ($user && password_verify($password, $user['password_hash'])) {
                // Sprawdź czy konto jest aktywne
                if (!$user['is_active']) {
                    $errors[] = 'Twoje konto zostało dezaktywowane. Skontaktuj się z administratorem.';
                } else {
                    // Logowanie zakończone sukcesem!

                    // Regeneruj ID sesji (zabezpieczenie przed session fixation)
                    session_regenerate_id(true);

                    // Zapisz dane użytkownika w sesji
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['role'] = $user['role'];

                    // Zaktualizuj czas ostatniego logowania
                    $stmt = $db->prepare("UPDATE users SET last_login = NOW() WHERE id = ?");
                    $stmt->execute([$user['id']]);

                    // Przekieruj do strony głównej
                    setFlashMessage('Witaj, ' . $user['full_name'] . '!', 'success');
                    redirect('../index.php');
                }
            } else {
                $errors[] = 'Nieprawidłowa nazwa użytkownika lub hasło';
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
    <title>Logowanie - <?php echo APP_NAME; ?></title>
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
                <a href="login.php" class="nav-link active">Logowanie</a>
                <a href="register.php" class="nav-link">Rejestracja</a>
            </div>
        </div>
    </nav>

    <main class="container">
        <div class="form-container">
            <h2>Logowanie</h2>
            <p>Zaloguj się do swojego konta</p>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 20px;">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo escapeHTML($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php" onsubmit="return validateLoginForm(event)">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label for="username">Nazwa użytkownika</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        class="form-control"
                        value="<?php echo escapeHTML($_POST['username'] ?? ''); ?>"
                        required
                        autofocus
                    >
                    <div id="username-error" class="form-error"></div>
                </div>

                <div class="form-group">
                    <label for="password">Hasło</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required
                    >
                    <div id="password-error" class="form-error"></div>
                </div>

                <button type="submit" class="btn btn-primary btn-full">Zaloguj się</button>
            </form>

            <div style="margin-top: 1.5rem; padding: 1rem; background-color: #f8f9fa; border-radius: 8px;">
                <h4 style="margin-bottom: 0.5rem;">Konta testowe:</h4>
                <p style="margin: 0.25rem 0;"><strong>Admin:</strong> admin / test123</p>
                <p style="margin: 0.25rem 0;"><strong>Użytkownik:</strong> jankowalski / test123</p>
            </div>

            <p style="margin-top: 1.5rem; text-align: center;">
                Nie masz konta? <a href="register.php">Zarejestruj się</a>
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
