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
    <section class="container">
        <div class="tampil">
            <h3>Daftar nama Pegawai 2023</h3>
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
                <!-- memanggil data dengan looping menggunakan konsep while -->
                <!-- datanya akan mengulang sesuai data yang didapatkan -->
                <?php
                // agak sedikit diakalin untuk id nya 
                $i = 1;
                $querry = mysqli_query($koneksi, "SELECT * FROM pegawai");
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

                <div class="tombol">
                    <tr class="keluar" style="background-color: purple;">
                        <td style="border-bottom:none; "><a style="color:#fff;" href="../login_uas/logout.php">Log out</a></td>
                    </tr>
                    <tr>
                        <td style="border-bottom: none;"><button onclick="printData()">Print Data</button></td>
                    </tr>
                </div>

            </table>
        </div>
    </section>

    <script>
        function printData() {
            window.print();
        }
    </script>

</body>

</html>