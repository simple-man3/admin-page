$(document).ready(function () {

    window.onload=function () {
        if($('.spisok_admin_content').hasClass('display_submenu_admin_content'))
        {
            $('.link_admin_page_content').addClass('admin_content_click');
        }
    };

    if($('.link_admin_page_content').hasClass('admin_content_click'))
    {
        $('.link_admin_page_content').removeClass('admin_content_click');
    }

    // Стрелка в пункте Контент
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

    //При нажатии на кнопку "Добавить категорию, она становится неактивной"
    $('.btn_category').click(function () {
        $('.wrap_ajax_form').addClass('display_form');
        $(this).addClass('btn_disapled');
    });

    // region редактор записей
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
        console.error( error );
    } );
    // endregion

    //При нажатии на главную checkbox, отсальные checkbox тоже отмечаются
    $('.main_checkbox_admin_page').click(function () {
        if($(this).prop('checked'))
        {
            $('.row_checkbox').prop('checked',true);
            $('.disapled_two_tags').css('display','none');
        }else {
            $('.row_checkbox').prop('checked',false);
            $('.disapled_two_tags').css('display','block');
        }
    });

    // Если нажат хотя бы один checkbox, то можно выбирать действия
    $('.row_checkbox').click(function () {
        var variable=each_check();
        if(variable)
            $('.disapled_two_tags').css('display','none');
        else
            $('.disapled_two_tags').css('display','block');
    });

    function each_check()
    {
        var i=0;
        $('.row_checkbox').each(function () {
            if($(this).prop('checked'))
                 i=1;
        });

        return i;
    }

    //Если chebox нажат и действие выбрано, то появляется кнопка "Применить"
    $('.select').change(function () {
        $('.input_tag').css('display','block');
    });
});
