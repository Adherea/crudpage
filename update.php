<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data pegawai</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include 'connect.php';

    // Tampilkan data yang ada untuk kita edit
    $id = $_GET['id'];
    if (isset($_POST['nama'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $domisili = $_POST['domisili'];
        $jabatan = $_POST['jabatan'];
        $gaji = $_POST['gaji'];

        // Validasi data untuk button simpan
        if ($nama == "" || $alamat == "" || $domisili == "" || $jabatan == "" || $gaji == "") {
            echo "<script>alert('Data harus terisi semua!')</script>";
        } else {
            // Update data ke database
            $query = mysqli_query($koneksi, "UPDATE pegawai SET nama='$nama', alamat='$alamat', domisili='$domisili', jabatan='$jabatan', gaji='$gaji' WHERE id=$id");

            if ($query) {
                echo '<script>alert("Edit data berhasil! :)")</script>';
            } else {
                echo '<script>alert("Gagal Edit data.")</script>';
            }
        }

        // Periksa apakah ada file foto yang diunggah
        if (isset($_FILES['foto']) && $_FILES['foto']['size'] > 0) {
            $direktori = "img/";
            $file_name = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $new_file_name = uniqid() . '.' . $extension;
            move_uploaded_file($file_tmp, $direktori . $new_file_name);

            // Perbarui kolom foto di database
            $query_update_foto = mysqli_query($koneksi, "UPDATE pegawai SET foto='$direktori$new_file_name' WHERE id=$id");
            if (!$query_update_foto) {
                echo '<script>alert("Gagal memperbarui foto.")</script>';
            }
        }
    }

    $query = mysqli_query($koneksi, "SELECT * FROM pegawai WHERE id=$id");
    $data = mysqli_fetch_array($query);
    ?>

    <section class="edit">
        <div class="updateData">
            <h2>Edit data</h2>
            <form method="post" enctype="multipart/form-data" class="form">
                <!-- Kita menampilkan data yang sudah didapat kedalam field dengan memasukkan value ke masing masing input -->
                <table>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama" value="<?php echo $data['nama'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea name="alamat"><?php echo $data['alamat'] ?></textarea></td>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <td>
                            <!-- option yang terpilih yaitu domisili yang udah terinputkan dengan menggunakan pengkondisian 
                            -->
                            <select name="domisili" id="">
                                <option <?php if ($data['domisili'] == 'Jakarta') echo 'selected'; ?>>Jakarta</option>
                                <option <?php if ($data['domisili'] == 'Mataram') echo 'selected'; ?>>Mataram</option>
                                <option <?php if ($data['domisili'] == 'Bandung') echo 'selected'; ?>>Bandung</option>
                                <option <?php if ($data['domisili'] == 'Surabaya') echo 'selected'; ?>>Surabaya</option>
                                <option <?php if ($data['domisili'] == 'Medan') echo 'selected'; ?>>Medan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td><input type="text" name="jabatan" value="<?php echo $data['jabatan'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Gaji</td>
                        <td><input type="text" name="gaji" value="<?php echo $data['gaji'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Foto Profile</td>
                        <td><input type="file" name="foto"></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <div class="aksi">
                                <button class="simpan" type="submit">Simpan</button>
                                <button class="reset" type="reset">Reset</button>
                            </div>
                            <a id="home" href="index.php">Home</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>
</body>

</html>