<?php

include_once ROOT.'/components/DataBase.php';

class Admin{

    public function createAlbum($name_album,$description,$date,$count_img){
        $db = new DataBase();
        $pdo = $db->connect();

        //Validation--->>>
        $queryIsExistsAlbum = "SELECT name_album FROM albums WHERE name_album = :name_album";
        $sttmIsExistsAlbum = $pdo->prepare($queryIsExistsAlbum);
        $existsAlbum = $sttmIsExistsAlbum->execute(array(':name_album' => $name_album));
        $exist = $sttmIsExistsAlbum->rowCount();
        $count_img;
        
        //Проверка наличии выбранных фотографии
        if ($count_img == 0) {exit("Выберите фотографий 0");}
        
        //Проверка отсутствие Альбома
        if ($exist == 1 || ($count_img==0)) {
            exit("Переименуйте им альбома. Существует альбом таким именем");
        }
        //Validation---<<<
        
        $query = "INSERT INTO albums(name_album, description, date, count_img)"
                ."VALUES (:name_album, :description, :date, :count_img); ";
        $sttm = $pdo->prepare($query);
        $successcreatealbum = $sttm->execute(
                array(':name_album' => $name_album,
                    ':description' => $description,
                    ':date' => $date,
                    ':count_img'=> $count_img)
            );
            if (!$successcreatealbum) {
                exit('Error : no created Album');
            }
        return $pdo->lastInsertId();;       
    }  
                  
    public function insertImages($time,$file_size,$file_tmp_name,$target,$i,$idAlbum){
                                
        $db = new DataBase();
        $pdo = $db->connect();

        $name = 'images-'.$i;
        $set_name_img = $_POST[$name]; 
        move_uploaded_file($file_tmp_name, $target);

        $query = "INSERT INTO images (parent_album_id, name_img, set_name_img, size, date) "
                . "VALUES (:parent_album_id, :name_img, :set_name_img, :size, now())";

        $sttm = $pdo->prepare($query); 
        
        $succes = $sttm->execute(
             array(
                 ':parent_album_id' => $idAlbum,
                 ':name_img' => $time,
                 ':set_name_img' => $set_name_img,
                 ':size' => $file_size
             ));
         return $succes;
    }

    
    
    public function getListAlbum(){
        $db = new DataBase();
        $pdo = $db->connect();

        $query = "SELECT * FROM sort_values";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $sort_album_value = $result[0]['album_sort'];
        $control_album = $result[0]['album_control'];

        //Validation--->>>
        $query = "SELECT * FROM albums ORDER BY `$sort_album_value` ".$control_album;
        $sttm = $pdo->prepare($query);
        $sttm->execute(
            /*array(
                ':name_album' => $name_album
                )*/
            );
        $arr = $sttm->fetchAll();
        
        return $arr;
        
        
    }

    public function addImage($album_id, $files, $images) {
        $db = new DataBase();
        $pdo = $db->connect();

        $i = 0;
        foreach($files['files']['name'] as $key => $value){

            $token = openssl_random_pseudo_bytes(16);
 
            //Convert the binary data into hexadecimal representation.
            $token = bin2hex($token);
            
            $file_name = $files['files']['name'][$key];
            $album_size = $files['files']['size'][$key];
            $album_tmp_name = $files['files']['tmp_name'][$key];
            $ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $time = $token.time().".".$ext;

            $set_name_img = $images[$key];

            $query = "INSERT INTO images (parent_album_id, name_img, set_name_img, size, date) "
                    . "VALUES (:parent_album_id, :name_img, :set_name_img, :size, now())";

            $sttm = $pdo->prepare($query); 
            
            $succes = $sttm->execute(
                 array(
                     ':parent_album_id' => $album_id,
                     ':name_img' => $time,
                     ':set_name_img' => $set_name_img,
                     ':size' => $album_size
                 )); 

            /*Загрузка на сервер*/
           // $target = ROOT."\\assets\\gallery\\".$_FILES['files']['name'][$key];
            $target = ROOT."\\assets\\gallery\\".$time;
            move_uploaded_file($album_tmp_name, $target);

            $i++;
        }

        $count_img = count($files['files']['name']);

        $query = "SELECT count_img FROM albums WHERE album_id = ".$album_id;
        $sttm = $pdo->prepare($query);     
        $sttm->execute(); 
        $res = $sttm->fetchAll();

        $count_img = $count_img + $res[0]['count_img'];

        $query = "UPDATE albums SET count_img = '$count_img' WHERE album_id = ".$album_id;

        $sttm = $pdo->prepare($query);     
        $sttm->execute(); 

    }

    public function getConfigSort() {
        $db = new DataBase();
        $pdo = $db->connect();

        $query = "SELECT * FROM sort_values";

        $sttm = $pdo->prepare($query);     
        $sttm->execute(); 
        return $result = $sttm->fetchAll();

        echo "<pre>";
        print_r($result);
        echo "</pre>";
    }

    public function setConfigSort() {
        $db = new DataBase();
        $pdo = $db->connect();

        $query = "UPDATE sort_values SET album_sort = :album_sort, image_sort = :image_sort, album_control = :album_control, image_control = :image_control WHERE id = 1";
        $sttm = $pdo->prepare($query);     
        $sttm->execute(
            array(
                ':album_sort' => $_POST['select_album'],
                ':image_sort' => $_POST['select_image'],
                ':album_control' => $_POST['select_album_cont'],
                ':image_control' => $_POST['select_image_cont']
            )
        ); 

    }
    
}


