<?php include ROOT.'/views/templates/main.php' ?>


<div class="mycontent">
    <div class="row">
        <?php require_once(ROOT.'\views\templates\formauth.php');?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-form">Все фотографий из альбома</div>
                    <h1><?=$albumDesc[0]['name_album']?></h1>
                    <p>Дата создание альбома: <?=$albumDesc[0]['date']?></p>
                    <p><?=$albumDesc[0]['description']?></p>
                    <hr>
                    <form>
                        <div  class="row album-view">
                            
                            <?php foreach ($images as $value){ ?>
                            
                            <div class="col-lg-2 every-image">
                                <img src="/assets/gallery/<?=$value['name_img']?>">
                            </div>
                            <?php } ?>
                            
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include ROOT.'/views/templates/footer.php' ?>