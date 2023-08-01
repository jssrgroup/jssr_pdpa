<?php

/**
 * Page Manager
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once('../authen.php');
echo '<pre>', print_r($_SESSION, 1), '</pre>';
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
                                                <select class="custom-select mb-3" id="doc_type" name="doc_type">
                                                    <option disabled selected>เลือกประเภทเอกสาร</option>
                                                    <option value="1">เอกสารบริษัท</option>
                                                    <option value="2">เอกสารพนักงาน</option>
                                                    <option value="3">เอกสารลูกค้า</option>
                                                    <option value="4">เอกสารอื่นๆ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label>ค้นหารายชื่อลูกค้า</label>
                                                <select class="custom-select selectSearch" id="refId" name="refId" data-placeholder="ค้นหาด้วยชื่อ หรือ เบอร์โทร">
                                                    <option selected="selected"></option>
                                                    <option>AppzStory</option>
                                                    <option>Jame</option>
                                                    <option>Ethan Winters</option>
                                                    <option>Rosemary</option>
                                                    <option>Chris Redfield</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="doc_name">ชื่อเอกสาร</label>
                                                <input type="text" class="form-control" name="doc_name" id="doc_name" placeholder="ชื่อเอกสาร">
                                            </div>
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
                                                <div class="custom-file">
                                                    <input type="file" class="" id="customFile" name="customFile">
                                                    <!-- <label class="custom-file-label" for="customFile">Choose file</label> -->
                                                </div>
                                            </div>
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
    <script src="../../assets/js/adminlte.min.js"></script>
    <script src="../../assets/js/util.js"></script>

    <script>
        $(function() {
            function selectSearch() {
                $('.selectSearch').select2({
                    width: '100%'
                })
            }

            //Date picker
            $('#expire_date').datetimepicker({
                format: 'L'
            });

            $('#detail').summernote({
                height: 300,
            });

            $('#formData').on('submit', function(e) {
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
                console.log(data);

                // const fdata = new FormData();
                // fdata.append("attachment", doc_file.files[0]);
                // fdata.append("filename", doc_name.filename);
                // fdata.append("expireDate", expire_date.expireDate);
                // fdata.append("refId", data.cusId);
                // fdata.append("refDepId", data.cusId);
                // fdata.append("refDocTypeId", data.cusId);
                // fdata.append("refUserId", data.cusId);
                // console.log(fdata);
                // Get the file input element and the selected file
                // var fileInput = $("#fileInput")[0];
                // var file = fileInput.files[0];

                // // Create a FormData object to send the file data
                // var formData = new FormData();
                // formData.append("file", file);

                // // Perform the AJAX POST request
                // $.ajax({
                //     url: "upload.php", // Replace "upload.php" with the URL to your server-side file handling script
                //     type: "POST",
                //     data: formData,
                //     processData: false, // Prevent jQuery from processing the data
                //     contentType: false, // Prevent jQuery from setting the Content-Type header
                //     success: function(response) {
                //         // Handle the server's response here
                //         console.log("File uploaded successfully!", response);
                //     },
                //     error: function(xhr, status, error) {
                //         // Handle the error
                //         console.error("Error occurred:", error);
                //     }
                // });
            });
            selectSearch()
            selectDataSearch(0)
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
    </script>
</body>

</html>