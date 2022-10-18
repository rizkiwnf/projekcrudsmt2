<?php
    session_start();
    if (!isset($_SESSION['user_is_logged_in']) || $_SESSION['user_is_logged_in'] !== true) {
    header('location: ../sebelumlogin/admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!--js-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <!--css eksternal-->
    <link rel="stylesheet" href="css/admin_tambahdosen.css">
    <!--fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>E-Leaning Website</title>
</head>
<body>
    <!--------------- NAVBAR START --------------->
    <section id="navbars">
        <nav class="navbar fixed-top navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">E-Learning</a>
        </nav>
    </section>
    <!--------------- NAVBAR END --------------->
    <?php
        include '../../koneksi.php';
        $id=$_SESSION['id'];
        $sql="SELECT * FROM admin WHERE id=".$id;
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
            while($row=mysqli_fetch_array($result)){
    ?>
    <!--------------- SIDEBAR START --------------->
    <section id="sidebar">
        <div class="container">
            <div class="side">
                <div class="profile text-center">
                    <?php echo "<img src='../../profile/admin/". $row['foto']."' class='card-img-top'>";
                          echo "<br><br>" .$row['nama_depan']. "&nbsp".$row['nama_belakang'];
                    ?>
                    <a href="admin_halaman.php">As Admin</a>
                </div>
                <div class="icon">
                    <div class="accordion" id="accordionExample">
                        <div class="one">
                            <h2 class="mb-0">
                            <i class="fas fa-user-plus"></i><button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Tambah Data</button>
                            </h2>
                            <div id="collapseOne" class="collapse" data-parent="#accordionExample">
                                <a href="admin_detaidosen.php">Dosen</a> 
                                <a href="admin_detailmhs.php">Mahassiswa</a> </div>
                        </div>
                        <div class="two">
                            <h2 class="mb-0">
                            <i class="fas fa-user-edit"></i><button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Update Data</button>
                            </h2>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                               <a href="admin_detaidosen.php">Dosen</a> 
                               <a href="admin_detailmhs.php">Mahassiswa</a> 
                            </div>
                        </div>
                        <div class="three">
                            <h2 class="mb-0">
                            <i class="fas fa-eraser"></i><button class="btn btn-link text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Hapus Data</button>
                            </h2>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                <a href="admin_detaidosen.php">Dosen</a> 
                                <a href="admin_detailmhs.php">Mahassiswa</a> 
                            </div>
                        </div>
                        <div class="log">
                            <i class="fas fa-arrow-circle-left"></i><a href="../../logout.php" >Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
            
    <!--------------- SIDEBAR END --------------->   
    <!--------------- TAMBAH DOSEN START --------------->
    <section id="tambahdosen">
        <div class="container">
                    <div class="card shadow-lg border-0 mt-4">
                        <div class="card-header text-center">
                            Tambah Dosen
                        </div>
                        <div class="card-body">
                            <form action="admin_tambahdosen2.php" method="post"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="nip" name="nip" placeholder="Masukkan Nomor Induk Pegawai" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="namadepan" name="namadepan" placeholder="Masukkan nama depan" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="namabelakang" name="namabelakang" placeholder="Masukkan nama belakang" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <div class="form-group">
                                                <?php
                                                    $matkul = mysqli_query($conn,"SELECT * FROM matakuliah");
                                                ?>
                                                <select class="form-control" name="matkul" required>
                                                    <option selected>Mata Kuliah</option>
                                                    <?php
                                                        foreach ($matkul as $vmatkul) {
                                                            echo "<option value=" . $vmatkul['id_matakuliah'] . ">" . $vmatkul['matkul'] . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="studi" name="studi" placeholder="Masukkan Pendidikan Terakhir" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="tempat" name="tempat" placeholder="Masukkan Tempat Kelahiran" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan Tanggal Kelahiran" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="umur" name="umur" placeholder="Masukkan Umur" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="jk" name="jk" placeholder="Masukkan Jenis Kelamin" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="nohp" name="nohp" placeholder="Masukkan Nomor HP" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="pass" name="pass" placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <input class="form-control form-control-sm" id="foto" name="foto" type="file">
                                </div>                                    
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                                </div>   
                            </form>
                        </div>
                    </div>
            </div>
    </section>
    <!--------------- TAMBAH DOSEN END --------------->
    <!--------------- HOME START --------------->
    <section id="home">
        <div class="gambar">
                <img src="../../pict/images/wave2.png" alt="">
        </div>
    </section>
    <!--------------- HOME END --------------->
    <?php
    }
}
mysqli_close($conn);
?>
</body>
</html>