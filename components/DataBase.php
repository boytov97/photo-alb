<?php

class DataBase {
    public function connect() {
        include_once(ROOT.'/config/db.php');
        return $pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    }
    
}
