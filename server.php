<?php
session_start();

// initializing variables
$errors = array(); 

// connect to the database
$db = new mysqli('localhost', 'root', '', 'teacher');

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $name = $db->real_escape_string($_POST['name']);
    $password = $db->real_escape_string($_POST['password']);

    if (empty($name)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE name='$name' AND password='$password'";
        $results = $db->query($query);
        if ($results->num_rows == 1) {
            $user = $results->fetch_assoc();
            $_SESSION['user'] = [
                "id" => $user['id'],
                "name" => $user['name'],
                "email" => $user['email'],
            ];
            header('location: index.php');
            setcookie('user', $user['name'], time() + 30000, "/");
        } else {
            array_push($errors, "Wrong e-mail/password combination");
        }
    }
}

// Function to get user data
function getUserData($userId) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $db->error);
    }
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Handle profile save
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_profile'])) {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $data = [
            'workplace' => $_POST['workplace'],
            'position' => $_POST['position'],
            'education' => $_POST['education'],
            'experience' => $_POST['experience'],
            'publications' => $_POST['publications'],
            'projects' => $_POST['projects'],
            'patents' => $_POST['patents'],
            'department' => $_POST['department'], 
            'academic_degree' => $_POST['academic_degree'], 
            'academic_title' => $_POST['academic_title'], 
        ];

        $profile_image_path = null;
        if (!empty($_FILES['profile_image']['tmp_name'])) {
            $profile_image_name = basename($_FILES['profile_image']['name']);
            $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
            $profile_image_path = 'uploads/' . $profile_image_name;

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            move_uploaded_file($profile_image_tmp, $profile_image_path);
            $data['profile_image'] = $profile_image_path;
        }

        saveProfile($data, $userId);
        header('Location: portfolio.php');
        exit();
    } else {
        array_push($errors, "User not logged in");
    }
}

// Function to save profile data
function saveProfile($data, $userId) {
    global $db;
    $stmt = $db->prepare("UPDATE users SET workplace = ?, position = ?, education = ?, experience = ?, publications = ?, projects = ?, patents = ?, department = ?, academic_degree = ?, academic_title = ?, profile_image = ? WHERE id = ?");
    $stmt->bind_param("sssssssssssi", $data['workplace'], $data['position'], $data['education'], $data['experience'], $data['publications'], $data['projects'], $data['patents'], $data['department'], $data['academic_degree'], $data['academic_title'], $data['profile_image'], $userId);
    $stmt->execute();
}

// Handle achievements save
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_achievement'])) {
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        $certificate_image_path = null;
        if (!empty($_FILES['certificate_image']['tmp_name'])) {
            $certificate_image_name = basename($_FILES['certificate_image']['name']);
            $certificate_image_tmp = $_FILES['certificate_image']['tmp_name'];
            $certificate_image_path = 'uploads/' . $certificate_image_name;
            move_uploaded_file($certificate_image_tmp, $certificate_image_path);
        }

        $stmt = $db->prepare("INSERT INTO achievements (user_id, title, description, date, certificate_image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $userId, $title, $description, $date, $certificate_image_path);
        $stmt->execute();
        header('Location: achiv.php');
        exit();
    } else {
        array_push($errors, "User not logged in");
    }
}

// Fetch achievements
function getAchievements($userId) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM achievements WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Fetch user videos
function getUserVideos($userId) {
    global $db;
    $stmt = $db->prepare("SELECT title, description, video_url FROM videos WHERE user_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $videos = $result->fetch_all(MYSQLI_ASSOC);

    foreach ($videos as &$video) {
        $video['video_url'] = convertYouTubeURL($video['video_url']);
    }

    return $videos;
}

function convertYouTubeURL($url) {
    return preg_replace(
        "/(?:http[s]?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|[^v\n\s]*\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/",
        "https://www.youtube.com/embed/$1",
        $url
    );
}

if (isset($_SESSION['user'])) {
    $videos = array_map(function($video) {
        $video['video_url'] = convertYouTubeURL($video['video_url']);
        return $video;
    }, getUserVideos($_SESSION['user']['id']));
}

// Close the database connection at the end of the script
register_shutdown_function(function() use ($db) {
    $db->close();
});

?>
