<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
            <i class="fa-solid fa-envelope fa-xl"></i>
            <span class="ms-1 text-sm text-dark">E-Surat</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">

            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="index.php?route=dashboard">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#menuSurat" aria-expanded="false">
                    <i class="material-symbols-rounded opacity-5">mail</i>
                    <span class="nav-link-text ms-1">Surat</span>
                    <!-- <i class="fa-solid fa-chevron-down float-end"></i> -->
                </a>
                <div class="collapse" id="menuSurat">
                    <ul class="nav flex-column ms-3">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="index.php?route=surat/masuk">
                                <i class="fa-solid fa-inbox mx-2"></i> Surat Masuk
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="index.php?route=surat/keluar">
                                <i class="fa-solid fa-paper-plane mx-2"></i> Surat Keluar
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php if ($_SESSION['role'] == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="index.php?route=laporan">
                        <i class="material-symbols-rounded opacity-5">receipt_long</i>
                        <span class="nav-link-text ms-1">Laporan</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside>