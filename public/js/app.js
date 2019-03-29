$( document ).ready(function() {
    console.log( "ready!" );

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




    $('.user-row').mouseover(function () {
        $(this).find('.btn_follow').removeClass( "d-none" );
        $(this).find('.span_karma').addClass( "d-none" );
        $(this).find('.span_rating').addClass( "d-none" );
    }).mouseout(function () {
        $(this).find('.btn_follow').addClass( "d-none" );
        $(this).find('.span_karma').removeClass( "d-none" );
        $(this).find('.span_rating').removeClass( "d-none" );
    });



});