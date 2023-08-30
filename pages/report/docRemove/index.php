<?php

/**
 * Page Manager
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
require_once('../../authenSub.php');

// echo '<pre>', print_r($_SERVER, 1), '</pre>';
// echo $_SERVER['DOCUMENT_ROOT'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>รายงานเอกสารที่ลบแล้ว | <?= APP_NAME ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?= BASE_URL ?>assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="<?= BASE_URL ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="<?= BASE_URL ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <style>
        .warning {
            background-color: #FFC28B;
            /* Add other styles for highlighting */
        }

        .danger {
            background-color: #FE6D4E;
            /* Add other styles for highlighting */
        }

        .remove {
            background-color: #819898;
            /* Add other styles for highlighting */
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/pages/includes/sidebar.php") ?>
        <div class="content-wrapper pt-3">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                        <i class="fas  fa-solid fa-file text-maroon"></i>
                                        รายงานเอกสารที่ลบแล้ว
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <table id="logs" class="table table-hover" width="100%">
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/pages/includes/footer.php') ?>
    </div>

    <!-- scripts -->
    <script src="<?= BASE_URL ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/adminlte.min.js"></script>

    <!-- datatables -->
    <script src="<?= BASE_URL ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script>
        const depId = <?= $_SESSION['LOGIN']['user']['role']['depId'] ?>;
        const userId = <?= $_SESSION['LOGIN']['user']['role']['userId'] ?>;
        $(function() {
            $.ajax({
                type: "GET",
                url: "<?= API_URL ?>" + `v2/document/report/expired`,
                timeout: 0,
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                },
            }).done(function(data) {
                // console.log(data.data);
                let tableData = []
                data.data.forEach(function(item, index) {
                    tableData.push([
                        ++index,
                        item.id,
                        // item.ref_dep_id,
                        item.dep_desc,
                        item.create_doc_date,
                        // item.doc_type_id,
                        item.type_desc,
                        // item.doc_id,
                        item.doc_desc,
                        item.image_name,
                        item.expire_doc_date,
                        item.remain_date,
                    ])
                })
                initDataTables(tableData)
            }).fail(function() {
                Swal.fire({
                    text: 'ไม่สามารถเรียกดูข้อมูลได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                }).then(function() {
                    location.assign('../dashboard')
                })
            })

            function initDataTables(tableData) {
                var table = $('#logs').DataTable({
                    data: tableData,
                    columns: [{
                            title: "ลำดับ",
                            className: "align-middle"
                        },
                        {
                            title: "#",
                            className: "align-middle", // Index of the column (0-based)
                            "visible": false
                        },
                        {
                            title: "แผนก",
                            className: "align-middle", // Index of the column (0-based)
                            "visible": true
                        },
                        {
                            title: "วันที่สร้าง",
                            className: "align-middle"
                        },
                        {
                            title: "ชื่อประเภทเอกสาร",
                            className: "align-middle"
                        },
                        {
                            title: "เอกสาร",
                            className: "align-middle"
                        },
                        {
                            title: "ชื่อเอกสาร",
                            className: "align-middle"
                        },
                        {
                            title: "วันหมดอายุ",
                            className: "align-middle"
                        },
                        {
                            title: "จำนวนหมดอายุ",
                            className: "align-middle",
                            visible: false
                        },
                    ],
                    initComplete: function() {
                        $(document).on('click', '#delete', function() {
                            let id = $(this).data('id')
                            let index = $(this).data('index')
                            Swal.fire({
                                text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonText: 'ใช่! ลบเลย',
                                cancelButtonText: 'ยกเลิก'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        type: "POST",
                                        url: `<?= API_URL ?>v2/documentType/${id}/delete`,
                                    }).done(function() {
                                        Swal.fire({
                                            text: 'รายการของคุณถูกลบเรียบร้อย',
                                            icon: 'success',
                                            confirmButtonText: 'ตกลง',
                                        }).then((result) => {
                                            location.reload()
                                        })
                                    })
                                }
                            })
                        })
                    },
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data()
                                    return 'ผู้ใช้งาน: ' + data[1]
                                }
                            }),
                            renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                                tableClass: 'table'
                            })
                        }
                    },
                    language: {
                        "lengthMenu": "แสดงข้อมูล _MENU_ แถว",
                        "zeroRecords": "ไม่พบข้อมูลที่ต้องการ",
                        "info": "แสดงหน้า _PAGE_ จาก _PAGES_",
                        "infoEmpty": "ไม่พบข้อมูลที่ต้องการ",
                        "infoFiltered": "(filtered from _MAX_ total records)",
                        "search": 'ค้นหา',
                        "paginate": {
                            "previous": "ก่อนหน้านี้",
                            "next": "หน้าต่อไป"
                        }
                    }
                })

                // set row hightlight
                // table.rows().every(function() {
                //     // var rowData = this.data();
                //     // // console.log(rowData);
                //     // var remain = parseInt(rowData[8]); // Assuming age is in the second column
                //     // console.log(remain);
                //     // if (remain > -15) {
                //     //     $(this.node()).addClass('warning'); // Add the highlight class
                //     // } else
                //     // if (remain  -31) {
                //     //     $(this.node()).addClass('danger'); // Add the highlight class
                //     // }
                // });
            }

        })
    </script>
</body>

</html>