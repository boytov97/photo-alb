<?php

class AuthenticationController{
    public function actionExit(){
        session_destroy();
        echo '<script> location.href = "'.$_SERVER['HTTP_REFERER'].'";</script>';
    }
    
    //Автоизация
    public function actionIndex(){
        
        if (!Authentication::auth($_POST['log'], $_POST['pass'])) {
            echo '<script> location.href = "'.$_SERVER['HTTP_REFERER'].'";</script>';
            //echo Authentication::auth($_POST['log'], $_POST['pass']);
        }else{
            echo '<script> location.href = "'.$_SERVER['HTTP_REFERER'].'";</script>';
            //echo Authentication::auth($_POST['log'], $_POST['pass']);
        }
    }
}
