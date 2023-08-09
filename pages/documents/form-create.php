<?php
require_once('../authen.php');
// echo '<pre>', print_r($_SESSION, 1), '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>จัดการเอกสาร | <?= APP_NAME ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once('../includes/sidebar.php') ?>
        <div class="content-wrapper pt-3">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                        <i class="fas fa-file-download fa-lg"></i>
                                        เพิ่มเอกสาร
                                    </h4>
                                    <a href="./" class="btn btn-info mt-3">
                                        <i class="fas fa-list"></i>
                                        กลับหน้าหลัก
                                    </a>
                                </div>
                                <form id="formData" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label for="doc_type">ประเภทเอกสาร</label>
                                                <select class="custom-select mb-3 select2" id="doc_type" name="doc_type" data-placeholder="ค้นหาด้วยชื่อ หรือ รหัส"></select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label for="doc_type">เอกสาร</label>
                                                <select class="custom-select mb-3 select2" id="doc_type_det" name="doc_type_det" data-placeholder="ค้นหาด้วยชื่อ หรือ รหัส"></select>
                                            </div>
                                            <div class="form-group col-md-2 d-none">
                                                <label>ค้นหารายชื่อลูกค้า</label>
                                                <select class="custom-select select2" id="refId" name="refId" data-placeholder="ค้นหาด้วยชื่อ หรือ รหัส">
                                                    <option></option>
                                                    <option value="0" selected="selected">None</option>
                                                    <!-- <option>Jame</option>
                                                    <option>Ethan Winters</option>
                                                    <option>Rosemary</option>
                                                    <option>Chris Redfield</option> -->
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="doc_name">ชื่อเอกสาร</label>
                                                <input type="text" class="form-control" name="doc_name" id="doc_name" placeholder="ชื่อเอกสาร">
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <!-- <div class="form-group col-sm-6">
                                                <!-- <label for="doc_file">เอกสาร</label>
                                                <div class="doc_file">
                                                    <input type="file" class="custom-file-input" id="doc_file">
                                                    <label class="custom-file-label" for="doc_file">เลือกเอกสาร</label>
                                                </div>
                                                <label>เอกสาร</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="customFile">
                                                    <label class="custom-file-label" for="customFile">เลือกเอกสาร</label>
                                                </div>
                                            </div> -->
                                            <div class="form-group col-sm-6">
                                                <label for="file">ไฟล์แนบ</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="file" name="file">
                                                    <label class="custom-file-label" for="file">เลือกไฟล์</label>
                                                </div>
                                            </div>
                                            <!-- <div class="form-group col-sm-4">
                                                <label for="exampleInputFile">File input</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">Upload999</span>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <div class="form-group offset-sm-3 col-sm-3">
                                                <label for="expire_date">วันที่หมดอายุ</label>
                                                <div class="input-group date" id="expire_date" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" name="expire" name="expire" data-target="#expire_date" />
                                                    <div class="input-group-append" data-target="#expire_date" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer col-sm-12">
                                                <button type="submit" class="btn btn-primary btn-block mx-auto w-75" name="submit">บันทึกข้อมูล</button>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('../includes/footer.php') ?>
    </div>

    <!-- scripts -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/moment/moment.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>
    <script src="../../assets/js/util.js"></script>

    <script>
        const depId = <?= $_SESSION['LOGIN']['user']['role']['depId'] ?>;
        const userId = <?= $_SESSION['LOGIN']['user']['role']['userId'] ?>;

        $(function() {
            bsCustomFileInput.init();
            // console.log(bsCustomFileInput);
            // bsCustomFileInput.defaults.customText = "Custom Button Text";

            $('.select2').select2({
                width: '100%'
            })

            //Date picker
            $('#expire_date').datetimepicker({
                format: 'L'
            });

            $('#detail').summernote({
                height: 300,
            });

            $('#doc_type').on('select2:select', function(e) {
                var selectedValue = e.params.data.id;
                // var selectedText = e.params.data.text;

                // console.log('Selected Value: ' + selectedValue);
                // console.log('Selected Text: ' + selectedText);
                getDataDoc(depId, 0, selectedValue)
            });

            $('#formDataxxx').on('submit', function(e) {
                e.preventDefault();
                // $.ajax({
                //     type: 'POST',
                //     url: '../../service/products/create.php',
                //     data: $('#formData').serialize()
                // }).done(function(resp) {
                //     Swal.fire({
                //         text: 'เพิ่มข้อมูลเรียบร้อย',
                //         icon: 'success',
                //         confirmButtonText: 'ตกลง',
                //     }).then((result) => {
                //         location.assign('./');
                //     });
                // })
                // var data = $('#formData').serialize();
                // var data = $('#formData').serializeArray();
                var data = $('#formData').serializeObject();
                // var form = new FormData(this);
                // console.log(data);

                const fdata = new FormData();
                fdata.append("fileName", file.files[0]);
                fdata.append("imageName", data.doc_name);
                fdata.append("expireDate", formatDate(data.expire));
                fdata.append("refId", data.refId);
                fdata.append("depId", depId);
                fdata.append("docType", data.doc_type);
                fdata.append("userId", userId);
                console.log(fdata);
                // Get the file input element and the selected file
                // var fileInput = $("#fileInput")[0];
                // var file = fileInput.files[0];

                // // Create a FormData object to send the file data
                // var formData = new FormData();
                // formData.append("file", file);

                // Perform the AJAX POST request
                $.ajax({
                    url: '<?= API_URL ?>v2/document', // Replace "upload.php" with the URL to your server-side file handling script
                    type: "POST",
                    data: fdata,
                    processData: false, // Prevent jQuery from processing the data
                    contentType: false, // Prevent jQuery from setting the Content-Type header
                    success: function(response) {
                        // Handle the server's response here
                        // console.log("File uploaded successfully!", response);
                        Swal.fire({
                            text: 'เพิ่มข้อมูลเรียบร้อย',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                        }).then((result) => {
                            location.assign('<?= BASE_URL ?>pages/documents/');
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle the error
                        console.error("Error occurred:", error);
                    }
                });
            });

            $('#formData').submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    doc_type: {
                        required: true,
                    },
                    doc_type_det: {
                        required: true,
                    },
                    // refId: {
                    //     required: true,
                    // },
                },
                messages: {
                    docType: {
                        required: "เลือก ประเภทเอกสาร",
                    },
                    docTypeDet: {
                        required: "เลือก เอกสาร",
                    },
                    // refId: {
                    //     required: "เลือก บุคคลอ้างอิง",
                    // },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    // console.log($('#formData').serialize())
                    const data = $('#formData').serializeObject();
      
                    const fdata = new FormData();
                    fdata.append("fileName", file.files[0]);
                    fdata.append("imageName", data.doc_name);
                    fdata.append("expireDate", formatDate(data.expire));
                    fdata.append("refId", data.refId);
                    fdata.append("depId", depId);
                    fdata.append("docType", data.doc_type);
                    fdata.append("userId", userId);
                    console.log(fdata);
  
                    $.ajax({
                        url: '<?= API_URL ?>v2/document', // Replace "upload.php" with the URL to your server-side file handling script
                        type: "POST",
                        data: fdata,
                        processData: false, // Prevent jQuery from processing the data
                        contentType: false, // Prevent jQuery from setting the Content-Type header
                        success: function(response) {
                            Swal.fire({
                                text: 'เพิ่มข้อมูลเรียบร้อย',
                                icon: 'success',
                                confirmButtonText: 'ตกลง',
                            }).then((result) => {
                                location.assign('<?= BASE_URL ?>pages/documents');
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Error occurred:", error);
                        }
                    });
                }
            });
            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         console.log($(this).serialize())
            //         alert("Form successful submitted!");
            //         e.preventDefault()
            //         // $.ajax({
            //         //     type: 'POST',
            //         //     url: '<//?= API_URL ?>v2/department/add',
            //         //     data: $('#formData').serialize()
            //         // }).done(function(resp) {
            //         //     Swal.fire({
            //         //         text: 'เพิ่มข้อมูลเรียบร้อย',
            //         //         icon: 'success',
            //         //         confirmButtonText: 'ตกลง',
            //         //     }).then((result) => {
            //         //         location.assign('<//?= BASE_URL ?>pages/department');
            //         //     });
            //         // })
            //     }
            // });
            // selectSearch()
            // selectDataSearch(0)
            getDataDocType(depId, 0)
            getDataDoc(depId, 0, 0)
        });

        function selectDataSearch(id) {
            $.ajax({
                url: "<?= API_URL ?>v2/member/all",
                method: "GET",
                success: function(result) {
                    // console.log(result);
                    $("#refId").html("");
                    $.each(result.data, function(index, ref) {
                        var select = "";
                        if (ref.id == id) {
                            select = ' selected = "selected"';
                        }
                        $("#refId").append(
                            '<option value="' +
                            ref.id +
                            '"' +
                            select +
                            ">" +
                            ref.name +
                            "</option>"
                        );
                    });
                },
            });
        }


        function getDataDocType(depId, id) {
            // console.log(el);
            $.ajax({
                url: "<?= API_URL ?>" + `v2/documentType/${depId}/parent`,
                method: "GET",
                success: function(result) {
                    // console.log(result);
                    $("#doc_type").html("");
                    $("#doc_type").append(`<option></option>`);
                    $.each(result.data, function(index, ref) {
                        var select = "";
                        if (ref.id == id) {
                            select = ' selected = "selected"';
                        }
                        $("#doc_type").append(
                            '<option value="' +
                            ref.id +
                            '"' +
                            select +
                            `>${ref.desc} [${ref.expire}:${ref.id}]</option>`
                        );
                    });
                },
            });
        }

        function getDataDoc(depId, id, doc) {
            // console.log(el);
            $.ajax({
                url: "<?= API_URL ?>" + `v2/documentType/${depId}/all/${doc}`,
                method: "GET",
                success: function(result) {
                    // console.log(result);
                    $("#doc_type_det").html("");
                    $("#doc_type_det").append(
                        `<option></option>`
                    );
                    $.each(result.data, function(index, ref) {
                        var select = "";
                        if (ref.id == id) {
                            select = ' selected = "selected"';
                        }
                        $("#doc_type_det").append(
                            '<option value="' +
                            ref.id +
                            '"' +
                            select +
                            `>${ref.desc} [${ref.expire}:${ref.id}]</option>`
                        );
                    });
                },
            });
        }

        // function formatDate(inputDate) {
        //     const parts = inputDate.split('/');
        //     const day = parts[0];
        //     const month = parts[1];
        //     const year = parts[2];

        //     // Create a new Date object (months are 0-based in JavaScript)
        //     const dateObject = new Date(year, month - 1, day);

        //     // Format the date in the desired format
        //     const options = {
        //         year: 'numeric',
        //         month: 'long',
        //         day: 'numeric'
        //     };
        //     return dateObject.toLocaleDateString(undefined, options);
        // }

        function formatDate(inputDate) {
            const parts = inputDate.split('/');
            const day = parts[1];
            const month = parts[0];
            const year = parts[2];

            return `${year}-${month}-${day}`;

            // Create a new Date object (months are 0-based in JavaScript)
            // const dateObject = new Date(year, month - 1, day);

            // Format the date in the desired format (yyyy-mm-dd)
            // const formattedDate = `${dateObject.getFullYear()}-${(month < 10 ? '0' : '') + month}-${(day < 10 ? '0' : '') + day}`;
            // return formattedDate;
        }
    </script>
</body>

</html>