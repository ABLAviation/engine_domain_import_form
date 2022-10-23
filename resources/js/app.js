import './bootstrap';




$(document).ready(function () {

    function extensionCheck(file){

        let validExtensions = ['xlsx', 'xls', 'csv'];
        if (!validExtensions.includes(file.name.split('.').pop())) {
            return 0;
        }
    
        return 1;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let file;
    let alertMessage;

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
        file = event.originalEvent.dataTransfer.files[0];

        let extensionCheckBool = extensionCheck(file);

        //failed extension test.
        if(!extensionCheckBool){
            console.log(file);
            alertMessage = "The <strong>." + file.name.split('.').pop() + "</strong> is a wrong file type! Please import only [xlsx, xls, csv]."
            file = {};
  
            $('#feedback-wrapper').html(`
            <div style="height 30px; background: #fac8c788; color: #555" id="feedback-alert" class="col border border-danger rounded p-2">

            <div class="d-flex justify-content-between align-items-center p-2">
            <div class="d-flex w-75 justify-content-start align-items-center gap-2">
                <span class="feeback-icon"><i style="transform: rotate(90deg); color: #cf7c76" class="fa-solid fa-ban fa-lg"></i></span>
                <span class="feedback-message">`+ alertMessage +`</span>
            </div>
            <div class="d-flex justify-content-end">
                <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
            </div>
        </div>
        </div>
            `);
            $(".import-progress").addClass('d-hidden');
        }else{
            $(".uploaded-file-name").html(file.name);
            $(".import-progress").removeClass('d-hidden');
            $('#feedback-alert').remove();
        }
        
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

        //failed extension test.
        if(!extensionCheck(file)){
            alertMessage = "The <strong>." + file.name.split('.').pop() + "</strong> is a wrong file type! Please import only [xlsx, xls, csv]."
            file = {};
            $(this).val = "";
            $('#feedback-wrapper').html(`
            <div style="height 30px; background: #fac8c788; color: #555" id="feedback-alert" class="col border border-danger rounded p-2">
            <div class="d-flex justify-content-between align-items-center p-2">
            <div class="d-flex w-75 justify-content-start align-items-center gap-2">
                <span class="feeback-icon"><i style="transform: rotate(90deg); color: #cf7c76" class="fa-solid fa-ban fa-lg"></i></span>
                <span class="feedback-message">`+ alertMessage +`</span>
            </div>
            <div class="d-flex justify-content-end">
                <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
            </div>
        </div>
        </div>
            `);
            $(".import-progress").addClass('d-hidden');
        }else{
            $(".uploaded-file-name").html(file.name);
            $(".import-progress").removeClass('d-hidden');
            $('#feedback-alert').remove();
        }

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
                //Success upload case.
                alertMessage = "Data imported succesfully!"
                file = {};
                $('#feedback-wrapper').html(`
                <div style="height 30px; background: #daf1d5; color: #555" id="feedback-alert" class="col border border-success rounded p-2">

                <div class="d-flex justify-content-between align-items-center p-2">
                <div class="d-flex w-75 justify-content-start align-items-center gap-2">
                    <span class="feeback-icon"><i style="color: #99bea0;" class="fa-solid fa-check fa-lg"></i></i></span>
                    <span class="feedback-message">`+ alertMessage +`</span>
                </div>
                <div class="d-flex justify-content-end">
                    <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
                </div>
            </div>
            </div>
                `);
                $(".import-progress").addClass('d-hidden');
            },
            error: function (error) {
                console.log(error);
                if(file === {}){
                    alertMessage = "Select file for import first!"
                    file = {};
                    $(this).val = "";
                    $('#feedback-wrapper').html(`
                    <div style="height 30px; background: #fac8c788; color: #555" id="feedback-alert" class="col border border-danger rounded p-2">
                    <div class="d-flex justify-content-between align-items-center p-2">
                    <div class="d-flex w-75 justify-content-start align-items-center gap-2">
                        <span class="feeback-icon"><i style="transform: rotate(90deg); color: #cf7c76" class="fa-solid fa-ban fa-lg"></i></span>
                        <span class="feedback-message">`+ alertMessage +`</span>
                    </div>
                    <div class="d-flex justify-content-end">
                        <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
                    </div>
                </div>
                </div>
                    `);
                }

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


    $(document).on('click', '.feedback-close', function(){
        // console.log('removing...');
        $('#feedback-alert').remove();
    });




});
