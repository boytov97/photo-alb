<?php include ROOT.'/views/templates/main.php' ?>

<div class="mycontent">
    <div class="row">
        <div class="col-md-3 create-album-link">
            <a href="#"> <button class="btn btn-primary">Создать альбом</button> </a>
        </div>
        <div class="col-md-9">
            <div class="row">
                
                <?php
                if ($successcreatealbum) {
                    echo 'Альбом успешно создан<br>';
                }
                if ($successcreatedimages) {
                    echo 'Фотографий успешно загружены<br><hr>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include ROOT.'/views/templates/footer.php' ?>