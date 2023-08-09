<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../../assets/css/adminlte.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>

    <form id="formData" class="needs-validation container" novalidate>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="form-control-label" for="name">ชื่อ</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="ชื่อ" />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parent">อยู่ภายใต้</label>
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
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>


    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script src="../../plugins/select2/js/select2.full.min.js"></script>
    <script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../../assets/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Initialize jQuery Validation
            $('#formData').submit(function(e) {
                e.preventDefault();
            }).validate({
                rules: {
                    name: {
                        required: true
                    },
                    parent: {
                        required: true
                    }
                },
                messages: {
                    nane: {
                        required: 'Please fill a name.'
                    },
                    parent: {
                        required: 'Please select an option.'
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                    // if (element.prop("type") === "radio") {
                    //     error.insertAfter(element.parent().parent().parent().parent());
                    // } else {
                    //     error.appendTo(element.parent());
                    // }
                },
                highlight: function(element, errorClass, validClass) {
                    // $(element).addClass(errorClass).removeClass(validClass);
                    $(element).addClass('is-invalid');
                    if ($(element).hasClass('select2-hidden-accessible')) {
                        $(element).parent().eq(1).addClass('is-invalid');
                        // $(element).addClass('is-invalid');
                    }
                },
                unhighlight: function(element, errorClass, validClass) {
                    // $(element).removeClass(errorClass).addClass(validClass);
                    // if ($(element).hasClass('select2-hidden-accessible')) {
                    //     $(element).next('.select2-container').removeClass(errorClass);
                    // }
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    console.log($('#formData').serialize())
                }
            });
        });
    </script>
</body>

</html>