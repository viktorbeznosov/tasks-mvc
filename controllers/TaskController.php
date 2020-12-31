<?php

class TaskController{

  public function index(){
      $page = (isset($_GET['page'])) ? $_GET['page'] : 1;
      $sort = (isset($_GET['sort']) && in_array($_GET['sort'],['user_name','email','status'])) ? $_GET['sort'] : '';
      $order = (isset($_GET['order']) && $_GET['order'] == 'desc') ? $_GET['order'] : '';

      $view = new TasksView();
      $task = new Task();

      $sort_name_link = (($sort != 'user_name' && $order =='') || ($sort == 'user_name' && $order == 'desc')) ? $task->getSortLink($page, 'user_name', 'asc') : $task->getSortLink($page, 'user_name', 'desc');
      $sort_email_link = (($sort != 'email' && $order =='') || ($sort == 'email' && $order == 'desc')) ? $task->getSortLink($page, 'email', 'asc') : $task->getSortLink($page, 'email', 'desc');
      $sort_status_link = (($sort != 'status' && $order =='') || ($sort == 'status' && $order == 'desc')) ? $task->getSortLink($page, 'status', 'asc') : $task->getSortLink($page, 'status', 'desc');

      $data = array(
          'tasks' => $task->getAll($page,$sort,$order),
          'pages' => $task->pagesCount(),
          'current_page' => $page,
          'pagination' => $task->getPagination($page, $sort, $order),
          'sort' => $sort,
          'order' => $order,
          'sort_name_link' => $sort_name_link,
          'sort_email_link' => $sort_email_link,
          'sort_status_link' => $sort_status_link,
      );

      $view->render('tasks_template', $data);
  }

  public function edit(){
      $taskId = (isset(func_get_args()[0][0])) ? func_get_args()[0][0] : false;

      $view = new TasksView();
      $task = new Task();

      $errors = array();
      $messages = array();

      $taskItem = $task->getTask($taskId);

      if(!$taskId || !$taskItem){
          header('Location: /');
      }

      if (isset($_POST['status']) && $_POST['status'] == 'on'){
          $status = 1;
      } else {
          $status = 0;
      }


      if (isset($_POST['text']) && $_POST['text'] == ''){
          $errors[] = 'Текст задачи не должен быть пустым!';
      }

      if (count($_POST) > 0 && count($errors) == 0){
          $text = $_POST['text'];
          $task->updateTask($taskId, $text, $status);

          $messages[] = 'Задача сохранена';
          $taskItem = $task->getTask($taskId);
      }

      $data = array(
          'errors' => $errors,
          'messages' => $messages,
          'task' => $taskItem
      );


      $view->render('edit_task_template', $data);
  }

  public function add(){
      $view = new TasksView();
      $task = new Task();

      $errors = array();
      $messages = array();

      if (isset($_POST['user_name']) && $_POST['user_name'] == ''){
          $errors[] = 'Введите ваше имя!';
      }
      if (isset($_POST['email']) && $_POST['email'] == ''){
          $errors[] = 'Введите ваш email!';
      }
      if (isset($_POST['text']) && $_POST['text'] == ''){
          $errors[] = 'Введите текст задачи!';
      }

      if (isset($_POST['email']) && $_POST['email'] != ''){
          $re = '/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/';
          preg_match($re, $_POST['email'], $matches, PREG_OFFSET_CAPTURE);
          if(count($matches) == 0){
              $errors[] = 'Email введен не коректно!';
          }

      }

      if (count($_POST) > 0 && count($errors) == 0){
          $user_name = addslashes($_POST['user_name']);
          $email = addslashes($_POST['email']);
          $text = addslashes($_POST['text']);

          $taskId = $task->addTask($user_name, $email, $text);

          $messages[] = 'Задача схранена';
      }

      $data = array(
          'errors' => $errors,
          'messages' => $messages
      );

      $view->render('add_task_template', $data);
  }

//  public function delete(){
//
//  }
//
//  public function render(){
//
//  }

}
