import './bootstrap';




$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let file;

    //Download Template file code
    $('.download-button').on('click', function(){

        $('#download-template').click();
    });

    //Open file browser on "Select file" click
    $('.select-file-button').on('click', function(){

        $('.upload-file-input').click();
        
    });

    $('#form').on('drop dragdrop', function (event) {
        event.preventDefault();
        $("#form").removeClass('dragging');
        $(".upload-image").addClass('hidden');
        let validExtensions = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv'];
        file = event.originalEvent.dataTransfer.files[0];

        if (!validExtensions.includes(file.type)) {
            alert('Wrong file extension!');
        }
        // console.log(file);
        
        $(".uploaded-file-name").html(file.name);
        $(".import-progress").removeClass('d-hidden');
    })
    $('#form').on('dragenter', function (event) {
        event.preventDefault();
        $("#form").addClass('dragging');
        $(".upload-image").removeClass('hidden');
    })
    $('#form').on('dragleave', function () {
        $("#form").removeClass('dragging');
        $(".upload-image").addClass('hidden');
    })
    $('#form').on('dragover', function (event) {
        event.preventDefault();
    })

    $('#inputGroupFile01').on('change', function(){
        file = this.files[0];
        
        $(".uploaded-file-name").html(file.name);
        $(".import-progress").removeClass('d-hidden');
    });

    $('.cancel-button').on('click', function(){
        file = {};
        console.log('Cancel');
        $(".import-progress").addClass('d-hidden');
    });

    $('#upload-button').on('click', function (e) {
        e.preventDefault();
        var data = new FormData();
        data.append('file', file);
        $.ajax({
            type: 'POST',
            url: '/import',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data){

            },
            error: function (error) {
                // console.log(error);
            }
        });




        // var reader = new FileReader();
        // reader.onload = function () {
        //     var data = { 'title': file.name, 'file': reader.result };
        //     console.log(data);
        //     $.ajax({
        //         type: 'POST',
        //         url: '/import',
        //         data: data,
        //         success: function (response) {
        //             console.log(response);
        //         },
        //         error: function () {

        //         },
        //     });
        // };
        // reader.readAsDataURL(file);


    });


    $('.feedback-close').on('click', function(){
        // console.log('removing...');
        $('#feedback-alert').remove();
    });




});
