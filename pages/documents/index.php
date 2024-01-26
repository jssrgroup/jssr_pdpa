<?php
require_once('../authen.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>จัดการเอกสาร | <?= APP_NAME ?></title>
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
        .danger {
            background-color: #FE6D4E;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/includes/sidebar.php') ?>
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
                                    <a href="<?= BASE_URL ?>pages/documents/form-create.php" class="btn btn-primary mt-3">
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
        <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/pages/includes/footer.php') ?>
    </div>
    <form id="preview" action="<?= BASE_URL ?>pages/viewer/pdf/index.php" method="post" target="_blank">
        <input type="hidden" name="e" id="e">
    </form>

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
        const url = '<?= API_URL ?>'
        const depId = '<?= $_SESSION['LOGIN']['user']['role']['depId']  ?>'
        const userId = '<?= $_SESSION['LOGIN']['user']['id']  ?>'
        $(function() {
            $.ajax({
                type: "GET",
                url: `${url}v2/document/${depId}/all`,
                timeout: 0,
                headers: {
                    "Accept": "application/json",
                    "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                },
            }).done(function(data) {
                let tableData = []
                data.data.forEach(function(item, index) {
                    const del =
                        (item.ref_user_id == userId) ?
                        `<div class="btn-group" role="group">
                            <button type="button" class="btn btn-danger" id="delete" data-doc-id="${item.id}" data-image-name="${item.image_name}">
                                <i class="far fa-trash-alt"></i> ลบ
                            </button>
                        </div>` : ''
                    tableData.push([
                        // `<span class="btn btn-outline-${item.ref_doc_type_id==1?'success':item.ref_doc_type_id==2?'info':item.ref_doc_type_id==3?'warning':'primary'}"> ${item.ref_doc_type} </span>`,
                        // `<span class="btn btn-outline-info"> ${item.ref_doc_type}[${item.id}] </span>`,
                        // item.id,
                        item.ref_doc_type,
                        item.ref_doc,
                        item.ref_dep,
                        item.image_name,
                        // `<a href="../members/profile.php?id=${item.mem_id}">
                        //     ${item.file_name}
                        // </a>`,
                        // item.ref,
                        `<span class="text-muted small">${item.expire_date_at}</span>`,
                        item.expire_num,
                        `<span class="text-muted"> ${item.ref_user} </span>  `,
                        // `<a href="info.php?o_id=${item.id}" class="btn btn-info">
                        //     <i class="fas fa-search"></i> ดูข้อมูล
                        // </a>`,
                        `<div class="btn-group" role="group">
                            <button type="button" class="btn btn-info" id="preview" data-doc-id="${item.id}" data-file-name="${item.file_name}">
                                <i class="far fa-eye"></i> ดูู
                            </button>
                        </div> ${del}`
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
                            title: "xxx",
                            className: "align-middle",
                            "visible": false
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
                            const fileName = $(this).data('file-name')
                            const docId = $(this).data('doc-id')
                            // window.open("<//?= BASE_URL ?>"+`pages/viewer/pdf/index.php?e=${fileName}`, "_blank", "noopener,noreferrer");
                            // console.log(docId);
                            // $('#e').val(fileName)
                            // console.log($('#e').val());
                            // // $('#preview').submit()
                            // document.getElementById("preview").submit();

                            $.ajax({
                                url: `${url}v2/document/${fileName}`,
                                method: 'GET',
                                timeout: 0,
                                headers: {
                                    "Accept": "application/json",
                                    "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                                },
                                data: {
                                    docId: docId
                                },
                                success: function(response) {
                                    // console.log(response);
                                    window.open(response.url, "_blank", "noopener,noreferrer");
                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }
                            });
                        })
                        $(document).on('click', '#delete2', function() {
                            var currentHost = window.location.hostname;

                            console.log("Host:", currentHost);

                            var currentURL = window.location.href;

                            console.log("Current URL:", currentURL);

                        })
                        $(document).on('click', '#delete', function() {
                            const imageName = $(this).data('image-name')
                            const docId = $(this).data('doc-id')
                            console.log(imageName);
                            console.log(docId);

                            Swal.fire({
                                title: `ต้องการลบเอกสาร ${imageName} ใช่หรือไม่`,
                                showDenyButton: false,
                                showCancelButton: true,
                                confirmButtonText: "ลบ",
                                denyButtonText: `Don't save`
                            }).then((result) => {
                                /* Read more about isConfirmed, isDenied below */
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: `${url}v2/document/${docId}`,
                                        method: 'DELETE',
                                        timeout: 0,
                                        headers: {
                                            "Accept": "application/json",
                                            "Authorization": "Bearer <?= $_SESSION['LOGIN']['access_token'] ?>"
                                        },
                                        success: function(response) {
                                            Swal.fire({
                                                icon: "success",
                                                title: `${imageName} ลบแล้ว`,
                                                showConfirmButton: false,
                                                timer: 1500,
                                                timerProgressBar: true
                                            }).then((result) => {
                                                if (result.dismiss === Swal.DismissReason.timer) {
                                                    window.location = window.location.href;
                                                }
                                            });
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });

                                } else if (result.isDenied) {
                                    Swal.fire("Changes are not saved", "", "info");
                                }
                            });
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

                table.rows().every(function() {
                    var rowData = this.data();
                    // console.log(rowData);
                    var remain = parseInt(rowData[5]); // Assuming age is in the second column
                    // console.log(remain);

                    if (remain < 0) {
                        $(this.node()).addClass('danger'); // Add the highlight class
                    }
                });
            }

        })
    </script>
</body>

</html>