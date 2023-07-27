<?php

/**
 * Login Page
 *
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>AppzStory Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">
  <!-- stylesheet -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Kanit">
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
  <header class="bg"></header>
  <section class="d-flex align-items-center min-vh-100">
    <div class="container">
      <div class="row justify-content-center">
        <section class="col-lg-6">
          <div class="card shadow p-3 p-md-4">
            <h1 class="text-center text-primary font-weight-bold">PDPA System</h1>
            <h4 class="text-center">เข้าสู่ระบบหลังบ้าน</h4>
            <div class="card-body">
              <!-- HTML Form Login -->
              <form id="formLogin">
                <div class="form-group col-sm-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text px-2">ชื่อผู้ใช้งาน</div>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="username">
                  </div>
                </div>
                <div class="form-group col-sm-12">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <div class="input-group-text px-3">รหัสผ่าน</div>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="password">
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block"> เข้าสู่ระบบ</button>
              </form>
              <div>
                <button type="button" class="btn btn-default btn-block acc-ia">IA</button>
                <button type="button" class="btn btn-primary btn-block acc-am">AM</button>
                <button type="button" class="btn btn-danger btn-block acc-acc">บัญชี</button>
                <button type="button" class="btn btn-warning btn-block acc-law">กฎหมาย</button>
                <button type="button" class="btn btn-info btn-block acc-hr">HR</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </section>

  <!-- script -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="plugins/toastr/toastr.min.js"></script>
  <script>
    $(function() {
      /** Ajax Submit Login */
      $("#formLogin").submit(function(e) {
        e.preventDefault()
        $.ajax({
          type: "POST",
          url: "service/auth/login.php",
          data: $(this).serialize()
        }).done(function(resp) {
          console.log(resp);
          toastr.success('เข้าสู่ระบบเรียบร้อย')
          setTimeout(() => {
            location.href = 'pages/dashboard/'
          }, 800)
        }).fail(function(resp) {
          toastr.error('ไม่สามารถเข้าสู่ระบบได้')
        })
      })

      $(".acc-ia").click(function(){
        $("input[name='username']").val('supalerk')
        $("input[name='password']").val('Supalerk@9598X')
        $("#formLogin").submit()
      })

      $(".acc-am").click(function(){
        $("input[name='username']").val('anusorn')
        $("input[name='password']").val('Anusorn@9560')
        $("#formLogin").submit()
      })

      $(".acc-acc").click(function(){
        $("input[name='username']").val('ann')
        $("input[name='password']").val('Ann@74253')
        $("#formLogin").submit()
      })

      $(".acc-law").click(function(){
        $("input[name='username']").val('ranai2')
        $("input[name='password']").val('rp@1964L')
        $("#formLogin").submit()
      })

      $(".acc-hr").click(function(){
        $("input[name='username']").val('hrgroup')
        $("input[name='password']").val('Jssr@hr100')
        $("#formLogin").submit()
      })
    })
  </script>
</body>

</html>