jQuery("a[href=#create]").click( function(){
    jQuery("#form-newgame").toggle();
    return false;
} );


jQuery("a[href=#start]").click( function(){
    var login = jQuery('#form-newgame :text[name=login]').val();
    var question = jQuery('#form-newgame :text[name=question]').val();
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


function listen_status(){

}