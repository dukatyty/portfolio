<?php 
include('server.php');
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$user = getUserData($_SESSION['user']['id']);
$achievements = getAchievements($_SESSION['user']['id']);
$videos = getUserVideos($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="//resources.satbayev.university/images/favicons/favicon16.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <!-- First Section -->
        <div class="section1">
            <div class="header">
                <div class="logo" data-key="home">Главная</div>
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
                            <a href="portfolio.php">Портфолио</a>
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

            <?php if(isset($_COOKIE['user'])): ?>
            <div class="container">
                <div class="section">
                    <div class="card">
                        <a class="href" href="portfolio.php">
                            <div class="icon my-status"></div>
                            <span data-key="myStatus">Мой Статус</span>
                        </a>
                    </div>
                    <div class="card">
                        <a class="href" href="achiv.php">
                            <div class="icon documents"></div>
                            <span data-key="documentsInstructions">Достижение</span>
                        </a>
                    </div>
                    <div class="card">
                        <a class="href" href="pdf.php">
                            <div class="icon scientific-db"></div>
                            <span data-key="scientificDB">Статьи в журналах</span>
                        </a>
                    </div>
                    <div class="card">
                        <a class="href" href="pdf.php">
                            <div class="icon scientific-db"></div>
                            <span data-key="scientificDB1">Монографии</span>
                        </a>
                    </div>
                    <div class="card">
                        <a class="href" href="pdf.php">
                            <div class="icon scientific-db"></div>
                            <span data-key="scientificDB2">Диссертации</span>
                        </a>
                    </div>
                </div>
                <<div class="section">
                    <div class="content3">
                        <div class="main-content">
                            <h2>Ваши видео по курсу</h2>
                            <div class="video-list">
                                <?php foreach ($videos as $video): ?>
                                <div class="video-item">
                                    <h3><?php echo htmlspecialchars($video['title']); ?></h3>
                                    <p><?php echo htmlspecialchars($video['description']); ?></p>
                                    <div class="video-container">
                                        <iframe width="200px" height="150px" src="<?php echo htmlspecialchars($video['video_url']); ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>

            <div class="container">
                <div class="section">
                    <div class="card">
                        <a class="href" href="#">
                            <div class="icon my-status"></div>
                            <span data-key="myStatus">Мой Статус</span>
                        </a>
                    </div>
                    
                    <div class="card">
                        <a class="href" href="#">
                            <div class="icon documents"></div>
                            <span data-key="documentsInstructions">Отдельное достижение</span>
                        </a>
                    </div>

                    <div class="card">
                        <a class="href" href="#">
                            <div class="icon scientific-library"></div>
                            <span data-key="scientificLibrary">Научная библиотека</span>
                        </a>
                    </div>
                    <div class="card">
                        <a class="href" href="#">
                            <div class="icon scientific-db"></div>
                            <span data-key="scientificDB">БД Научной библиотеки</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
    function playVideo() {
        var video = document.getElementById("profile-video");
        // Проверяем, играет ли видео
        if (video.paused) {
            video.play(); // Если нет, начинаем воспроизведение
        } else {
            video.pause(); // Если да, приостанавливаем воспроизведение
        }
    }
</script>
</body>
</html>
