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

    <h1>Редакировать задачу</h1>
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

    <form method="post" action="/task/edit/<?=$data['task']['id']?>" id="add_task_form">
        <div class="form-group">
            <label for="exampleInputEmail1">
                <?php if(!isset($_SESSION['admin'])): ?>
                    Ваше имя
                <?php else: ?>
                    Имя пользователя
                <?php endif; ?>
            </label>
            <span class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"><?=$data['task']['user_name']?></span>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">
                <?php if(!isset($_SESSION['admin'])): ?>
                    Ваш email
                <?php else: ?>
                    Email пользователя
                <?php endif; ?>
            </label>
            <span class="form-control" id="exampleInputPassword1" > <?=$data['task']['email']?> </span>
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">
                <?php if(!isset($_SESSION['admin'])): ?>
                    Введите текст
                <?php else: ?>
                    Текст
                <?php endif; ?>
            </label>
            <textarea class="form-control" name="text" id="exampleFormControlTextarea1" rows="3"><?=$data['task']['text']?></textarea>
        </div>
        <br>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1" name="status"
                <?php if ($data['task']['status'] == 1):?>
                    checked
                <?php endif; ?>
            >
            <label class="form-check-label" for="exampleCheck1">Выполнено</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

</body>
</html>

