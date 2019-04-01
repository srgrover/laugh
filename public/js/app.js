$( document ).ready(function() {
    console.log( "ready!" );


    /* MOSTAR TAGS EN view_post */
    var tags_section = $('.tags_section');
    var tags_hide = $('.tags_hide');
    var tags = $.trim(tags_hide.text()).split("-");

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
        $.ajax({
            url: URL + '/post/dislike/' + $(this).attr("data-id"),
            type: 'GET',
            success: function (response) {
            }
        })
    });

});