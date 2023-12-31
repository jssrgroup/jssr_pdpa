<?php

/**
 * Page Manager Edit Admin
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once('../authen.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการผู้ดูแลระบบ | <?= APP_NAME ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
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
                            <div class="card shadow">
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                        <i class="fas fa-building"></i>
                                        แก้ไขข้อมูลแผนก
                                    </h4>
                                    <a href="./" class="btn btn-info my-3 ">
                                        <i class="fas fa-list"></i>
                                        กลับหน้าหลัก
                                    </a>
                                </div>
                                <form id="formData">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="code">รหัส</label>
                                                    <input type="text" class="form-control" name="code" id="code" placeholder="รหัส">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="desc">ชื่อ</label>
                                                    <input type="text" class="form-control" name="desc" id="desc" placeholder="ชื่อ" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit">บันทึกข้อมูล</button>
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
    <!-- SCRIPTS -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        $(function() {
            var fullURL = window.location.href;
            var url = new URL(fullURL);
            var id = url.searchParams.get("id");

            function loadData(id) {
                $.ajax({
                    type: 'GET',
                    url: "<?= API_URL ?>" + `v2/department/${id}`,
                    data: $('#formData').serialize(),
                    timeout: 0,
                    headers: {
                        "Accept": "application/json",
                        "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                    },
                }).done(function(resp) {
                    // console.log(resp.data.code);
                    $("#code").val(resp.data.code)
                    $("#desc").val(resp.data.desc)
                })
            }
            $('.selectSearch').select2({
                width: '100%'
            })
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })

            $('#formData').submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    desc: {
                        required: true,
                        minlength: 5
                    },
                },
                messages: {
                    desc: {
                        required: "ชื่อ ห้ามเว้นว่าง",
                        minlength: "ไม่น้อยกว่า 5 ตัวอักษร"
                    },
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
                    $.ajax({
                        type: 'POST',
                        url: '<?= API_URL ?>' + `v2/department/${id}/update`,
                        data: $('#formData').serialize(),
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                        },
                    }).done(function(resp) {
                        Swal.fire({
                            text: 'อัพเดทข้อมูลเรียบร้อย',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                        }).then((result) => {
                            location.assign('<?= BASE_URL ?>pages/department');
                        });
                    })
                }
            });
            // var currentPath = window.location.pathname;
            // console.log(currentPath);
            // var queryParams = window.location.search;
            // console.log(queryParams);
            // var hashFragment = window.location.hash;
            // console.log(hashFragment);
            // var fullURL = window.location.href;
            // console.log(fullURL);
            // var url = new URL(fullURL);
            // var paramValue = url.searchParams.get("id");
            // console.log("id value:", paramValue);
            loadData(id)
        });
    </script>

</body>

</html>