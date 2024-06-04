<?php
include('server.php');?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Достижения и Курсы</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <div class="section1">
            <div class="header">
                <div class="breadcrumbs">
                    <span><a href="index.php">Главная</a></span> &gt;
                    <span data-key="documentsInstructions">Достижение</span>
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
                            <a href="portfolio.php"></a>
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

        <!-- Main Content -->
        <div class="content1">
            <h1>Достижения и Курсы</h1>

            <!-- Form for adding a new achievement -->
            <form method="post" enctype="multipart/form-data">
                <input class="in" type="text" name="title" placeholder="Название" required>
                <textarea class="in" name="description" placeholder="Описание" required></textarea>
                <input class="in" type="date" name="date" required>
                <input class="file-input" type="file" name="certificate_image" accept="image/*" id="file-input" required>
                            <label for="file-input" class="file-label btn">Выбрать файл</label>
                <button class="btn" type="submit" name="save_achievement">Добавить</button>
            </form>

            <!-- List of user achievements -->
            <div class="achievements-list">
                <?php 
                // Fetch achievements
                $userId = $_SESSION['user']['id']; // Assuming user ID is stored in session
                $achievements = getAchievements($userId);
                
                if (!empty($achievements)): ?>
                    <div class="achievements-list">
                        <?php foreach ($achievements as $achievement): ?>
                            <!-- Display achievement -->
                            <div class="achievement">
                                <h3><?php echo $achievement['title']; ?></h3>
                                <p><?php echo $achievement['description']; ?></p>
                                <p>Date: <?php echo $achievement['date']; ?></p>
                                <?php if (!empty($achievement['certificate_image'])): ?>
                                    <img src="<?php echo $achievement['certificate_image']; ?>" alt="Certificate">
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No achievements found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>