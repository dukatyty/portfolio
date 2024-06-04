<?php
include('server.php');
if (!isset($_SESSION['user'])) {
    exit();
}

$userData = getUserData($_SESSION['user']['id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Article List</title>
    <style>
        .dashboard {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;

}
        .section1 {
    display: flex;
    flex-direction: column;
    flex-basis: calc(50% - 10px); /* Two columns */
    margin-bottom: 20px;
    width: 1000px;

}
        .header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    border-radius: 2px;
    margin-bottom: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);

}
        .breadcrumbs span {
    margin-right: 5px;
}
.breadcrumbs a {
    color: white;
    text-decoration: none;
}
.breadcrumbs a:hover {
    text-decoration: underline;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-info span {
    margin-right: 10px;
}

.user-info a {
    color: white;
    text-decoration: none;
}

.user-info a:hover {
    text-decoration: underline;
}

.language-switcher button {
    margin-left: 5px;
}

        /* Общие стили для кнопок */
button {
    padding: 2px 4px;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
    background-color: #007bff; /* Однотонный цвет (синий) */
    color: white;
}

/* Ховер эффекты */
button:hover {
    background-color: #fff; /* Темно-синий при наведении */
    color: black;
}

/* Активное состояние кнопки */
button:active {
    background-color: #3b5998; /* Более темный синий при нажатии */
    color: white;
}
        @media (max-width: 600px) {
    button {
        padding: 8px 16px;
        font-size: 14px;
    }
}
.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-toggle {
    cursor: pointer;
}

.dropdown-menu {
    display: none;
    position: absolute;
    right: 0;
    background-color: #fff;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    min-width: 160px;
    z-index: 1;
}

.dropdown-menu a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-menu a:hover {
    background-color: #f1f1f1;
}

/* Стиль для активного dropdown */
.show {
    display: block;
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            text-align: center;
            margin-top: 20px;
        }
        form label {
            margin-right: 10px;
        }
        #results {
            margin-top: 20px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
    <link rel="shortcut icon" href="//resources.satbayev.university/images/favicons/favicon16.png">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="dashboard">
        <div class="section1">
            <div class="header">
                <div class="breadcrumbs">
                        <span><a href="index.php" data-key="home">Главная</a></span> &gt;
                        <span data-key="myart">Моя Статья</span>
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
                            <a href="login.php" data-key="login">Войти</a>
                        <?php endif; ?>
                    </div>
                </div>                
    <form id="dateForm">
        <h1>Article List</h1>
        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>
        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>
        <button type="submit">Submit</button>
    </form>

    <div id="results"></div>

    <script>
        $(document).ready(function() {
            $('#dateForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    type: 'POST',
                    
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#results').html(response);
                        $('#dateForm').hide();
                        $('.header  ').hide(); // скрыть форму после загрузки данных
                    }
                });
            });
        });

    </script>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        
        // Database connection
        $conn = new mysqli('localhost', 'root', '', 'teacher');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Modify SQL query to include publication_date and join with users table
        $sql = "SELECT a.serial_number, a.title, a.form_of_work, a.publication_details, a.pages, a.co_authors, u.name as author_name, a.publication_date 
                FROM articles a 
                JOIN users u ON a.user_id = u.id 
                WHERE a.publication_date BETWEEN '$start_date' AND '$end_date'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div id='results'>";
            echo "<h2>Articles from $start_date to $end_date</h2>";
            echo "<table>
                    <tr>
                        <th>№ п/п</th>
                        <th>Название работы и ее вид</th>
                        <th>Форма работы</th>
                        <th>Выходные данные</th>
                        <th>Объем в пл.л. или с.</th>
                        <th>Соавторы</th>
                        <th>Автор</th>
                        <th>Дата публикации</th>
                    </tr>";
            $total_pages = 0;
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['serial_number']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['form_of_work']}</td>
                        <td>{$row['publication_details']}</td>
                        <td>{$row['pages']}</td>
                        <td>{$row['co_authors']}</td>
                        <td>{$row['author_name']}</td>
                        <td>{$row['publication_date']}</td>
                      </tr>";
                $total_pages += $row['pages'];
            }
            echo "</table>";
            echo "<p class='total'>Total Articles: " . $result->num_rows . "</p>";
            echo "<p class='total'>Total Pages: " . $total_pages . "</p>";
            echo "<form action='generate_pdf.php' method='post'>
                    <input type='hidden' name='start_date' value='$start_date'>
                    <input type='hidden' name='end_date' value='$end_date'>
                    <button type='submit'>Download PDF</button>
                  </form>";
            echo "</div>";
        } else {
            echo "<div id='results'>No articles found.</div>";
        }

        $conn->close();
    }
    ?>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>




