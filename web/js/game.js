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


function listen_status(id){
    var listener = setInterval(function(){
        jQuery.ajax({
            type: 'get',
            url: '/game/'+id+"/status/",
            dataType: "json",
            success: function(data){
                var photo = jQuery("#img-question img").attr('src');
                var gamePhoto = '/photos/'+data.photo;
                if (photo != gamePhoto && data.photo) jQuery("#img-question img").attr('src', gamePhoto);
                if (data.status == 'closed') {
                    alert('Winner is '+data.winner);
                    clearInterval(listener);
                }
            }
        });
    } , 3000 );
}

function submit_answer(){
    var login = jQuery.cookie('login');
    var answer = jQuery("#answer").val();
    jQuery("#answer").val('');
    jQuery.ajax({
        type: 'post',
        url: '/game/'+id+'/'+login+'/answer/'+answer,
        dataType: "json",
        success: function(data){

        }
    });
}