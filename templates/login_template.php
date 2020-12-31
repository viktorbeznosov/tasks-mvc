<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Задачи <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/task/add">Добавить задачу</a>
                </li>

                <?php if(isset($_SESSION['admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login/logout">Выход</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Логин</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <h1>Логин</h1>

    <?php if(count($data['errors']) > 0): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($data['errors'] as $error): ?>
                    <li><?=$error?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if(count($data['messages']) > 0): ?>
        <div class="alert alert-success">
            <ul>
                <?php foreach ($data['messages'] as $message): ?>
                    <li><?=$message?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if(!isset($_SESSION['admin'])): ?>
        <form method="post" action="/login" id="add_task_form">
            <div class="form-group">
                <label for="exampleInputEmail1">Ваше имя</label>
                <input type="text" name="user_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите имя">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Ваш email</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
            </div>
            <div class="form-check">

            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php endif; ?>

</div>
</body>
</html>

