<?php
include_once "../controllers/c_album.php";

$album = new c_album();

if ($_GET['aksi'] == 'tambah') {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST ['namaalbum'];
    $deskripsi = $_POST ['deskripsi'];
    $tanggaldibuat = $_POST ['tanggaldibuat'];
    
    $tipe = array('png','jpg');
    $photo = $_FILES["photo"]["name"];
    $tmp = $_FILES["photo"]["tmp_name"];
    $x = explode('.',$photo);
    $ekstensi = strtolower(end($x));

    $userid = $_POST["userid"];
    if(in_array($ekstensi,$tipe) == true){
   move_uploaded_file($tmp, '../assets/images/' . $photo);

    $album->insert($albumid=0, $namaalbum, $deskripsi, $tanggaldibuat, $photo, $userid);

    echo "<script> alert('album berhasil ditambahkan');
    document.location.href = '../views/v_album.php';
    </script>";

    }else{
        echo "<script> alert('tolong masukan file dengan ekstensi (png/jpg)');
        document.location.href = '../views/tambahalbum.php';
        </script>";
    }

    }elseif ($_GET['aksi'] == 'edit') {
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum']; 
    $deskripsi = $_POST['deskripsi'];
    
    $tipe = array('png','jpg');
    $photo = $_FILES["photo"]["name"];
     $tmp = $_FILES["photo"]["tmp_name"];
     $x = explode('.',$photo);
    $ekstensi = strtolower(end($x));
    if(in_array($ekstensi,$tipe) == true){
    move_uploaded_file("$tmp", "../assets/images/" . $photo);
        
    $album->update($albumid, $namaalbum, $deskripsi, $photo);
        
        
            echo "<script> alert('Album telah diubah');
         document.location.href = '../views/album.php';
         </script>";
        }else{
            echo "<script> alert('tolong masukan file dengan ekstensi (png/jpg)');
            document.location.href = '../views/editalbum.php?albumid=$albumid';
            </script>";
        
    }
    
    }elseif ($_GET["aksi"] == "delete") {
        $albumid = $_GET["albumid"];
        $album->delete($albumid);
        
        header("Location: ../views/album.php");
}