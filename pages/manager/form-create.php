<?php

/**
 *  Page Manager Create Admin
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
                                        <i class="fas fa-user-cog"></i>
                                        เพิ่มข้อมูลผู้ดูแล
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
                                                    <label>ค้นหารายชื่อ</label>
                                                    <select class="custom-select select2" id="admin" name="user_id" data-placeholder="ค้นหาด้วยชื่อ หรือ ชื่อผู้ใช้งาน"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>ค้นหาแผนก</label>
                                                    <select class="custom-select select2" id="department" name="dep_id" data-placeholder="ค้นหาด้วยชื่อ หรือ รหัส"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 offset-3">
                                                <div class="form-group">
                                                    <label for="role_id">สิทธิ์การใช้งาน</label>
                                                    <select class="custom-select select2" name="role_id" id="role_id" data-placeholder="ค้นหาด้วยชื่อ หรือ รหัส">
                                                        <option></option>
                                                        <option value="1">Super Admin</option>
                                                        <option value="2">Admin</option>
                                                        <option value="3">User</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="status">สถานะ</label>
                                                <div class="form-group">
                                                    <input type="checkbox" class="switch" name="status" value="1" checked>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary btn-block mx-auto w-50" name="submit">บันทึกข้อมูล</button>
                                        <!-- <button type="button" id="check">Check</button>
                                        <button type="button" id="uncheck">Uncheck</button> -->
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
            $('.select2').select2({
                width: '100%'
            })
            $(".switch").bootstrapSwitch();
            // $('#check').on('click', function(e) {
            //     $('.switch').bootstrapSwitch('state', true);
            // })
            // $('#uncheck').on('click', function(e) {
            //     $('.switch').bootstrapSwitch('state', false);
            // })
            // $("input[data-bootstrap-switch]").each(function() {
            //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
            // })

            $('#formData').submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    user_id: {
                        required: true,
                    },
                    dep_id: {
                        required: true,
                    },
                    role_id: {
                        required: true,
                    },
                },
                messages: {
                    user_id: {
                        required: "เลือก ผู้ใช้งาน",
                    },
                    dep_id: {
                        required: "เลือก แผนก",
                    },
                    role_id: {
                        required: "เลือก บทบาท",
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
                    // console.log($('#formData').serialize())
                    $.ajax({
                        type: 'POST',
                        url: '<?= API_URL ?>v2/userManagement/add',
                        data: $('#formData').serialize(),
                        timeout: 0,
                        headers: {
                            "Accept": "application/json",
                            "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                        },
                    }).done(function(resp) {
                        Swal.fire({
                            text: 'เพิ่มข้อมูลเรียบร้อย',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                        }).then((result) => {
                            location.assign('<?= BASE_URL ?>pages/manager');
                        });
                    })
                }
            });

            selectDataSearch('admin', 0)
            selectDataSearch('department', 0)
        });

        function selectDataSearch(el, id) {
            // console.log(el);
            $.ajax({
                url: "<?= API_URL ?>" + `v2/${el}/all`,
                method: "GET",
                timeout: 0,
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                },
                success: function(result) {
                    // console.log(result);
                    $("#" + el).html("");
                    $("#" + el).append(`<option></option>`);
                    $.each(result.data, function(index, ref) {
                        var select = "";
                        if (ref.id == id) {
                            select = ' selected = "selected"';
                        }
                        $("#" + el).append(
                            '<option value="' +
                            ref.id +
                            '"' +
                            select +
                            `>${ref.name} [${ref.username}]</option>`
                        );
                    });
                },
            });
        }
    </script>

</body>

</html>