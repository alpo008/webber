<?php

use m\M_Params;
use m\M_PDO;

require ('config.php');
$user_id = (isset($_POST['uid'])) ? $_POST['uid'] : NULL;
$action = (isset($_POST['action'])) ? $_POST['action'] : NULL;
$params = M_Params::Instance()->randomParams();
$circle = M_Params::Instance()->randomCircle($params);
$params['user_id'] = $user_id;

if (!!$user_id && !! $action){
    switch ($action){
        case 'insert':
            $result = M_PDO::Instance()->Insert('circles', $params);
            echo (preg_match("/[0-9]+/", $result)) ? $circle : NULL;
            break;
        case 'delete':
            $where = 'user_id =' . $user_id;
            $result = M_PDO::Instance()->Delete('circles', $where);
            echo (preg_match("/[0-9]+/", $result)) ? 'deleted' : $result;
            break;
        case 'check':
            echo M_Params::Instance()->countTouchings($user_id);
            break;
    }
}