<?php

use Master\Karyawan;
use Master\Gaji;
use Master\Bagian;
use Master\Menu;

include ('autoload.php'); 
include('Config/Database.php'); 

$menu = new Menu(); 
$karyawan = new Karyawan($dataKoneksi);
$gaji = new Gaji($dataKoneksi);
$bagian = new Bagian($dataKoneksi);

$karyawan->tambah();
$target = @$_GET['target'];
$act = @$_GET['act'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPP BAKESBANGPOL Banyuwangi</title>
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script scr="assets/bootstrap/js/bootstrap.bundle.min.js" ></script>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SIPP BAKESBANGPOL Banyuwangi</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#MyMenu" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse id="MyMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                foreach ($menu->topMenu() as $r) {
                    ?>
                    <li class="nav-item">
                        <a href="<?php echo $r['Link']; ?>" class="nav-link">
                            <?php echo $r['Text']; ?>
                        </a>
                    </li>
                    <?php
                }
            ?>
            </ul>
            </div>
            </div>
        </nav>
        <br>
        <div class="Content">
            <h5>Content <?php echo strtoupper($target); ?></h5>
            <?php
            if (!isset($target) or $target == "home") {
                echo "Hello, Welcome to Website Sistem Informasi Penggajian Pegawai Badan Kesatuan Bangsa dan Politik Kabupaten Banyuwangi";

                // ========== star kontent karyawan ================

            } elseif ($target == "karyawan") {
                if ($act == "tambah_karyawan") {
                    echo $karyawan->tambah();
                } elseif ($act == "simpan_karyawan") {
                    if ($karyawan->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=karyawan';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=karyawan';
                        </script>";
                    }
                } elseif ($act == "edit_karyawan") {
                    $id = $_GET['id'];
                    echo $karyawan->edit($id);
                } elseif ($act == "update_karyawan") {
                    if ($karyawan->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=karyawan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=karyawan';
                        </script>";
                    }
                } elseif ($act == "delete_karyawan") {
                    $id = $_GET['id'];
                    if ($karyawan->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=karyawan';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=karyawan';
                        </script>";
                    }
                } else {
                    echo $karyawan->index();
                }
                // ======================== end kontent karyawan =====================
                // ======================== Star gaji ========================
            } elseif ($target == "gaji") {
                if ($act == "tambah_gaji") {
                    echo $gaji->tambah();
                } elseif ($act == "simpan_gaji") {
                    if ($gaji->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=gaji';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=gaji';
                        </script>";
                    }
                } elseif ($act == "edit_gaji") {
                    $id = $_GET['id'];
                    echo $gaji->edit($id);
                } elseif ($act == "update_gaji") {
                    if ($gaji->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=gaji';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=gaji';
                        </script>";
                    }
                } elseif ($act == "delete_gaji") {
                    $id = $_GET['id'];
                    if ($gaji->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=gaji';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=gaji';
                        </script>";
                    }
                } else {
                    echo $gaji->index();
                }

                // ======================== Star kontent bagian ========================

            } elseif ($target == "bagian") {
                if ($act == "tambah_bagian") {
                    echo $bagian->tambah();
                } elseif ($act == "simpan_bagian") {
                    if ($bagian->simpan()) {
                        echo "<script>
                            alert('data suskess disimpan');
                            window.location.href='?target=bagian';
                            </script>";
                    } else {
                        echo "<script>
                        alert('data gagal disimpan');
                        window.location.href='?target=bagian';
                        </script>";
                    }
                } elseif ($act == "edit_bagian") {
                    $id = $_GET['id'];
                    echo $bagian->edit($id);
                } elseif ($act == "update_bagian") {
                    if ($bagian->update()) {
                        echo "<script>
                            alert('data suksess diubah');
                            window.location.href='?target=bagian';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal diubah');
                        window.location.href='?target=bagian';
                        </script>";
                    }
                } elseif ($act == "delete_bagian") {
                    $id = $_GET['id'];
                    if ($bagian->delete($id)) {
                        echo "<script>
                        alert('data suksess dihapus');
                        window.location.href='?target=bagian';
                        </script>";
                    } else {
                        echo "<script>
                        alert('data gagal dihapus');
                        window.location.href='?target=bagian';
                        </script>";
                    }
                } else {
                    echo $bagian->index();
                }
                // no page
            } else {
                echo " Page 404 Not Found";
            }
            ?>
            
            </div>
        </div>

</body>

</html>