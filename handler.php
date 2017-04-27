<?php
require ('config.php');
$user_id = (isset($_POST['uid'])) ? $_POST['uid'] : NULL;
$action = (isset($_POST['action'])) ? $_POST['action'] : NULL;

$params = M_Params::Instance()->randomParams();
$params['user_id'] = $user_id;


if (!!$user_id && !! $action){
    switch ($action){
        case 'insert':
            $result = M_PDO::Instance()->Insert('circles', $params);
            echo $result;
            break;
    }
}



