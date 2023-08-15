<?php

/**
 * Main Sidebar
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
function isActive($data, $step = 1)
{
    $array = explode('/', $_SERVER['REQUEST_URI']);
    $key = array_search("pages", $array);
    $name = $array[$key + $step];
    return $name === $data ? 'active' : '';
}
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-2x"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto ">
        <li class="nav-item d-md-none d-block">
            <a href="<?= BASE_URL ?>pages/dashboard/">
                <img src="<?= BASE_URL ?>assets/images/AdminLogo.png" alt="Admin Logo" width="50px" class="img-circle elevation-3">
                <span class="font-weight-light pl-1">PDPA System</span>
            </a>
        </li>
        <li class="nav-item d-md-block d-none">
            <a class="nav-link">เข้าสู่ระบบครั้งล่าสุด: <?= date('d/m/Y H:i:s', $_SESSION['LOGIN']['user']['lastLogin']) ?> </a>
        </li>
    </ul>
</nav>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= BASE_URL ?>pages/dashboard/" class="brand-link">
        <img src="<?= BASE_URL ?>assets/images/AdminLogo.png" alt="Admin Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">PDPA System</span>
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= BASE_URL ?>assets/images/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= BASE_URL ?>pages/manager/" class="d-block"> <?php echo $_SESSION['LOGIN']['user']['name'] ?> </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/dashboard/" class="nav-link <?php echo isActive('dashboard') ?>">
                        <i class="nav-icon fas fa-tachometer-alt text-blue"></i>
                        <p>หน้าหลัก</p>
                    </a>
                </li>
                <li class="nav-header">ตั้งค่า</li>
                <li class="nav-item d-none">
                    <a href="<?= BASE_URL ?>pages/useradmin/" class="nav-link <?php echo isActive('useradmin') ?>">
                        <i class="nav-icon fas fa-user-cog text-maroon"></i>
                        <p>useradmin</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/manager/" class="nav-link <?php echo isActive('manager') ?>">
                        <i class="nav-icon fas fa-user-cog text-cyan"></i>
                        <p>ผู้ดูแลระบบ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/department/" class="nav-link <?php echo isActive('department') ?>">
                        <i class="nav-icon fas fa-building text-teal"></i>
                        <p>แผนก</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/documentType/" class="nav-link <?php echo isActive('documentType') ?>">
                        <i class="nav-icon fas fa-solid fa-folder-open text-fuchsia"></i>
                        <p>ประเภทเอกสาร</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/employees/" class="nav-link <?php echo isActive('employees') ?>">
                        <i class="nav-icon fas fa-user text-yellow"></i>
                        <p>รายชื่อพนักงาน</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/members/" class="nav-link <?php echo isActive('members') ?>">
                        <i class="nav-icon fas fa-users text-indigo"></i>
                        <p>รายชื่อลูกค้า</p>
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a href="<?= BASE_URL ?>pages/products/" class="nav-link <?php echo isActive('products') ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>รายการสินค้า</p>
                    </a>
                </li>
                <li class="nav-header">โปรแกรม</li>
                <li class="nav-item d-none">
                    <a href="<?= BASE_URL ?>pages/orders/" class="nav-link <?php echo isActive('orders') ?>">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>รายการสั่งซื้อ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/documents/" class="nav-link <?php echo isActive('documents') ?>">
                        <i class="nav-icon fas fa-solid fa-file text-maroon"></i>
                        <p>เอกสาร</p>
                    </a>
                </li>
                <li class="nav-header">รายงาน</li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/report/expireStep" class="nav-link <?php echo isActive('expireStep', 2) ?>">
                        <i class="nav-icon fas fa-solid fa-file text-warning"></i>
                        <p>เอกสารใกล้หมดอายุ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/report/docRemove" class="nav-link <?php echo isActive('docRemove', 2) ?>">
                        <i class="nav-icon fas fa-solid fa-file text-maroon"></i>
                        <p>เอกสารที่ลบแล้ว</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/report/historyOpenDoc" class="nav-link <?php echo isActive('historyOpenDoc', 2) ?>">
                        <i class="nav-icon fas fa-solid fa-file text-gray"></i>
                        <p>การเข้าดูเอกสาร</p>
                    </a>
                </li>
                <li class="nav-header">บัญชีของเรา</li>
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>pages/logout.php" id="logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>ออกจากระบบ</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>