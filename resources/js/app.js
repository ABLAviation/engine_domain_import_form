import './bootstrap';




$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let file;

    $('#form').on('drop dragdrop', function (event) {
        event.preventDefault();
        $("#form").removeClass('dragging');
        let validExtensions = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel', 'text/csv'];
        file = event.originalEvent.dataTransfer.files[0];

        if (!validExtensions.includes(file.type)) {
            alert('Wrong file extension!');
        }


    })
    $('#form').on('dragenter', function (event) {
        event.preventDefault();
        $("#form").addClass('dragging');
    })
    $('#form').on('dragleave', function () {
        $("#form").removeClass('dragging');
    })
    $('#form').on('dragover', function (event) {
        event.preventDefault();
    })

    $('#inputGroupFile01').on('change', function(){
        file = this.files[0];
        console.log(file);
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
                console.log(data);
            },
            error: function (error) {
                console.log(error);
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





});
