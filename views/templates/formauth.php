<div class="col-md-3 create-album-link">

            <?php if(Authentication::isAuth()){  ?>
                <a href="http://photoalb:<?=PORT?>/admin"> <button class="btn btn-primary">Управления альбомов</button> </a>
            <?php }else{?>
            <!--Iss-->
            
            <form action="<?='http://photoalb:'.PORT.'/authentication';?>" method="post" class="from-enter">
                <div class="title-form">Вход с аккаунта</div>
                
                <div class="form-group row">
                  <div class="col-sm-12">
                      <input name="log" type="text" required class="form-control" id="log" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                      <input name="pass" type="password" required class="form-control" id="password" placeholder="Password">
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Войти</button>
                  </div>
                </div>
              </form>
            <?php } ?>
            <!--Iss-->
        </div>