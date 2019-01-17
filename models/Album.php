<?php
class Album{

    private function connect(){
        include_once(ROOT.'/config/db.php');
        return $pdo = new PDO("mysql:host=".DB_HOST."; dbname=".DB_NAME, DB_USER, DB_PASSWORD);
    }
    
    public function getAlbum($id){
        
        $pdo = $this->connect();

        $query = "SELECT * FROM sort_values";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $sort_album_value = $result[0]['album_sort'];
        $sort_images_value = $result[0]['image_sort'];
        $control_album = $result[0]['album_control'];
        $control_images = $result[0]['image_control'];

        $query = "SELECT * FROM albums WHERE album_id > 0"; 
        $statement = $pdo->prepare($query);
        $statement->execute();
        $all_album_arr = $statement->fetchAll();
        $count = $statement->rowCount();  
        
        $notesCount = 12;  
        $from = ($id - 1) * $notesCount;

        $query = "SELECT * FROM albums WHERE album_id > 0 ORDER BY `$sort_album_value` ".$control_album." LIMIT $from, $notesCount";      
        $statement = $pdo->prepare($query);
        $statement->execute();
        $albums_arr = $statement->fetchAll();

        foreach($albums_arr as $key => &$value){
            $queryIMG = "SELECT name_img FROM images WHERE parent_album_id=$value[album_id] ORDER BY `$sort_images_value` $control_images LIMIT 1";
            $pdo = $this->connect();
            $sttmIMG = $pdo->prepare($queryIMG);
            $sttmIMG->execute();
            $path = $sttmIMG->fetchAll();
            array_push($value, $path[0][0]);
        }

        return array('album_arr'=>$albums_arr,'count_album'=>$count, 'notesCount' => $notesCount);
    }
    

    public function getAlbumOne($id){
        $query = "SELECT *"
                ."FROM albums WHERE album_id=$id";
        $pdo = $this->connect();
        $sttm = $pdo->prepare($query);
        $sttm->execute();
        return $sttm->fetchAll();
    }
    
    
    public function getImages($id){
        $pdo = $this->connect();

        $query = "SELECT * FROM sort_values";

        $statement = $pdo->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        //$sort_album_value = $result[0]['album_sort'];
        $sort_images_value = $result[0]['image_sort'];
        //$control_album = $result[0]['album_control'];
        $control_images = $result[0]['image_control'];

        $query = "SELECT name_img FROM images WHERE parent_album_id=$id ORDER BY `$sort_images_value` ". $control_images;
       
        $sttm = $pdo->prepare($query);
        $sttm->execute();
        return $sttm->fetchAll();
    }


}








