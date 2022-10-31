import './bootstrap';




$(document).ready(function () {

    /* *///Ajax Setup Headers with csrf token.
    /* */
    /* */
    /* */
    /* */$.ajaxSetup({
    /* */    headers: {
    /* */    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    /* */   }
    /* */});
    /* */
    /* */
    /* */
    /* */
    /* */
    /* */
    /* *///------------------------------------------------------








    
    /* */// Global Variables Declaration
    /*
    |
    |
    |
    |
    */
    /*//////*/let file; //Variable that holds the imported file.
    /*
    |
    |
    |
    |
    |
    |
    |*/   



    






    
    /* */// Functions Declaration
    /*
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    */
    function abl_extensionCheck(file){/*
    |
    |
    |
    |
    |*/
    /* */let validExtensions = ['xlsx', 'xls', 'csv', 'xlsm']; //list of valid extensions
    /* */    if (!validExtensions.includes(file.name.split('.').pop())) {
    /* */        return 0; //return 0 if exetnsion is invalid.
    /* */    }
    /* */
    /* */    return 1; // return 1 if extension is valid.
    /* */
    /* */
    /* */
    /* */
    } //End of function abl_extensionCheck
    /* */
    /*
    |
    |
    |
    |
    |
    //////////////////////////////
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    |
    */
    function abl_alertUser(alertMessage, type = 'success'){/*
    |
    |
    |
    |
    |
    |
    |
    */    
    /* */    if(type == 'danger'){
    /* */        $('#feedback-wrapper').html(`
            <div style="height 30px; background: #fac8c788; color: #555" id="feedback-alert" class="col border border-danger rounded p-2">

            <div class="d-flex justify-content-between align-items-center p-2">
            <div class="d-flex w-75 justify-content-start align-items-center gap-3">
                <span class="feeback-icon"><i style="transform: rotate(90deg); color: #cf7c76" class="fa-solid fa-ban fa-2x"></i></span>
                <span class="feedback-message">`+ alertMessage +`</span>
            </div>
            <div class="d-flex justify-content-end">
                <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
            </div>
        </div>
        </div>
            `);
    /* */
    /* */    }else{

    /* */        $('#feedback-wrapper').html(`
            <div style="height 30px; background: #daf1d5; color: #555" id="feedback-alert" class="col border border-success rounded p-2">

            <div class="d-flex justify-content-between align-items-center p-2">
            <div class="d-flex w-75 justify-content-start align-items-center gap-3">
                <span class="feeback-icon"><i style="color: #99bea0;" class="fa-solid fa-check fa-2x"></i></i></span>
                <span class="feedback-message">`+ alertMessage +`</span>
            </div>
            <div class="d-flex justify-content-end">
                <span style="cursor: pointer; color: #555" class="feedback-close"><i class="fa-solid fa-xmark"></i></span>
            </div>
        </div>
        </div>
            `);
    /* */
    /* */    }
    /* */    file = {};
    /* */    $(".import-progress").addClass('d-hidden');
    /* */
    }
    /* */
    /* */



    /* *///Download Template file code Start
    /* */$('.download-button').on('click', function(){
    /* */
    /* */
    /* */   $('#download-template').click();
    /* */
    /* */
    /* */});
    /* */
    /* */
    /* */// END











    /* *///Open file browser on "Select file" click
    /* */$('.select-file-button').on('click', function(){
    /* */
    /* */    $('.upload-file-input').click();
    /* */
    /* */});
    /* */
    /* */
    /* */
    /* */// END








    /*-------------------------*/// I) Drag & Drop events JS Code Start
    /* */$('#form, #from *').on('drop dragdrop', function (event) {
    /* */   event.preventDefault();
    /* */   $("#form").removeClass('dragging');
    /* */   $(".upload-image").addClass('hidden');
    /* */   file = event.originalEvent.dataTransfer.files[0];
    /* */
    /* */
    /* */   let extensionCheckBool = abl_extensionCheck(file); // returns 1 if extension file is valid.
    /* */
    /* */
    /* */
    /*->*/// 1) failed extension test.
    /* */   if(!extensionCheckBool){
    /* */       
    /* */        abl_alertUser("The <strong>." + file.name.split('.').pop() + "</strong> is a wrong file type! Please import only [xlsx, xls, csv].", 'danger');
    /* */   
    /* */   }else{
    /* */
    /* */       $(".uploaded-file-name").html(file.name);
    /* */       $(".import-progress").removeClass('d-hidden');
    /* */       $('#feedback-alert').remove();
    /* */
    /* */   }
    /* */    
    /* */});
    /* */
    /* */
    /* */
    /* */$('#form, #from *').on('dragenter', function (event) {
    /* */
    /* */   event.preventDefault();
    /* */   $("#form").addClass('dragging');
    /* */   $(".upload-image").removeClass('hidden');
    /* */
    /* */});
    /* */
    /* */
    /* */
    /* */$('#form, #from *').on('dragleave', function () {
    /* */
    /* */   $("#form").removeClass('dragging');
    /* */   $(".upload-image").addClass('hidden');
    /* */
    /* */});
    /* */
    /* */
    /* */
    /* */$('#form, #from *').on('dragover', function (event) {
    /* */
    /* */   event.preventDefault();
    /* */
    /* */});
    /* */
    /* */
    /* */
    /* */
    /* */// Drag & Drop events JS code End.

    





    /* */// II) Handling the Hidden File Input Change Event Start
    /* */$('#inputGroupFile01').on('change', function(){
    /* */    file = this.files[0];
    /* */    console.log(file);   
    /*->*/// 1) failed extension test.
    /* */   if(!abl_extensionCheck(file)){
    /* */
    /* */        abl_alertUser("The <strong>." + file.name.split('.').pop() + "</strong> is a wrong file type! Please import only [xlsx, xls, csv].", 'danger');
    /* */   }else{
    /* */       $(".uploaded-file-name").html(file.name);
    /* */       $(".import-progress").removeClass('d-hidden');
    /* */       $('#feedback-alert').remove();
    /* */   }
    /* */
    /* */});
    /* */
    /* */
    /* */
    /* */
    /* */// Handling the Hidden File Input Change Event End






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
                abl_alertUser("Data imported succesfully!");
            },
            error: function (error) {
                console.log(error);
                console.log(file);
                if(isEmpty(file)){
                    abl_alertUser("Select file for import first!", 'danger');
                }else{
                    abl_alertUser("Ops! Something went wrong, contact support.", 'danger');
                }

            }
        });
    });

    //Close alert form
    $(document).on('click', '.feedback-close', function(){
        // console.log('removing...');
        $('#feedback-alert').remove();
    });




});
