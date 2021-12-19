<?php
session_start();
$formStatus = True;

if (isset($_SESSION['user']) == true) {
    header('Location: /');
}

if (isset($_POST['login']) and isset($_POST['password'])) {
    $lg = $_POST['login'];
    $ps = $_POST['password'];

    $mysql = new mysqli('localhost','root','','myblog');

    $sql = "SELECT * FROM users WHERE login = '$lg' AND password = '$ps'";
    $result = $mysql -> query($sql);

    $user = $result -> fetch_assoc();
    if (count($user) != 0) {
        $_SESSION['user'] = $user['login'];
        header('Location: /');
    } else {
        $formStatus = False;
    }
    $mysql -> close();
}
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Авторизация</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Мой блог</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Статьи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Авторизация</a>
                <li class="nav-item">
                    <a class="nav-link" href="registration.php">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Выход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="fon" style="background: url('/files/fon.jpg'); height: 200px; background-repeat: repeat-x;"></div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-2 offset-lg-5">
            <div class="login card card-body mt-4">
                <h4>Авторизация</h4>
                <form action="" method="post" id="loginForm">
                    <?php if ($formStatus == false) {?>
                    <div class="alert alert-warning" role="alert">
                        Пользователь не найден
                    </div>
                    <?php } ?>
                    <label for="">Логин<br>
                        <input class="form-control" name="login" type="text" placeholder="Логин" required>
                    </label><br>
                    <label for="">
                        Пароль<br>
                        <input class="form-control" name="password" type="password" placeholder="Пароль" required>
                    </label>
                    <button class="btn btn-primary mt-3" type="submit">Вход</button>
                    <a href="registration.php">Регистрация</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>

