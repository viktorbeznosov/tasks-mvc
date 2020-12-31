<?php

class Bootstrap
{

  public function __construct()
  {
    if (isset($_GET['path'])){
      $tokens = explode('/', rtrim($_GET['path'], '/'));

      $controllerName = ucfirst(array_shift($tokens)) . 'Controller';
      if (file_exists('controllers/'.$controllerName.'.php')) {
        $controller = new $controllerName();
        if (!empty($tokens)) {
					$actionName = array_shift($tokens);
					if (method_exists ( $controller , $actionName )) {
						$controller->{$actionName}(@$tokens);
					}
					else {
						$error = TRUE;
					}
				} else {
                    // default action
					$controller->index();
                }
      } else {
        $error = TRUE;
      }
    } else {
      $controllerName = 'TaskController';
      $controller = new $controllerName();
      $controller->index();
    }

    //Error404 page
    if ( isset($error) && $error ) {
      $controllerName = 'TaskController';
      $controller = new $controllerName();
      $controller->index();
    }
  }


}
