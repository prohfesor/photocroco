jQuery("form").submit(function(){
   return false;
});

jQuery("a[href=#create]").click( function(){
    jQuery("#form-newgame").toggle();
    return false;
} );


jQuery("a[href=#start]").click( function(){
    var login = jQuery('#form-newgame :text[name=login]').val();
    var question = jQuery('#form-newgame :text[name=question]').val();
    jQuery.cookie('login', login);
    jQuery.ajax({
        type: "post",
        url: "/new/"+login+"/"+question,
        dataType: "json",
        success: function(data){
            document.location = "/game/"+data.id;
        }
    });
    return false;
});


jQuery("a[href=#joinform]").click(function(){
    jQuery(this).siblings().show();
    return false;
});


function listen_status(id){
    setInterval( function(){
        jQuery.ajax({
            type: 'get',
            url: '/game/'+id+"/status/",
            dataType: "json",
            success: function(data){
                var photo = jQuery("#img-question img").attr('src');
                var gamePhoto = 'http://croco/photos/'+data.photo;
                if (photo != gamePhoto) jQuery("#img-question img").attr('src', gamePhoto);
            }
        });
    } , 3000 );
}