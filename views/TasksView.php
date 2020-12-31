<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 30.12.20
 * Time: 19:51
 */

class TasksView
{
    public function __construct()
    {

    }

    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function render($template_view, $data = null)
    {
        include  $_SERVER['DOCUMENT_ROOT'] . '/templates/' . $template_view . '.php';
    }
}