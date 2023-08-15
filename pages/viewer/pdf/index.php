<?php
include_once "../../../config.php";

// echo APP_NAME, '<br/>';
// echo API_URL, '<br/>';
// echo BASE_URL, '<br/>';
// echo '<pre>', print_r($_GET, 1), '</pre>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF : Viewer</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body onload="loadPDF()" oncontextmenu="return false;">
    <h1>Preview Document</h1>
    <iframe id="pdfViewer" src="" width="100%" height="600"></iframe>

    <!-- scripts -->
    <script src="<?= BASE_URL ?>plugins/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <script>
        const fileName = '<?= $_GET['e'] ?>';

        // document.oncontextmenu = function() {
        //     return false;
        // };

        document.getElementById('pdfViewer').addEventListener('contextmenu', function(event) {
            event.preventDefault(); // Prevent the default right-click menu
            return false
        });

        function loadPDF() {
            $.ajax({
                type: "GET",
                // url: "<?= API_URL ?>" + `v2/document/report/expire/${id}`
                url: "<?= API_URL ?>" + `v2/document/${fileName}`
            }).done(function(data) {
                console.log(data);
                var pdfUrl = data.url; // Replace with the actual URL of your PDF file
                var iframe = document.getElementById('pdfViewer');
                iframe.src = pdfUrl;
            }).fail(function() {
                Swal.fire({
                    text: 'ไม่สามารถเรียกดูข้อมูลได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง',
                }).then(function() {
                    location.assign('<?= BASE_URL ?>pages/documents')
                })
            })
        }
    </script>
</body>

</html>