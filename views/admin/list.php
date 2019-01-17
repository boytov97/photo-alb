<?php include ROOT.'/views/templates/main.php' ?>


<div class="mycontent">
    <div class="row">
        <div class="col-md-3 create-album-link">
            <a href="http://photoalb:<?=PORT?>/admin/create"> <button class="btn btn-primary">Создать альбом</button> </a>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-form">Настрйка сортировок</div>
                    <form action="http://photoalb:<?=PORT?>/admin/editsortvalue" method="post">
                        <div class="form-group row sort-setting">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Сортировака альбомов</label>
                            <div class="col-sm-4">
                              <select id="inputState" class="form-control" name="select_album">
                                <option value="name_album" <?php if($result_sort[0]['album_sort'] == 'name_album')  echo 'selected'; ?>>Имя</option>
                                <option value="count_img" <?php if($result_sort[0]['album_sort'] == 'count_img')  echo 'selected'; ?>>Размер</option>
                                <option value="date" <?php if($result_sort[0]['album_sort'] == 'date')  echo 'selected'; ?>>Дата</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <select id="inputState" class="form-control" name="select_album_cont">
                                <option value="" <?php if($result_sort[0]['album_control'] == '')  echo 'selected'; ?>>По возрастанию</option>
                                <option value="DESC" <?php if($result_sort[0]['album_control'] == 'DESC')  echo 'selected'; ?>>По убыванию</option>
                              </select>
                            </div>
                         </div>
                
                        <div class="form-group row sort-setting">
                            <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Сортировака фотографий</label>
                            <div class="col-sm-4">
                              <select id="inputState" class="form-control" name="select_image">
                                <option value="name_img" <?php if($result_sort[0]['image_sort'] == 'name_img')  echo 'selected'; ?>>Имя</option>
                                <option value="size" <?php if($result_sort[0]['image_sort'] == 'size')  echo 'selected'; ?>>Размер</option>
                                <option value="date" <?php if($result_sort[0]['image_sort'] == 'date')  echo 'selected'; ?>>Дата</option>
                              </select>
                            </div>
                            <div class="col-sm-4">
                              <select id="inputState" class="form-control" name="select_image_cont">
                                <option value="" <?php if($result_sort[0]['image_control'] == '')  echo 'selected'; ?>>По возрастанию</option>
                                <option value="DESC" <?php if($result_sort[0]['image_control'] == 'DESC')  echo 'selected'; ?>>По убыванию</option>
                              </select>
                            </div>
                         </div>
                    <button type="submit" class="btn btn-primary">Изменить</button>
             </form>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="title-form">Таблица альбомов</div>
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название альбома</th>
                            <th scope="col">Описание</th>
                            <th scope="col">Коли-о фото</th>
                            <th scope="col">Действия</th>
                          </tr>
                        </thead>
                        <tbody>
                            <form action="http://photoalb/admin/add" method="POST">  
                        <?php 
                        $i = 0;
                        foreach($arr as $value){ $i++; ?>
                          <tr>
                            <th scope="row"><?=$i;?></th>
                            <td><?=$value['name_album']?></td>
                            <td><?=$value['description']?></td>
                            <td><?=$value['count_img']?></td>
                            <td><button>Удалить альбом</button><button name="album_id" value="<?=$value['album_id']?>">Добавить фото</button></td>
                          </tr>
                          <?php } ?>
                            </form>
                        </tbody>
                      </table>
                    
                </div>
            </div>
            
        </div>
    </div>

</div>




<?php include ROOT.'/views/templates/footer.php' ?>