<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Costs-ImportForm</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <!-- <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
    </style> -->

</head>

<body class="antialiased">
    <div class="container vh-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="form-container col-md-5">
                <div class="row tr">
                    <!-- top section of the import form -->
                    <div style="border-color: lightgrey;" class="col-12 p-2 border-bottom">
                        <div>
                            <span style="color: #647CA7;" class="ms-2">Import Form</span>
                        </div>
                        <div class="d-flex justify-content-center mt-3 mb-1">
                            <span style="font-size: 0.8rem;">Download The Import Template</span>
                        </div>
                        <a id="download-template" href="files/LLP_Costs_Templates.xlsx"
                            class="d-flex justify-content-center download-file-area mb-2" download>
                            <div style="width: 75%; border-color: lightgrey;"
                                class="download-button d-flex align-items-center justify-content-between border rounded pt-3 pb-3 ps-2 pe-2">
                                <div class="d-flex gap-2 align-items-center file-info">
                                    <!-- <i style="color: darkgreen;" class="fa-regular fa-file-excel fa-2xl"></i> -->
                                    <img style="width: 30px;" src="images/xlsx_icon.png">
                                    <span class="file-name">
                                        LLP_Costs_Template.xlsx
                                    </span>
                                </div>
                                <span class="download-button">
                                    <i style="color: #9156b7;" class="fa-solid fa-cloud-arrow-down me-2"></i>
                                </span>
                                <!-- <a id="download-template" href="files/LLP_Costs_Template.xlsx" download></a> -->
                            </div>
                        </a>
                    </div>




                    <!-- middle section of the import form -->
                    <div style="border-color: lightgrey;" class="col-12 my-2 border-bottom">
                        <div class="d-flex justify-content-center">
                            <div style="font-size: 0.8rem" class="d-flex w-75 justify-content-center px-2">
                                <span style="color: #00C3FF;" class="me-1"><i
                                        class="fa-solid fa-circle-info"></i></span>
                                <span style="color: #ABB9D4;">File import should not be more than 10MB. Only the
                                    <strong>.xls</strong>, <strong>.xlsx</strong> and <strong>.csv</strong> file types
                                    are allowed.</span>
                            </div>
                        </div>
                        <div style="font-weight: 600; color: #647CA7;" class="d-flex justify-content-center mt-3 mb-2">
                            Upload the LLP Costs Data
                        </div>
                        <div class="d-flex w-100 justify-content-center">
                            <div style="width: 75%;" class="import-area d-flex flex-column align-items-center rounded">

                                <div style="position: relative;; z-index: 2" class="upload-files-images d-flex mt-3">
                                    <img style="width: 180px;" src="images/import_files.png" alt="">
                                </div>
                                <div style="position: relative;; z-index: 2"
                                    class="upload-options d-flex flex-column align-items-center">
                                    <div>
                                        <span style="font-weight: 600; font-size: 1.2rem">Drag & Drop file to
                                            upload</span>
                                    </div>
                                    <div>
                                        <span style="font-weight: 400; font-size: 1rem">or</span>
                                    </div>
                                    <div>
                                        <button style="background: #9156b7; color: white; font-size: 0.8rem"
                                            class="border rounded px-2">
                                            <span class="plus-icon">+</span>
                                            <span>Select the file</span>
                                        </button>
                                    </div>
                                </div>
                                <div style="opacity: 0.15; " class="background-image position-absolute">
                                    <i class="fa-solid fa-cloud-arrow-up fa-10x"></i>
                                </div>
                            </div>
                        </div>
                        <div style="font-size: 0.7rem; color: white;" class="d-flex justify-content-center mb-3 mt-2">
                            <div style="border-radius: 3px; border-color: lightgrey; background: #a776c5"
                                class="d-flex w-75 justify-content-between border py-1 px-2">
                                <div class="d-flex">
                                    <span class="uploaded-file-name me-1">
                                        RR_LLP_Costs_Data_2022.xlsx
                                    </span>
                                    <span class="uploaded-check-text"> ▪ Uploaded</span>
                                </div>
                                <span class="check-icon">
                                    <i class="fa-solid fa-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>




                    <!-- bottom section of the import form -->
                    <div class="col-12">
                        <div style="font-size: 0.8rem" class="d-flex gap-2 justify-content-end p-1 mb-2">
                            <div class="cancel-button">
                                <button style="color: inherit; font-weight: 500;"
                                    class="py-1 px-3 border rounded">Cancel</button>
                            </div>
                            <div class="upload-button">
                                <button style="background: #9156b7; color: white;"
                                    class="py-1 px-3 border rounded">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>


</html>