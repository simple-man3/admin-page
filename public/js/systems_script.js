$(document).ready(function () {

    $('.admin_content').click(function () {
        if(!$(this).hasClass('admin_content_click'))
        {
            $(this).addClass('admin_content_click');
            $('.spisok_admin_content').addClass('display_submenu_admin_content');
        }
        else
        {
            $(this).removeClass('admin_content_click');
            $('.spisok_admin_content').removeClass('display_submenu_admin_content');
        }
    });

    // region редактор записей
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
            console.error( error );
        } );
    // endregion

    // region добавление категорий
        $('.btn_add_category').click(function () {
            $(this).addClass('change_opacity');
            $('.wrap_add_category').css('display','block');
        });

        // Добавление категорий с помощью ajax
        $('.btn_add_category_ajax').click(function () {
            if($('.area_add_category').val())
            {
                $.ajax({
                    url:"add_content/add_category",
                    method:'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        category_name:$('.area_add_category').val(),
                    },
                    dataType:'json',
                    success:function (data) {
                        if(data)
                        {
                            console.log(data);
                            $('.dispaly_all_category').append(data);
                        }
                        else
                            console.log("net");
                    }
                });

                success_add_category('.area_add_category');
            }else
            {
                $('.area_add_category').attr('placeholder','Введите название категории!')
            }
        });

        function success_add_category(class_)
        {
            $(class_).attr('placeholder','');
            $(class_).val('');
        }
    // endregion
});
