<?php
require 'koneksi.php';
require 'cek.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Logistik - Mahapeka</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
        <a class="navbar-brand" href="index.php">Logiscoy</a>
        <img class="logo" src="assets/img/MHPK.svg" alt="logo" width="100" height="100">
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>

                            <a class="nav-link" href="masuk.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Alat Masuk
                            </a>

                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Alat Keluar
                            </a>
                        </div>
                    </div>
                    <a class="nav-link" href="logout.php">
                                Logout
                    </a>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Alat Keluar</h1>

                        <div class="card mb-4">
                            <div class="card-header">
                              <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Masukan Alat
                            </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama Alat</th>
                                                <th>Penerima</th>
                                                <th>Banyak</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                        <?php
                                        $ambilsemuadatastok = mysqli_query($conn, "SELECT * FROM alat_keluar m, alat s where s.id_barang= m.id_barang");
                                        $i = 1;
                                        while($data = mysqli_fetch_array($ambilsemuadatastok)){
                                            $tanggal = $data['tanggal_keluar'];
                                            $namaalat = $data['nama_alat'];
                                            $stok = $data['qty'];
                                            $penerima = $data['penerima'];
                                        ?>
                                            <tr>
                                                <td><?=$i;?></td>
                                                <td><?=$tanggal;?></td>
                                                <td><?=$namaalat;?></td>
                                                <td><?=$penerima;?></td>
                                                <td><?=$stok;?></td>
                                            </tr>
                                        </tbody>

                                        <?php
                                        $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

        <!-- The Modal -->
        <div class="modal fade" id="myModal">
        <div class="modal-dialog">
        <div class="modal-content">
        
            <!-- Modal Header -->
            <div class="modal-header">
            <h4 class="modal-title">Tambah Alat Keluar</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <form method="post">
            <div class="modal-body">
            <select name="alatnya" class="form-control">
            <?php
            $ambildata = mysqli_query($conn, "SELECT * FROM alat");
            while($fetcharray = mysqli_fetch_array($ambildata)){
                $namaalatnya = $fetcharray['nama_alat'];
                $idalatnya = $fetcharray['id_barang'];
            ?>
            <option value="<?=$idalatnya;?>">
                <?=$namaalatnya;?>
            </option>
            <?php
            }
            ?>
        </select>
            <br>
            <input type="text" name="penerima" placeholder="penerima" class="form-control" required>
            <br>
            <input type="number" name="qty" placeholder="jumlah" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="alatkeluar">Tambah</button>
            </div>
            </form>
            
        </div>
        </div>
    </div>
    <!-- modal end -->
</html>
