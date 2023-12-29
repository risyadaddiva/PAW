<?php
session_start();

// connect ke database
$conn = mysqli_connect("localhost", "root", "", "logiscoy");

// tambah alat
if(isset($_POST['tambahalat'])){
    $namaalat = $_POST['namaalat'];
    $desc = $_POST['desc'];
    $stok = $_POST['stok'];

    $addtotable = mysqli_query($conn, "insert into alat (nama_alat, deskripsi, stok) values('$namaalat','$desc','$stok')");

};

// alat masuk
if(isset($_POST['alatmasuk'])){
    $alatnya = $_POST['alatnya'];
    $ket = $_POST['ket'];
    $qty = $_POST['qty'];

    $cekstok = mysqli_query($conn, "SELECT * FROM alat WHERE id_barang='$alatnya'");
    $ambildatanya = mysqli_fetch_array($cekstok);
    
    $stoksekarang = $ambildatanya['stok'];
    $jumlahin = $stoksekarang + $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO alat_masuk (id_barang, ket, qty) VALUES ('$alatnya','$ket','$qty')");
    $updatestok = mysqli_query($conn, "UPDATE alat SET stok='$jumlahin' WHERE id_barang='$alatnya'");

}


// alat keluar
if(isset($_POST['alatkeluar'])){
    $alatnya = $_POST['alatnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $cekstok = mysqli_query($conn, "SELECT * FROM alat WHERE id_barang='$alatnya'");
    $ambildatanya = mysqli_fetch_array($cekstok);
    
    $stoksekarang = $ambildatanya['stok'];
    $jumlahin = $stoksekarang - $qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO alat_keluar (id_barang, penerima, qty) VALUES ('$alatnya','$penerima','$qty')");
    $updatestok = mysqli_query($conn, "UPDATE alat SET stok='$jumlahin' WHERE id_barang='$alatnya'");

    if($addtomasuk && $updatestok){
        header('location:keluar.php');
    }else{
        echo 'Gagal Menambahkan';
        header('location:keluar.php');
    }
}

// edit alat
if(isset($_POST['update'])){
    $idalat = $_POST['idb'];
    $updatealat = $_POST['namaalat'];
    $updatedesk = $_POST['desc'];

    $update = mysqli_query($conn, "UPDATE alat SET nama_alat='$updatealat', deskripsi='$updatedesk' WHERE id_barang='$idalat' ");

    if($update){
        header('location:index.php');
    }else{
        echo 'Gagal Menambahkan';
        header('location:masuk.php');
    }
}

// hapus alat
if(isset($_POST['delete'])){
    $idalat = $_POST['idb'];

    $hapus = mysqli_query($conn, "DELETE from alat WHERE id_barang='$idalat' ");

    if($hapus){
        header('location:index.php');
    }else{
        echo 'Gagal Menambahkan';
        header('location:masuk.php');
    }
}

?>