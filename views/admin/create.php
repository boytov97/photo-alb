<?php include ROOT.'/views/templates/main.php' ?>


<div class="mycontent">
    <div class="row">
        <div class="col-md-3 create-album-link">
            <a href="http://photoalb:<?=PORT?>/admin/create"> <button class="btn btn-primary">Создать альбом</button> </a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-form">Создание фотоальбома</div>
                    <form id="form_photo" action="http://photoalb:<?=PORT?>/admin/setname" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <label required for="exampleInputEmail1">Название фотоальбома:</label>
                                <input type="text" class="form-control" id="name_album" name="name_album">
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1">Дата создание фотоальбома:</label>
                                <input required type="datetime-local" class="form-control" id="datetime" name="date" value="<?= date('Y-m-d')."T".date('H:i');?>">

                                
                             </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label for="exampleInputEmail1">Описание фотоальбома:</label>
                                <textarea class="form-control" id="desc_album" name="description"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4" id="file_imput_parent">
                                <label for="exampleInputEmail1"><h5>Выберите фотографий для загрузки</h5></label>
                                <input type="file" accept=".jpg, .jpeg, .png" name="files[]" multiple="multiple" id="file_inp">
                                <p type="hidden" name="count_img" class="count_img" id="message_counter"></p> 
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
                        <button type="submit" class="btn btn-primary" id="btn_create_album" name="create_btn">Создать</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ROOT.'/views/templates/footer.php' ?>
<script src="\assets\js\createAlbum.js"></script>
