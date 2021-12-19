<?php

$mysql = new mysqli('localhost', 'root', '', 'myblog');

$ID = $_GET['id'];
$sql_article = "SELECT * FROM articles WHERE ID = '$ID'";
$article = $mysql->query($sql_article)->fetch_assoc();

if (isset($_POST['nazvanie']) and isset($_POST['avtor']) and isset($_POST['sozdanie']) and isset($_POST['text'])) {
    $nazvanie = $_POST['nazvanie'];
    $avtor = $_POST['avtor'];
    $sozdanie = $_POST['sozdanie'];
    $text = $_POST['text'];

    $sql = "UPDATE articles SET nazvanie = '$nazvanie', avtor = '$avtor', sozdanie = '$sozdanie', text = '$text' WHERE ID = '$ID'";
    $mysql->query($sql);
    header("Location: /articles/article.php?id=$ID");
}

$mysql->close();
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
        <div class="col-lg-4 offset-lg-4 mt-4">
            <form action="" method="post" id="sozdatArticle">
                <h4>Редактировать статью</h4>
                <label class="w-100" for="">
                    Название<br>
                    <input class="form-control" type="text" name="nazvanie" placeholder="Название" value="<?php echo $article['nazvanie']?>" required>
                </label>
                <label class="w-100" for="">
                    Автор<br>
                    <input class="form-control" type="text" name="avtor" placeholder="Автор" value="<?php echo $article['avtor']?>" required>
                </label>
                <label class="w-100" for="">
                    Дата создания<br>
                    <input class="form-control" type="date" name="sozdanie" value="<?php echo $article['sozdanie']?>" required>
                </label>
                <label class="w-100" for="">
                    Текст<br>
                    <textarea class="form-control" name="text" placeholder="Текст" rows="10" required><?php echo $article['text']?></textarea>
                </label>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
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

