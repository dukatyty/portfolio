<?php
include('server.php');
if (!isset($_SESSION['user'])) {
    exit();
}
$userData = getUserData($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SU Dashboard</title>
    <link rel="shortcut icon" href="//resources.satbayev.university/images/favicons/favicon16.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <!-- Header Section -->
        <div class="section1">
            <div class="header">
                <div class="breadcrumbs">
                    <span><a href="index.php" data-key="home">Главная</a></span> &gt;
                    <span data-key="editStatus">Изменить статуса</span>
                </div>
                <div class="user-info">
                    <span>
                        <button onclick="setLanguage('kz')">Каз</button>
                        <button onclick="setLanguage('ru')">Рус</button>
                        <button onclick="setLanguage('en')">Eng</button>
                    </span>
                    <?php if (isset($_COOKIE['user'])): ?>
                    <div class="dropdown">
                        <span class="dropdown-toggle" onclick="toggleDropdown()"><?= htmlspecialchars($_SESSION['user']['name']) ?></span>
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="portfolio.php" data-key="portfolio">Портфолио</a>
                            <a href="exit.php" data-key="logout">Выход</a>
                        </div>
                    </div>
                    <?php else: ?>
                        <a href="login.php" data-key="login">Войти</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="notification">
                <span id="current-date-time"></span>
                <span data-key="noNewNotifications">У Вас нет новых уведомлений: 0</span>
            </div>
            <!-- Main Content -->
            <div class="content">
                <div class="student-status">
                <?php if (isset($_COOKIE['user'])): ?>
                    <?php if (!empty($userData['profile_image'])): ?>
                        <img src="<?= htmlspecialchars($userData['profile_image']) ?>" alt="Teacher Photo">
                    <?php else: ?>
                        <img src="path/to/default-photo.jpg" alt="Default Photo">
                    <?php endif; ?>
                    <div class="status-info">
                        <form method="post" enctype="multipart/form-data">
                            <input class="in" type="text" name="workplace" value="<?= htmlspecialchars($userData['workplace'] ?? '') ?>" placeholder="Место работы" required> 
                            <input class="in" type="text" name="position" value="<?= htmlspecialchars($userData['position'] ?? '') ?>" placeholder="Должность" required>
                            <input class="in" type="text" name="education" value="<?= htmlspecialchars($userData['education'] ?? '') ?>" placeholder="Образование" required>
                            <input class="in" type="text" name="experience" value="<?= htmlspecialchars($userData['experience'] ?? '') ?>" placeholder="Опыт работы" required>
                            <input class="in" type="text" name="publications" value="<?= htmlspecialchars($userData['publications'] ?? '') ?>" placeholder="Публикации" required>
                            <input class="in" type="text" name="projects" value="<?= htmlspecialchars($userData['projects'] ?? '') ?>" placeholder="Проекты" required>
                            <input class="in" type="text" name="patents" value="<?= htmlspecialchars($userData['patents'] ?? '') ?>" placeholder="Патенты" required>
                            <input class="in" type="text" name="department" value="<?= htmlspecialchars($userData['department'] ?? '') ?>" placeholder="Кафедра" required>
                            <input class="in" type="text" name="academic_degree" value="<?= htmlspecialchars($userData['academic_degree'] ?? '') ?>" placeholder="Ученая степень" required>
                            <input class="in" type="text" name="academic_title" value="<?= htmlspecialchars($userData['academic_title'] ?? '') ?>" placeholder="Ученое звание" required>
                            <input class="file-input" type="file" name="profile_image" accept="image/*" id="file-input" required>
                            <label for="file-input" class="file-label btn" data-key="chooseFile">Выбрать файл</label>
                            <button class="btn" type="submit" name="save_profile" data-key="save">Сохранить</button>
                        </form>
                        <a class="aa" href="portfolio.php" data-key="viewStatus">Просмотр Статуса</a>
                    </div>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
    <script>
    const translations = {
        kz: {
            home: "Басты бет",
            editStatus: "Мәртебені өзгерту",
            portfolio: "Портфолио",
            logout: "Шығу",
            login: "Кіру",
            noNewNotifications: "Жаңа хабарламалар жоқ: 0",
            chooseFile: "Файл таңдау",
            save: "Сақтау",
            viewStatus: "Мәртебені қарау"
        },
        ru: {
            home: "Главная",
            editStatus: "Изменить статуса",
            portfolio: "Портфолио",
            logout: "Выход",
            login: "Войти",
            noNewNotifications: "У Вас нет новых уведомлений: 0",
            chooseFile: "Выбрать файл",
            save: "Сохранить",
            viewStatus: "Просмотр Статуса"
        },
        en: {
            home: "Home",
            editStatus: "Edit Status",
            portfolio: "Portfolio",
            logout: "Logout",
            login: "Login",
            noNewNotifications: "You have no new notifications: 0",
            chooseFile: "Choose File",
            save: "Save",
            viewStatus: "View Status"
        }
    };

    function setLanguage(lang) {
        const elements = document.querySelectorAll('[data-key]');
        elements.forEach(element => {
            const key = element.getAttribute('data-key');
            element.textContent = translations[lang][key];
        });
    }

    // Set default language to Russian
    document.addEventListener('DOMContentLoaded', () => {
        setLanguage('ru');
    });

    function toggleDropdown() {
        var dropdownMenu = document.getElementById("dropdown-menu");
        dropdownMenu.classList.toggle("show");
    }
</script>
</body>
</html>