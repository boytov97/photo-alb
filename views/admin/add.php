<?php include ROOT.'/views/templates/main.php' ?>


<div class="mycontent">
    <div class="row">
        <div class="col-md-3 create-album-link">
            <a href="http://photoalb:<?=PORT?>/admin/create"> <button class="btn btn-primary">Создать альбом</button> </a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-form">Добавления фотографий. Альбом: NAME</div>
                    <form action="http://photoalb:<?=PORT?>/admin/addindb" method="POST" method="POST" enctype="multipart/form-data">
                        <input type="input" hidden name="album_id" value="<?=$_POST[album_id]?>">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Выберите фотографий для загрузки</label>
                                <input type="file" accept=".jpg, .jpeg, .png" name="files[]" multiple="multiple" id="file_inp">
                            </div>
                        </div>
                        <div class="row added_image" id="child_form">

                        </div>
                        <style>
                            .px250{width: 250px; padding: 0;}
                            .px250 input{width: inherit; margin-top:10px;}
                        </style>
                        <hr>
                        <input type="button" id="input_decs_reset" value="Сбросить имя">
                        <input type="reset" id="input_all_reset" value="Сбросить все">
                        <hr>
                        <button type="submit" class="btn btn-primary" id="btn_add_photos" name="add_photo">Добавить</button>
                     </form>

                </div>
            </div>

        </div>
    </div>

</div>




<?php include ROOT.'/views/templates/footer.php' ?>
<script src="\assets\js\addimages.js"></script>