$( document ).ready(function() {
    /* MOSTAR TAGS EN view_post */
    var tags_section = $('.tags_section');
    var tags_hide = $('.tags_hide');
    var tags = $.trim(tags_hide.text()).split(",");

    tags.forEach(function (tag) {
        var ancla = $('<a/>', {
            'html' : tag,
            'class' : 'badge btn_border_primary tag_post mr-1',
            'href' : '#'
        });
        tags_section.append(ancla);
    });
    tags_hide.hide();

    /* HIDDE/SHOW BOTON SEGUIR EN list_users */
    $('.user-row').mouseover(function () {
        $(this).find('.btn_follow').removeClass( "d-none" );
        $(this).find('.span_karma').addClass( "d-none" );
        $(this).find('.span_rating').addClass( "d-none" );
    }).mouseout(function () {
        $(this).find('.btn_follow').addClass( "d-none" );
        $(this).find('.span_karma').removeClass( "d-none" );
        $(this).find('.span_rating').removeClass( "d-none" );
    });

    /* HIDDE/SHOW BOTON LIKE */
    $('.btn_like').unbind('click').click(function () {
        $(this).addClass("d-none");
        $(this).parent().find('.btn_unlike').removeClass("d-none");
        var likes = parseInt($('.btn_like').find('.badge').text());
        $('.btn_unlike').find('.badge').text(likes + 1);
        $.ajax({
            url: URL + '/post/like/' + $(this).attr("data-id"),
            type: 'GET',
            success: function (response) {
            }
        })
    });

    $('.btn_unlike').unbind('click').click(function () {
        $(this).addClass("d-none");
        $(this).parent().find('.btn_like').removeClass("d-none");
        var likes = parseInt($('.btn_unlike').find('.badge').text());
        $('.btn_like').find('.badge').text(likes - 1);

        $.ajax({
            url: URL + '/post/dislike/' + $(this).attr("data-id"),
            type: 'GET',
            success: function (response) {
            }
        })
    });

    /* HIDE/SHOW OPCIONES DE COMENTARIO */
    $('.box_comment').mouseover(function () {
        $(this).find('.options_comment').addClass('d-inline');
    }).mouseout(function () {
        $(this).find('.options_comment').removeClass('d-inline');
    });




    $('.btn_reply').click(function () {
        var user = $.trim($(this).parent().parent().parent().find('.comment_author').text());
        console.log(user);
        $('#comment_comment').text('@'+user+' ');
    });






    $('#btn_delete_comment').click(function () {
        var section_delete = $(this).parent().parent().parent().parent().parent().find('.content_comment');
        var content_delete_comment = section_delete.html();

        /* CHANGE CONTENT */
        var p_messaje = $('<p/>', {
            'html' : '¿Estás seguro de eliminar este comentario?',
            'class' : 'col-12 text-center'
        });
        var btn_delete_def = $('<a/>', {
            'html' : 'Eliminar',
            'class' : 'btn btn-danger btn-sm',
            'href' : URL + '/comment/delete/' + $(this).attr("data-id")
        });

        /* CANCEL DELETE */
        var btn_cancel_delete = $('<button/>', {
            'html' : 'Cancelar',
            'class' : 'btn btn-light btn-sm mr-3 border'
        });
        btn_cancel_delete.click(function () {
            backSectionDelete(content_delete_comment, section_delete);
        });

        section_delete.addClass('text-center pt-3 pb-3 rounded bg-light').empty();
        section_delete.append(p_messaje, btn_cancel_delete, btn_delete_def);
    });

    function backSectionDelete(content, object) {
        object.removeClass('text-center pt-3 pb-3 rounded bg-light').empty().html(content);
    }



});