<?php
session_start();

$mysql = new mysqli('localhost', 'root', '', 'myblog');
$article_ID = $_GET['id'];

$sql = "SELECT * FROM articles WHERE ID = '$article_ID'";
$article = $mysql->query($sql)->fetch_assoc();

if (isset($_POST['avtor']) and isset($_POST['email']) and isset($_POST['text'])) {
    $avtor = $_POST['avtor'];
    $email = $_POST['email'];
    $text = $_POST['text'];

    $sql_sozdat_comentaii = "INSERT INTO comments (article_ID, avtor, email, text) VALUES ('$article_ID', '$avtor', '$email', '$text')";
    $mysql->query($sql_sozdat_comentaii);
}

$sql_comments = "SELECT * FROM comments WHERE article_ID = '$article_ID'";
$comments = $mysql->query($sql_comments)->fetch_all();

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

    <title><?php echo $article['nazvanie'] ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/index.php">Мой блог</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>*
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/index.php">Статьи</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login.php">Авторизация</a>
                <li class="nav-item">
                    <a class="nav-link" href="/registration.php">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout.php">Выход</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid m-0 p-0">
    <div class="row">
        <div class="col-lg-12">
            <div class="fon"
                 style="background: url('/files/fon.jpg'); height: 200px; background-repeat: repeat-x;"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1><?php echo $article['nazvanie'] ?></h1>
            <h4 class="text-secondary">Автор: <?php echo $article['avtor'] ?> | Дата
                создания: <?php echo $article['sozdanie'] ?></h4>
            <?php if (isset($_SESSION['user'])) {?>
            <a href="redactor.php?id=<?php echo $article_ID ?>" class="btn btn-primary">Редактировать</a>
            <?php } ?>
            <hr>
            <p><?php echo $article['text'] ?></p>
            <hr>
            <h4>Комментарии</h4>
            <div class="comentarii">
                <?php
                    if ($comments) {
                        foreach ($comments as $i => $comment) {
                            $avtor = $comment[1];
                            $email = $comment[2];
                            $text = $comment[3];

                            echo "<div class='card mt-2'>";
                            echo "<div class='card-header'>";
                            echo "Комментарий";
                            echo "</div>";
                            echo "<div class='card-body'>";
                            echo "<blockquote class='blockquote mb-0'>";
                            echo "<p>$avtor</p>";
                            echo "<footer class='blockquote-footer'>$text</footer>";
                            echo "</blockquote>";
                            echo "</div>";
                            echo "</div>";
                        }
                    }
                ?>
            </div>
            <hr>
            <h4>Оставить комментарий</h4>
            <div class="sozdat_commentariy">
                <form action="" method="POST">
                    <label class="w-100" for="">
                        Имя<br>
                        <input class="form-control" type="text" name="avtor" placeholder="Имя" required>
                    </label>
                    <label class="w-100" for="">
                        Почта<br>
                        <input class="form-control" type="text" name="email" placeholder="Почта" required>
                    </label>
                    <label class="w-100" for="">
                        Комментарий<br>
                        <textarea class="form-control" name="text" id="" rows="10" placeholder="Комментарий" required></textarea>
                    </label>
                    <button class="btn btn-primary mt-3" type="submit">Отправить</button>
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


