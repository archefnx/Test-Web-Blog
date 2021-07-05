<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/main.css">

    <title>Topsite</title>
</head>
<body>
<header class="p-3 bg-dark text-white">
    <div class="container-fluid">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <img src="img/top.png" height="40">

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 text-info">Главная</a></li>
                <li><a href="/about.php" class="nav-link px-2 text-white">Про нас</a></li>
                <li><a href="/other.php" class="nav-link px-2 text-white">Другое</a></li>
            </ul>

            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="search" class="form-control form-control-dark" placeholder="Поиск..." aria-label="Search">
            </form>

            <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2"><a href="auth.php" target="_blank" class="a-control">Войти</a></button>
                <button type="button" class="btn btn-warning"><a href="reg.php" target="_blank" class="a-control">Регистрация</a></button>
            </div>
        </div>
    </div>
</header>
<div class="row">
    <main class="container col-md-8 p-3 text-center">
        <h1>Про нас</h1>
        <div class="container">
            <p>Suspendisse enim tortor, ornare eu efficitur at, vehicula non eros. Nullam porttitor vel nunc vitae pretium. Morbi eleifend ut lacus vel vulputate. Nullam venenatis mattis tristique. Donec luctus hendrerit urna, a dictum eros convallis nec. Duis eu dolor urna. Curabitur molestie tortor eget turpis bibendum, sed pretium nibh facilisis. In cursus ante ac mauris cursus, sed scelerisque sapien luctus. Integer a lorem feugiat, rutrum ipsum at, laoreet nisi.</p>
            <p>Ut ornare nibh id ligula blandit porttitor. Vestibulum pretium massa nibh, ac tincidunt leo scelerisque id. Aliquam scelerisque neque et risus placerat, eget suscipit justo faucibus. Cras porta elit et velit auctor, vitae dignissim felis ultrices. Proin sit amet aliquet neque. Ut sit amet est dignissim, sollicitudin dui eget, sagittis purus. Cras egestas at leo et laoreet. Vivamus egestas eget felis et placerat. Nulla sagittis, orci vel mattis euismod, justo nulla viverra lacus, nec maximus velit urna sed sapien. Sed at hendrerit lacus. Donec cursus eleifend lorem id laoreet.</p>
            <p>Mauriafafs vel nunc non ex placerat mattis et eu odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Morbi convallis tincidunt nibh, in dictum leo tempor vitae. Aliquam sodales rhoncus velit, eget interdum dui. Etiam lacus nisl, vulputate vel rhoncus ac, semper nec purus. Donec imperdiet sapien ac vestibulum euismod. Suspendisse potenti. Nam elementum arcu vel euismod imperdiet. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam pharetra iaculis sem sed lacinia. Aliquam placerat mauris non nunc accumsan varius. Duis cursus enim sit amet nunc laoreet mollis. Morbi mattis, nunc ac mollis rhoncus, enim libero convallis ligula, ut hendrerit libero eros vitae elit. Vivamus sed interdum orci.</p>
        </div>
    </main>

    <aside class="container col-md-4 text-light pl-5 pt-3">
        <h1>Сайдбар</h1>
    </aside>
</div>

<footer class="col-md p-3" size="5">
    <hr style="color: white">
    <div class="row contain t-10">
        <div class="col-md-3"></div>
        <div class="col-md-2 text-center">
            <strong class="align-content-center">Контакты</strong><br>
            <a href="">Служба поддержки</a><br>
            <a href="">Руководитель</a><br>
            <a href="">Оператор</a>
        </div>
        <div class="col-md-2 text-center">
            <strong>Другое</strong><br>
            <a href="">Доп. информация</a><br>
            <a href="">Источники</a>
        </div>
        <div class="col-md-2 text-center">
            <strong>Соц. сети</strong><br>
            <a href="">Facebook</a><br>
            <a href="">Instagram</a><br>
            <a href="">Telegram</a><br>
            <a href="">Twitter</a><br>
            <a href="">VK</a>
        </div>
        <div class="col-md-3"></div>

    </div>
</footer>

</body>
</html>