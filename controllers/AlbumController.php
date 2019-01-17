<?php

class AlbumController{

    
    public function actionIndex($id = 0){
        if ($id == 0) {
            echo "<script>location.href = 'http://photoalb".PORT."/album/1';</script>";
        }
        
        //Получаем модель
        include(ROOT.'/models/Album.php');
        $album = new Album;
        $fromModel = $album->getAlbum($id);
        
        $arrayAlbum = $fromModel['album_arr'];
        $album_count = $fromModel['count_album'];
        $notesCount = $fromModel['notesCount'];
        //Render indexView
        include ROOT.'/views/album/index.php';
    }

    public function actionView($id = 'empty'){
        //echo $id;
        include(ROOT.'/models/Album.php');
        $album = new Album;
        $albumDesc = $album->getAlbumOne($id);//Описание одного альбома
        $images = $album->getImages($id);//Все пути к файлу
        include ROOT.'/views/album/view.php';
    }

}



?>