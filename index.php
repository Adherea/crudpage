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
            <h3>Halo Admin! </h3>
            <p>Halaman ini menampilkan daftar data pegawai yang khusus dikelolah oleh Admin</p>
            <p>Admin dapat melihat, mengedit, menghapus, serta mencetak data.</p>
            <a href="create.php" class="tambah">Tambah data pegawai baru</a>
            <form method="GET" class="search">
                <input class="searchBar" type="text" name="search" placeholder="Cari pegawai..." style="width: 400px; padding:10px 20px; font-size:15px; margin-bottom:20px">
                <button type="submit" style="font-size:17px; padding:8px 20px;background-color:#283ad6; color:#fff; border:none">Cari</button>
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
                    <th>Aksi</th>
                </tr>


                <?php
                $i = 1;
                $keyword = $_GET['search'] ?? '';
                $query = "SELECT * FROM pegawai";
                if (!empty($keyword)) {
                    $query .= " WHERE nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR domisili LIKE '%$keyword%' OR jabatan LIKE '%$keyword%'";
                }
                $querry = mysqli_query($koneksi, $query);
                /*
                Menampilkan data dengan looping menggunakan metode while loop
                Datanya akan mengulang sesuai data yang didapatkan
                */
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
                        <td>
                            <a class="update" href="update.php?id=<?php echo $data['id'] ?>">Edit</a>
                            <a class="delete" onclick="return confirm('yakin hapus data ini dek??')" href="delete.php?id=<?php echo $data['id'] ?>">Hapus</a>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
                ?>

                <tr class="keluar">
                    <td><a id="quit" href="../login_uas/logout.php">Log out</a></td>
                </tr>
                <tr class="printData">
                    <td><button><a id="print" href="export.php">Print data</a></button></td>
                </tr>

            </table>
        </div>
    </section>

</body>

</html>