<?php

/**
 * Page Manager
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
    <title>จัดการเอกสาร | <?= APP_NAME ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/images/favicon.ico">
    <!-- stylesheet -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once('../includes/sidebar.php') ?>
        <div class="content-wrapper pt-3">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-header border-0 pt-4">
                                    <h4>
                                        <i class="fas fa-file-pdf fa-lg"></i>
                                        เอกสาร
                                    </h4>
                                    <a href="form-create.php" class="btn btn-primary mt-3">
                                        <i class="fas fa-plus"></i>
                                        เพิ่มข้อมูล
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table id="logs" class="table table-hover" width="100%"></table>
                                </div>
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
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <!-- datatables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

    <script>
        const url = '<?= API_URL ?>'
        const depId = '<?= $_SESSION['LOGIN']['user']['role']['depId']  ?>'
        $(function() {
            $.ajax({
                type: "GET",
                url: `${url}v2/document/${depId}/all`
            }).done(function(data) {
                let tableData = []
                data.data.forEach(function(item, index) {
                    tableData.push([
                        // `<span class="btn btn-outline-${item.ref_doc_type_id==1?'success':item.ref_doc_type_id==2?'info':item.ref_doc_type_id==3?'warning':'primary'}"> ${item.ref_doc_type} </span>`,
                        // `<span class="btn btn-outline-info"> ${item.ref_doc_type}[${item.id}] </span>`,
                        item.ref_doc_type,
                        item.ref_doc,
                        item.ref_dep,
                        item.image_name,
                        // `<a href="../members/profile.php?id=${item.mem_id}">
                        //     ${item.file_name}
                        // </a>`,
                        // item.ref,
                        `<span class="text-muted small">${item.expire_date_at}</span>`,
                        `<span class="text-muted"> ${item.ref_user} </span>  `,
                        // `<a href="info.php?o_id=${item.id}" class="btn btn-info">
                        //     <i class="fas fa-search"></i> ดูข้อมูล
                        // </a>`,
                        `<div class="btn-group" role="group">
                            <button type="button" class="btn btn-info" id="preview" data-file-nane="${item.file_name}">
                                <i class="far fa-eye"></i> ดูู
                            </button>
                        </div>`
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
                $('#logs').DataTable({
                    data: tableData,
                    columns: [{
                            title: "ประเภทเอกสาร",
                            className: "align-middle"
                        },
                        {
                            title: "เอกสาร",
                            className: "align-middle"
                        },
                        {
                            title: "แผนก",
                            className: "align-middle"
                        },
                        {
                            title: "ชื่อเอกสาร",
                            className: "align-middle"
                        },
                        // {
                        //     title: "ชื่อไฟล์เอกสาร",
                        //     className: "align-middle"
                        // },
                        // {
                        //     title: "อ้างอิง",
                        //     className: "align-middle"
                        // },
                        {
                            title: "วันที่เอกสารหมดอายุ",
                            className: "align-middle"
                        },
                        {
                            title: "ผู้บันทึก",
                            className: "align-middle"
                        },
                        {
                            title: "จัดการ",
                            className: "align-middle"
                        }
                    ],
                    initComplete: function() {
                        $(document).on('click', '#preview', function() {
                            const fileName = $(this).data('file-nane')
                            // console.log(fileName);
                            $.ajax({
                                type: "GET",
                                url: `${url}v2/document/${fileName}`,
                            }).done(function(data) {
                                // console.log(data); // แสดงข้อมูล JSON จาก then ข้างบน
                                // console.log(data.url); // แสดงข้อมูล JSON จาก then ข้างบน
                                window.open(data.url, "_blank", "noopener,noreferrer");
                            })
                            // Swal.fire({
                            //     text: "คุณแน่ใจหรือไม่...ที่จะลบรายการนี้?",
                            //     icon: 'warning',
                            //     showCancelButton: true,
                            //     confirmButtonText: 'ใช่! ลบเลย',
                            //     cancelButtonText: 'ยกเลิก'
                            // }).then((result) => {
                            //     if (result.isConfirmed) {
                            //         $.ajax({
                            //             type: "DELETE",
                            //             url: "../../service/members/delete.php",
                            //             data: {
                            //                 id: id
                            //             }
                            //         }).done(function() {
                            //             Swal.fire({
                            //                 text: 'รายการของคุณถูกลบเรียบร้อย',
                            //                 icon: 'success',
                            //                 confirmButtonText: 'ตกลง',
                            //             }).then((result) => {
                            //                 location.reload()
                            //             })
                            //         })
                            //     }
                            // })
                        })
                    },
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data()
                                    return 'ใบสั่งซื้อ: ' + data[1]
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
            }

        })
    </script>
</body>

</html>