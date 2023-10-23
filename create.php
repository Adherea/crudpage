<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah data pegawai</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include 'connect.php';

    // Mengecek data yang di-submit
    if (isset($_POST['nama'])) {
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $domisili = $_POST['domisili'];
        $jabatan = $_POST['jabatan'];
        $gaji = $_POST['gaji'];

        // Dan melakukan proses Validasi data
        if ($nama == "" || $alamat == "" || $domisili == "" || $jabatan == "" || $gaji == "") {
            echo "<script>alert('Data harus terisi semua!')</script>";
        } else {

            //Upload gambar ke folder "img/" dengan menggunakan nama serta temporary path file.
            $direktori = "img/";
            $file_name = $_FILES['foto']['name'];
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp, $direktori . $file_name);

            // Insert data ke database
            $query = mysqli_query($koneksi, "INSERT INTO pegawai (nama, alamat, domisili, jabatan, gaji, foto) VALUES ('$nama', '$alamat', '$domisili', '$jabatan', '$gaji', '$direktori$file_name')");

            if ($query) {
                echo '<script>alert("Berhasil menginputkan data!")</script>';
            } else {
                echo '<script>alert("Gagal menginputkan data.")</script>';
            }
        }
    }
    ?>

    <section class="create">
        <div class="createPage">
            <form method="post" class="form" enctype="multipart/form-data">
                <h2>Tambah data</h2>
                <p>Selamat datang di halaman data! Disini kamu bisa menambahkan data sesuai dengan kebutuhan kamu. So, tunggu apalagi? Ayo langsung cobain!</p>
                <table>
                    <tr>
                        <td>Nama</td>
                        <td><input type="text" name="nama"></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td><textarea class="textArea" name="alamat" id="" cols="30" rows="10"></textarea></td>
                    </tr>
                    <tr>
                        <td>Domisili</td>
                        <td>
                            <select name="domisili" id="">
                                <option>Jakarta</option>
                                <option>Mataram</option>
                                <option selected="selected">Bandung</option>
                                <option>Surabaya</option>
                                <option>Medan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td><input type="text" name="jabatan"></td>
                    </tr>
                    <tr>
                        <td>Gaji</td>
                        <td><input type="text" name="gaji"></td>
                    </tr>
                    <tr>
                        <td>Foto Profil</td>
                        <td><input type="file" name="foto"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <div class="aksi">
                                <button class="simpan" type="submit">Simpan</button>
                                <button class="reset" type="reset">Reset</button>
                            </div>
                            <a id="home" href="../crud_web/read.php">Lihat data</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </section>

</body>

</html>