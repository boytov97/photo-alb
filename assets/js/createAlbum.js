//Show TABLE
        $('.table_info_files').hide();
        $('#input_all_reset').hide();
        $('#input_decs_reset').hide();

        
        //Показать фото при выборка фотографий---START
        var changeImg = function (){
            
            if($('#file_inp').get(0).files.length == 0){console.log('empty'); return false;}else{console.log('exists');}
            
            var thiselem = $('#file_inp').get(0) ;
            $('.table_info_files').show();
            $('#input_all_reset').show();
            $('#input_decs_reset').show();
            
            var htmltext = '';
            for (var i = 0; i < thiselem.files.length; i++) {
                var file = $('#file_inp').get(0).files;
                htmltext += ('<div class="img-setname"><img src="' + window.URL.createObjectURL(file[i]) + '"><div class="col-md-12 px250"><input class="input-decs" name="images-' + i + '" value="' + (thiselem.files[i].name).substring(0, thiselem.files[i].name.lastIndexOf(".")) + '" placeholder="Название фотографий" class="" type="text"></div></div>');
                //alert(thiselem.files.length);
            }
            $('#child_form').html(htmltext);
        }
        
        $('#file_inp').change(changeImg);
        $(document).ready(changeImg);
        //Показать фото при выборка фотографий---END
        
        //Очищение поля "Задать имя" при клике "Сбросить"
        $('#input_decs_reset').click(function(){
            $('.input-decs').attr('value','');
        });
        
        //Очищение и скрытие таблица при клике "Сбросить все"
        $('#input_all_reset').click(function(){
            $('#child_form').html(' ');
            $('.table_info_files').hide();
            $('#input_all_reset').hide();
            $('#input_decs_reset').hide();
        });
       
       //Очищение и скрытие таблица при клике "Выбрать"
        $('#file_inp').click(function(){
            $('#child_form').html(' ');
            $('.table_info_files').hide();
        });
        
        
        //Валдиация
        
        var name_album = $('#name_album');
        var desc_album = $('#desc_album');
        
        var validate = function(){
            
            if(isset(name_album) & isset(desc_album)){
                $('#btn_create_album').prop({'disabled': false});
            }else{
                $('#btn_create_album').prop({'disabled': true});
            }
        }
        
        function isset(elem){
            if (!elem.val()) {return false;}
            else{return true;}
        }
        
        name_album.on("keyup",validate);
        desc_album.on("keyup",validate);
        validate();

        