<?php
$mysql = new mysqli('localhost', 'root', '', 'myblog');
?>
<!doctype html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Мой блог</title>
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
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="fon"
                 style="background: url('/files/fon.jpg'); height: 200px; background-repeat: repeat-x;"></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-3 mb-5">
            <?php if (isset($_SESSION['user'])) { ?>
                <a class="btn btn-primary" href="sozdt_article.php">Создать статью</a>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    Чтобы добавить статью, нужно сначала авторизиваться на сайте
                </div>
            <?php } ?>
            <div class="my-articles mt-4">
                <?php
                $sql = "SELECT * FROM articles ORDER BY sozdanie DESC";
                $articles = $mysql->query($sql)->fetch_all();

                foreach ($articles as $article_ID => $article) {
                    $ID = $article[0];
                    $nazvanie = $article[1];
                    $text = $article[2];
                    $avtor = $article[3];
                    $sozdanie = $article[4];

                    echo "<div class='article mt-4'>";
                    echo "<div class='row'>";
                    echo "<div class='col-lg-4'>";
                    echo "<img class='rounded' src='https://picsum.photos/300/200' width='100%'>";
                    echo "</div>";

                    echo "<div class='col-lg-8'>";
                    echo "<div class='nazvanie'><h4>$nazvanie</h4></div>";
                    echo "<div class='avtor'>$avtor</div>";
                    echo "<div class='sozdanie'>$sozdanie</div>";
                    echo "<hr>";
                    echo "<div class='text'>$text</div>";
                    echo "<a class='btn btn-primary' href='articles/article.php?id=$ID'>Читать</a>";
                    echo "</div></div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>
</html>
