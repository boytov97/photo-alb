<?php include ROOT.'/views/templates/main.php' ; ?>

<div class="mycontent">
    <div class="row">
        <?php require_once(ROOT.'\views\templates\formauth.php');?>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-form">Все ваши альбомы</div>
                    
                    
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                              <li class="page-item">
                                <a class="page-link" href="<?= $id-1 == 0 ? 1:$id-1 ?>" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">Previous</span>
                                </a>
                              </li>
                              <?php for($j = 1; $j <= ceil($album_count / $notesCount); $j++) { ?>

                                <li class="page-item"><a class="page-link" href="<?=$j?>"><?=$j?></a></li>

                              <?php } ?>
                              <li class="page-item">
                                <a class="page-link" href="<?= $id+1 > ceil($album_count / $notesCount) ? $id:$id+1 ?>" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only">Next</span>
                                </a>
                              </li>
                            </ul>
                         </nav>
                    <form>
                        <div  class="row" style="max-width: 1000px">
 
                            <?php foreach ($arrayAlbum as $value){?>
                            <div class="card album-card">
                                <div class="card-body">
                                    <a href="<?='/album/view/'.$value['album_id']?>" class="card-title">
                                        <div class="img-albums">
                                            <img src="/assets/gallery/<?=$value[5]?>">
                                        </div>
                                        <?=$value['name_album'];?> (<?=$value['count_img']?>)
                                    </a>
                                </div>
                            </div>
                            <?php }?>
                        </div>
                       
                        
                     </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include ROOT.'/views/templates/footer.php' ?>


