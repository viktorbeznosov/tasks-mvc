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
    <div class="nav-scroller bg-white box-shadow">
        <nav class="nav nav-underline">
            <a class="nav-link active" href="javascript:void(0)">Отсортировать</a>
            <a class="nav-link" href="<?=$data['sort_name_link']?>">
                <span class="<?php if($data['sort'] == 'user_name' || ($data['sort'] == '')): ?> color-grey <?php endif; ?>">По имени</span>
                <?php if ($data['sort'] != 'user_name' || $data['sort'] == 'user_name' && $data['order'] == 'desc'): ?>
                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                <?php else: ?>
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <?php endif; ?>
            </a>
            <a class="nav-link" href="<?=$data['sort_email_link']?>">
                <span class="<?php if($data['sort'] == 'email'): ?> color-grey <?php endif; ?>">По email</span>
                <?php if ($data['sort'] != 'email' || $data['sort'] == 'email' && $data['order'] == 'desc'): ?>
                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                <?php else: ?>
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <?php endif; ?>
            </a>
            <a class="nav-link" href="<?=$data['sort_status_link']?>">
                <span class="<?php if($data['sort'] == 'status'): ?> color-grey <?php endif; ?>">По статусу</span>
                <?php if ($data['sort'] != 'status' || $data['sort'] == 'status' && $data['order'] == 'desc'): ?>
                    <i class="fa fa-arrow-up" aria-hidden="true"></i>
                <?php else: ?>
                    <i class="fa fa-arrow-down" aria-hidden="true"></i>
                <?php endif; ?>
            </a>
        </nav>
    </div>

    <div class="row">

        <?php foreach ($data['tasks'] as $item): ?>
            <div class="col-md-4">
                <h2>
                    <?=$item['user_name']?>
                </h2>
                <?php if ($item['status'] == 1):?>
                    <span class="badge badge-pill badge-success">Выполнено</span>
                <?php endif;?>
                <?php if ($item['edited'] == 1):?>
                    <span class="badge badge-pill badge-warning">отредактировано</span>
                <?php endif;?>
                <h3><?=$item['email']?></h3>
                <p>
                    <?=$item['text']?>
                </p>
                <?php if(isset($_SESSION['admin'])): ?>
                    <p><a class="btn btn-secondary" href="/task/edit/<?=$item['id']?>"  role="button">Редактировать »</a></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>

    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="<?=$data['pagination']['prev_link']?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only"></span>
                </a>
            </li>
            <?php foreach ($data['pagination']['links'] as $link): ?>
                <li class="page-item <?=$link['active']?>">
                    <a class="page-link" href="<?=$link['link']?>">
                        <?=$link['page']?>
                    </a>
                </li>
            <?php endforeach;?>
            <li class="page-item">
                <a class="page-link" href="<?=$data['pagination']['next_link']?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only"></span>
                </a>
            </li>
        </ul>
    </nav>
</div>

</body>
</html>

