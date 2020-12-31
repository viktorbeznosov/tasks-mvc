<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

<?php

echo '<title>Tasks</title>';
echo '<link rel="stylesheet" href="./assets/css/font-awesome.css">';
echo '<link rel="stylesheet" href="./assets/css/style.css">';

session_start();

//phpinfo();die();

spl_autoload_register(function ($className) {
    if (file_exists('system/' . $className . '.php')) {
        require_once 'system/' . $className . '.php';
    }
	else if (file_exists('controllers/' . $className . '.php')) {
        require_once 'controllers/' . $className . '.php';
    }
	else if (file_exists('models/' . $className . '.php')) {
        require_once 'models/' . $className . '.php';
    }
    else if (file_exists('views/' . $className . '.php')) {
        require_once 'views/' . $className . '.php';
    }
    else if (file_exists($className . '.php')) {
        require_once $className . '.php';
    }
});

new Bootstrap();
