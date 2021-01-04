<?php

class LoginController
{
    public function index()
    {
        $view = new TasksView();
        $task = new Task();

        $errors = array();
        $messages = array();

        if (isset($_POST['user_name']) && $_POST['user_name'] == ''){
            $errors[] = 'Введите ваше имя!';
        }
        if (isset($_POST['password']) && $_POST['password'] == ''){
            $errors[] = 'Введите ваш пароль!';
        }
        if (isset($_POST['user_name']) && $_POST['user_name'] != '' && isset($_POST['password']) && $_POST['password'] != '' && ($_POST['user_name'] != 'admin' || $_POST['password'] != '123')){
            $errors[] = 'Неверно введены логин или пароль!';
        }

        if (count($_POST) > 0 && count($errors) == 0){
            $messages[] = 'Добро пожаловать';
            $_SESSION['admin'] = true;
        }

        $data = array(
            'errors' => $errors,
            'messages' => $messages
        );


        $view->render('login_template', $data);
    }

    public function logout(){
        $view = new TasksView();
        $task = new Task();

        session_destroy();

        print_r($_SESSION);

        header('Location: /login');
    }
}