<?php
class AdminController{
    
    public function __construct(){
        include_once ROOT.'/components/Auth.php';
        if (!Authentication::isAuth()) {
            echo '<script>location.href = "http://photoalb:'.PORT.'/album"</script>';
        }
    }
    
    //Список альбомов
    public function actionIndex(){
        include ROOT.'/models/Admin.php';
        $model = new Admin();
        
        $arr = $model->getListAlbum();

        /*Получаю значение от таблицы sort_values*/
        $result_sort = $this->getConfigSort();
        
        include ROOT.'/views/admin/list.php';
    }
    
    //Создание альбомы
    public function actionCreate(){
        include ROOT.'/views/admin/create.php';
    }
    
    //Добавить
    public function actionAdd(){

        if (count($_POST)>0) {
            include ROOT.'/views/admin/add.php';
        } else {
            exit("Страница не найдено. ERROR Not Found 404");
        }
    }

    public function actionAddindb(){

        if (count($_POST)>0) {
            
            include ROOT.'/models/Admin.php';
            $model = new Admin();
            $model->addImage($_POST['album_id'], $_FILES, $_POST['images']);

            echo '<script>location.href = "http://photoalb:'.PORT.'/admin"</script>';

        }  
    }
    
    //Задать имя фотографии
    public function actionSetname(){

        if(isset($_POST['create_btn'])){
            include ROOT.'/models/Admin.php';
            $model = new Admin();

            $name_album = $_POST['name_album'];
            $description = $_POST['description'];
            $date = $_POST['date'];
            $count_img = count(array_filter($_FILES['files']['name']));
            if ($count_img == 0) {
                exit('Выберите фотографий (AdminController actionSetname)');
            }
            
            $idAlbum = $model->createAlbum($name_album,$description,$date,$count_img);

            $i = 0;
            foreach($_FILES['files']['name'] as $key => $value){

                $token = openssl_random_pseudo_bytes(16);
 
                //Convert the binary data into hexadecimal representation.
                $token = bin2hex($token);

                $file_name = $_FILES['files']['name'][$key];
                $file_size = $_FILES['files']['size'][$key];
                $file_tmp_name = $_FILES['files']['tmp_name'][$key];
                

                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                $time = $token.time().".".$ext;

                $target = ROOT."\\assets\\gallery\\".$time;

                if(!$model->insertImages($time,$file_size,$file_tmp_name,$target,$i,$idAlbum)){
                    exit("Ошибка добавления в Базу Данных images");
                }
                $i++;
            }
            echo '<script>location.href = "http://photoalb:'.PORT.'/admin"</script>';
        }else{
            exit(ERR_404);
        }
    }

    public function getConfigSort() {
        include_once ROOT.'/models/Admin.php';
        $model = new Admin();

        return $res = $model->getConfigSort();
    } 


    public function actionEditsortvalue() {

        include_once ROOT.'/models/Admin.php';
        $model = new Admin();

        $model->setConfigSort($_POST);

        echo '<script>location.href = "http://photoalb:'.PORT.'/admin"</script>';
    }
    
}
