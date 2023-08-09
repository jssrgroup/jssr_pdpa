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
    <title>จัดการประเภทเอกสาร | <?= APP_NAME ?></title>
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
                                        <i class="fas fa-folder-open"></i>
                                        แก้ไขข้อมูลประเภทเอกสาร
                                    </h4>
                                    <a href="./" class="btn btn-info my-3 ">
                                        <i class="fas fa-list"></i>
                                        กลับหน้าหลัก
                                    </a>
                                </div>
                                <form id="formData" class="needs-validation" novalidate>
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
                                                    <input type="text" class="form-control" name="desc" id="desc" placeholder="ชื่อ" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="parent ">อยู่ภายใต้</label>
                                                    <select class="form-control custom-select select2" id="parent" name="parent" data-placeholder="ค้นหาด้วยชื่อ">
                                                        <option selected="selected"></option>
                                                        <option value="0">None</option>
                                                        <option value="1">Option 1</option>
                                                        <option value="2">Option 2</option>
                                                        <option value="3">Option 3</option>
                                                        <option value="4">Option 4</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="pattern">รูปแบบ</label>
                                                    <input type="text" class="form-control" name="pattern" id="pattern" placeholder="รูปแบบ" aria-describedby="patternHelp">
                                                    <small id="patternHelp" class="form-text text-muted">Ex. CODE[Y]-[m]-[4] is CODE2023-08-000X<br />[Y]=2023<br />[m]=08<br />[4]=000X</small>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="expire">กำหนดอายุเอกสาร</label>
                                                    <input type="text" class="form-control" name="expire" id="expire" placeholder="กำหนดอายุเอกสาร" aria-describedby="expireHelp">
                                                    <small id="expireHelp" class="form-text text-muted">Ex. 90 days<br />Ex. 6 months<br />Ex. 3 years</small>
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
        const depId = <?= $_SESSION['LOGIN']['user']['role']['depId'] ?>;
        const userId = <?= $_SESSION['LOGIN']['user']['role']['userId'] ?>;

        const fullURL = window.location.href;
        const url = new URL(fullURL);
        const id = url.searchParams.get("id");

        $(function() {

            function loadData(id) {
                $.ajax({
                    type: 'GET',
                    url: "<?= API_URL ?>" + `v2/documentType/${id}`,
                    data: $('#formData').serialize()
                }).done(function(resp) {
                    console.log(resp.data);
                    $("#code").val(resp.data.code)
                    $("#desc").val(resp.data.desc)
                    $("#parent").val(resp.data.parent).trigger("change");
                    $("#pattern").val(resp.data.pattern)
                    $("#expire").val(resp.data.expire)
                })
            }

            $('.select2').select2({
                width: '100%'
            })
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            })
            $('#formDataxxx').on('submit', function(e) {
                e.preventDefault()
                console.log($(this).serialize())
                // $.ajax({
                //     type: 'POST',
                //     url: '<?= API_URL ?>v2/department/add',
                //     data: $('#formData').serialize()
                // }).done(function(resp) {
                //     Swal.fire({
                //         text: 'เพิ่มข้อมูลเรียบร้อย',
                //         icon: 'success',
                //         confirmButtonText: 'ตกลง',
                //     }).then((result) => {
                //         location.assign('<?= BASE_URL ?>pages/department');
                //     });
                // })
            });
            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         // alert("Form successful submitted!");
            //         e.preventDefault()
            //         console.log($(this).serialize())
            //         $.ajax({
            //             type: 'POST',
            //             url: '<?= API_URL ?>v2/department/add',
            //             data: $('#formData').serialize()
            //         }).done(function(resp) {
            //             Swal.fire({
            //                 text: 'เพิ่มข้อมูลเรียบร้อย',
            //                 icon: 'success',
            //                 confirmButtonText: 'ตกลง',
            //             }).then((result) => {
            //                 location.assign('<?= BASE_URL ?>pages/department');
            //             });
            //         })
            //     }
            // });
            $('#formData').submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    desc: {
                        required: true,
                        minlength: 5
                    },
                    expire: {
                        required: true,
                    },
                },
                messages: {
                    desc: {
                        required: "ชื่อประเภทเอกสาร ห้ามเว้นว่าง",
                        minlength: "ไม่น้อยกว่า 5 ตัวอักษร"
                    },
                    expire: {
                        required: "เอกสารหมดอายุ ห้ามเว้นว่าง",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    // if (element.hasClass('select2')) {
                    // error.insertAfter(element.next('.select2-container')).addClass('invalid-feedback');
                    // select2label = label
                    if (element.hasClass('select2') && element.next('.select2-container').length) {
                        // error.insertAfter(element.next('.select2-container'));
                        // }
                        error.insertAfter(element.next('.select2-container')).addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    } else {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    // console.log(element);
                    // if (element.hasClass('select2')) {
                    //     $(element).addClass('is-invalid');
                    // } else {
                    $(element).addClass('is-invalid');
                    // }
                },
                // unhighlight: function(element, errorClass, validClass) {
                //     $(element).removeClass('is-invalid');
                // },
                submitHandler: function(form) {
                    // This function will be called when the form is valid
                    // Add the dynamic elements
                    var elDep = $(`<input type="hidden" name="dep_id" value="${depId}">`);
                    $('#formData').append(elDep);

                    console.log($('#formData').serialize())
                    $.ajax({
                        type: 'POST',
                        url: '<?= API_URL ?>'+`v2/documentType/${id}/update`,
                        data: $('#formData').serialize()
                    }).done(function(resp) {
                        Swal.fire({
                            text: 'อัพเดทข้อมูลเรียบร้อย',
                            icon: 'success',
                            confirmButtonText: 'ตกลง',
                        }).then((result) => {
                            location.assign('<?= BASE_URL ?>pages/documentType');
                        });
                    })
                }
            });

            getDataDocType(depId)
            loadData(id)
        });

        function getDataDocType(id) {
            // console.log(el);
            $.ajax({
                url: "<?= API_URL ?>" + `v2/documentType/${id}/parent`,
                method: "GET",
                success: function(result) {
                    // console.log(result);
                    $("#parent").html("");
                    $("#parent").append(
                        `<option></option>`
                    );
                    $.each(result.data, function(index, ref) {
                        // var select = "";
                        // if (ref.id == id) {
                        //     select = ' selected = "selected"';
                        // }
                        $("#parent").append(
                            '<option value="' +
                            ref.id +
                            '"' +
                            // select +
                            `>${ref.desc} [${ref.expire}]</option>`
                        );
                    });
                },
            });
        }
    </script>

</body>

</html>