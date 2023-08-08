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
                                                    <select class="custom-select selectSearch" id="admin" name="user_id" data-placeholder="ค้นหาด้วยชื่อ หรือ เบอร์โทร">
                                                        <option selected="selected"></option>
                                                        <option value="99">AppzStory</option>
                                                        <option>Jame</option>
                                                        <option>Ethan Winters</option>
                                                        <option>Rosemary</option>
                                                        <option>Chris Redfield</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>ค้นหาแผนก</label>
                                                    <select class="custom-select selectSearch" id="department" name="dep_id" data-placeholder="ค้นหาด้วยชื่อ หรือ เบอร์โทร">
                                                        <option selected="selected"></option>
                                                        <option>AppzStory</option>
                                                        <option value="6">Jame</option>
                                                        <option>Ethan Winters</option>
                                                        <option>Rosemary</option>
                                                        <option>Chris Redfield</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 offset-3">
                                                <div class="form-group">
                                                    <label for="role_id">สิทธิ์การใช้งาน</label>
                                                    
                                                    
                                                        <option value disabled selected>กำหนดสิทธิ์</option>
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
                                                    <input type="checkbox" name="status" value="1" checked data-bootstrap-switch>
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
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        $(function() {
            $('.selectSearch').select2({
                width: '100%'
            })
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
            $('#formData').on('submit', function(e) {
                e.preventDefault()
                console.log($(this).serialize())
                $.ajax({
                    type: 'POST',
                    url: '<?= API_URL ?>v2/userManagement/add',
                    data: $('#formData').serialize()
                }).done(function(resp) {
                    Swal.fire({
                        text: 'เพิ่มข้อมูลเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง',
                    }).then((result) => {
                        location.assign('<?= BASE_URL ?>pages/manager');
                    });
                })
            });
            selectDataSearch('admin', 0)
            selectDataSearch('department', 0)
        });

        function selectDataSearch(el, id) {
            // console.log(el);
            $.ajax({
                url: "<?= API_URL ?>" + `v2/${el}/all`,
                method: "GET",
                success: function(result) {
                    // console.log(result);
                    $("#" + el).html("");
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