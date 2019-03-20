$( document ).ready(function() {
    console.log( "ready!" );



    var tags_section = $('.tags_section');
    var tags_hide = $('.tags_hide');
    var tags = $.trim(tags_hide.text()).split("-");

    tags.forEach(function (tag) {
        var ancla = $('<a/>', {
            'html' : tag,
            'class' : 'badge btn_border tag_post mr-1',
            'href' : '#'
        });
        tags_section.append(ancla);
    });
    tags_hide.hide();




    console.log( tags[0], ancla );
});