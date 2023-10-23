<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD PAGE</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>
    <section class="container" style="height: 230vh;">
        <div class="tampil">
            <h3>Daftar data pegawai</h3>
            <p>Pegawai yang terdaftar dan direkrut secara resmi melalui pemerintah</p>
            <a href="create.php" class="tambah">Tambah data pegawai baru</a>
            <form method="GET">
                <input type="text" name="search" placeholder="Cari pegawai..." style="width: 400px; padding:10px 20px; font-size:15px; margin-bottom:20px">
                <button style="font-size:17px; padding:8px 20px;background-color:#283ad6; color:#fff; border:none" type="submit">Cari</button>
            </form>

            <table>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Domisili</th>
                    <th>Jabatan</th>
                    <th>Gaji</th>
                    <th>Foto profile</th>

                </tr>
                <!-- memanggil data dengan looping menggunakan konsep while -->
                <!-- datanya akan mengulang sesuai data yang didapatkan -->
                <?php
                // agak sedikit diakalin untuk id nya 
                $keyword = $_GET['search'] ?? '';
                $i = 1;
                $query = "SELECT * FROM pegawai";
                if (!empty($keyword)) {
                    $query .= " WHERE nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR domisili LIKE '%$keyword%' OR jabatan LIKE '%$keyword%'";
                }
                $querry = mysqli_query($koneksi, $query);
                while ($data = mysqli_fetch_array($querry)) {
                ?>
                    <tr class="datanya">
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data['nama']; ?></td>
                        <td><?php echo $data['alamat']; ?></td>
                        <td><?php echo $data['domisili']; ?></td>
                        <td><?php echo $data['jabatan']; ?></td>
                        <td><?php echo $data['gaji']; ?></td>
                        <td><img src="<?php echo $data['foto']; ?>" alt="Foto Pegawai" width="100"></td>

                    </tr>
                <?php
                    $i++;
                }
                ?>

                <tr class="keluar" style="background-color: purple;">
                    <td style="border-bottom:none; "><a style="color:#fff;" href="../login_uas/logout.php">Log out</a></td>
                </tr>

            </table>
        </div>
    </section>
</body>

</html>