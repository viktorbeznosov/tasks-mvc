<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 30.12.20
 * Time: 19:45
 */

class Task
{

    const SIZE_PAGE = 3;

    public function __construct()
    {
        $this->db = DataBase::connect();
    }


    public function getCount(){
        $query = "SELECT COUNT(*) AS cnt FROM `tasks`";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $count = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $count[0]['cnt'];
    }

    public function pagesCount(){
        return ceil($this->getCount() / self::SIZE_PAGE);
    }

    public function getPagination($page = 1, $sort = '', $ask = ''){
        $pagination = array();
        $links = array();

        for($i = 1; $i <= $this->pagesCount(); $i++){
            $p = '';
            $srt = '';
            $order =  ($ask != '' && $sort != '') ? '&order=' . $ask : '';
            if ($i > 1){
                $p = '?page='.$i;
            }
            if ($sort != ''){
                $srt = ($p == '') ? '?sort=' . $sort : '&sort=' . $sort;
            }

            $links[] = array(
                'page' => $i,
                'active' => $i == $page ? 'active' : '',
                'link' => $i == $page ? 'javascript:void(0)' : './' . $p . $srt . $order,
            );

            $pagination = array(
                'links' => $links,
                'next_link' => ($page == $this->pagesCount()) ? 'javascript:void(0)' : './?page=' . ($page+1) . $srt . $order,
                'prev_link' => ($page == 1) ? 'javascript:void(0)' : './?page=' . ($page-1) . $srt . $order,
            );
        }

        return $pagination;

    }

    public function getSortLink($page = 1, $sort = '', $ask = ''){
        $p = '';
        $srt = '';

        $order =  ($ask != '' && $sort != '') ? '&order=' . $ask : '';
        if ($page > 1){
            $p = '?page='.$page;
        }
        if ($sort != ''){
            $srt = ($p == '') ? '?sort=' . $sort : '&sort=' . $sort;
        }

        $link = './' . $p . $srt . $order;

        return $link;
    }

    public function getAll($page = 1, $sort = 'user_name', $ask = 'ASC'){


        $size_page = self::SIZE_PAGE;
        // Вычисляем с какого объекта начать выводить
        $offset = ($page-1) * $size_page;

        $order = ($sort == '') ? '' : ' ORDER BY ' . $sort . ' ' . $ask;

        $query = "
            SELECT id, user_name, email, text, status, edited 
            FROM `tasks` 
            ".$order."
            LIMIT {$offset},{$size_page}";

        $sth = $this->db->prepare($query);
        $sth->execute();
        $tasks = $sth->fetchAll(PDO::FETCH_ASSOC);

        return $tasks;
    }

    public function getTask($id){
        $sth = $this->db->prepare("SELECT id, user_name, email, text, status, edited FROM `tasks` WHERE `id` = ?");
        $sth->execute(array($id));
        $task = $sth->fetch(PDO::FETCH_ASSOC);

        return $task;
    }

    public function addTask($user_name, $emsil, $text){
        $sth = $this->db->prepare("INSERT INTO `tasks` SET `user_name` = :user_name, `email` = :email, `text` = :text");
        $sth->execute(array(
            'user_name' => $user_name,
            'email' => $emsil,
            'text' => $text
        ));

        // Получаем id вставленной записи
        $insert_id = $this->db->lastInsertId();

        return $insert_id;
    }

    public function updateTask($id, $text, $status){
        $sth = $this->db->prepare("SELECT id, user_name, email, text, status, edited FROM `tasks` WHERE `id` = ?");
        $sth->execute(array($id));
        $task = $sth->fetch(PDO::FETCH_ASSOC);

        if ($task['edited'] == 0 &&  $task['text'] != $text){
            $sth = $this->db->prepare("UPDATE `tasks` SET `text` = :text, `edited` = :edited, `status` = :status WHERE `id` = :id");
            $sth->execute(array(
                'text' => $text,
                'edited' => 1,
                'status' => $status,
                'id' => $id
            ));
        } else {
            $sth = $this->db->prepare("UPDATE `tasks` SET `text` = :text, `status` = :status WHERE `id` = :id");
            $sth->execute(array(
                'text' => $text,
                'status' => $status,
                'id' => $id
            ));
        }


    }


}