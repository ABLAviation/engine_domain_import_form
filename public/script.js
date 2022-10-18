

$(document).ready(function(){
    
    $("#file").on('change' ,function(){

        let file = $('#file').files[0];
        console.log('ok');

    });

    $(window).on('dragenter', function(e){
        e.preventDefault();
    });

    $("html").on("drop", function(e) { e.preventDefault(); e.stopPropagation(); });

    $("#form").on('dragleave', function(){
        $(this).removeClass('dragging');
    });

    $("#form").on('drop', function(e){
        $(this).removeClass('dragging');
        console.log('ok');
        e.preventDefault();
        e.stopPropagation();
    });

$("#form").on("dragover", function() {
    $(this).addClass('dragging');

});



    

});
