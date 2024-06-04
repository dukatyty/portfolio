<?php 
include('server.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Силлабус</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="//resources.satbayev.university/images/favicons/favicon16.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* CSS стили встроены прямо здесь */
        .container4 {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            flex-direction: column;
    align-items: center;
        }
        .card1 {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .card-title {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .course {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .description {
            color: #666;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <!-- First Section -->
        <div class="section1">
            <div class="header">
                <div class="breadcrumbs">
                    <span><a href="index.php">Главная</a></span> &gt;
                    <span>Силлабус</span>
                </div>
                
                <div class="user-info">
                    
                    <span>
                        <button onclick="setLanguage('kz')">Каз</button>
                        <button onclick="setLanguage('ru')">Рус</button>
                        <button onclick="setLanguage('en')">Eng</button>
                    </span>
                    <?php if(isset($_COOKIE['user'])): ?>
                    <div class="dropdown">
                        <span class="dropdown-toggle" onclick="toggleDropdown()"><?= $_SESSION['user']['name'] ?></span>
                        <div class="dropdown-menu" id="dropdown-menu">
                            <a href="profile.php">Портфолио</a>
                            <a href="exit.php" data-key="logout">Выход</a>
                        </div>
                    </div>
                    <?php else: ?>
                        <a href="login.php">Войти</a>
                    <?php endif; ?>
                </div>
            </div>


            <div class="notification">
                <span id="current-date-time"></span>
                <span data-key="noNewNotifications">У Вас нет новых уведомлений: 0</span>
            </div>
            <div class="container4">
                <div class="card1">
                    <h2 class="card-title">Силлабус</h2>
                    <?php
                    // Пример данных силлабуса (замените этот код на ваш фактический PHP код)
                    $courses = array(
                        array(
                            'title' => 'Математика',
                            'description' => 'Основные математические принципы и методы.',
                        ),
                        array(
                            'title' => 'Физика',
                            'description' => 'Основы классической механики и электромагнетизма.',
                        ),
                        array(
                            'title' => 'История',
                            'description' => 'Обзор исторических событий и их влияния на современность.',
                        ),
                    );

                    // Вывод силлабуса
                    foreach ($courses as $course) {
                        echo '<div class="course">' . $course['title'] . '</div>';
                        echo '<div class="description">' . $course['description'] . '</div>';
                        echo '<hr>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
