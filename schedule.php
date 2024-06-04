<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="shortcut icon" href="//resources.satbayev.university/images/favicons/favicon16.png">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="dashboard">
        <!-- Header Section -->
        <div class="section">
            <div class="header">
                <div class="breadcrumbs">
                    <span><a href="index.php">Главная</a></span> &gt;
                    <span>Расписание</span>
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

            <!-- Main Content -->
            <div class="content">
                <div class="schedules-header">
                    <span>Если время проведения выбранной Вами дисциплины вызывает накладки с существующим расписанием, обратитесь в отдел расписания ОП.</span>
                    <div class="term-select">
                        <select>
                            <option>Весна 2023-24</option>
                        </select>
                    </div>
                </div>
                <div class="schedules">
                    <div class="courses-list">
                        <h3>Все дисциплины (3)</h3>
                        <div class="course">
                            <span>ECA103</span>
                            <span>6 кредит (0/0/0)</span>
                            <p>Итоговая аттестация</p>
                        </div>
                        <div class="course">
                            <span>CSE6431</span>
                            <span>3 кредит (1/1/1)</span>
                            <p>Бизнес-аналитика</p>
                        </div>
                        <div class="course">
                            <span>CSE6461</span>
                            <span>3 кредит (1/1/1)</span>
                            <p>Введение в планирование ресурсов предприятия</p>
                        </div>
                    </div>
                    <div class="timetable">
                        <h3>Расписание</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Время</th>
                                    <th>Пн</th>
                                    <th>Вт</th>
                                    <th>Ср</th>
                                    <th>Чт</th>
                                    <th>Пт</th>
                                    <th>Сб</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>7:50 - 8:40</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8:55 - 9:45</td>
                                    <td></td>
                                    <td class="event" rowspan="1">
                                        <div class="event-info">CSE6461<br>Введение в планирование ресурсов предприятия<br>Лабораторная<br>ГУК304 А<br>Кабдуллин А.А.</div>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>10:00 - 10:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="event" rowspan="1">
                                        <div class="event-info">CSE6461<br>Введение в планирование ресурсов предприятия<br>Лекция<br>ГУК804<br>Казиев Г.З.</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>11:05 - 11:55</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="event" rowspan="1">
                                        <div class="event-info">CSE6461<br>Введение в планирование ресурсов предприятия<br>Практика<br>ГУК804</div>
                                    </td>
                                    <td></td>
                                </tr>
                                <!-- Additional rows for times up to 22:00 -->
                                <tr>
                                    <td>12:00 - 12:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>13:00 - 13:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>14:00 - 14:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>15:00 - 15:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>16:00 - 16:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>17:00 - 17:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>18:00 - 18:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>19:00 - 19:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>20:00 - 20:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>21:00 - 21:50</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
