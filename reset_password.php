<?php
session_start();
$errors = array();

if (isset($_POST['reset_password'])) {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $errors[] = "Пароли не совпадают";
    }

    if (count($errors) == 0) {
        $db = new mysqli('localhost', 'root', '', 'teacher');

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $new_password, $email);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Пароль успешно изменен";
            header('location: login.php');
            exit();
        } else {
            $errors[] = "Ошибка при изменении пароля";
        }

        $stmt->close();
        $db->close();
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Изменение пароля</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="sulogo.png" alt="Satbayev University Logo">
        </div>
        <div class="login-box">
            <h2>Изменение пароля</h2>
            <form method="post" action="reset_password.php">
                <div class="input-group">
                    <input type="email" name="email" placeholder="Введите ваш email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="new_password" placeholder="Введите новый пароль" required>
                </div>
                <div class="input-group">
                    <input type="password" name="confirm_password" placeholder="Подтвердите новый пароль" required>
                </div>
                <button type="submit" name="reset_password">Изменить пароль</button>
                <?php if (isset($errors) && count($errors) > 0): ?>
                    <div class="error">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </form>
        </div>
    </div>
</body>
</html>

