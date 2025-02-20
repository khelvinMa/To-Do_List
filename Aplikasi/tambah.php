<?php
require 'function.php';
if (isset($_POST['addtask'])) {
    if (TambahTugas($_POST) > 0) {
        echo "<script>
    alert('Data Berhasil Ditambahkan')
    document.location.href = 'index.php'
    </script>";
    
    } else {
        echo "<script>
    alert('Data Gagal Ditambahkan')
    </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do_list | Tambah</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Tambah Tugas</h1>
        <a href="index.php">Back</a>
        <form action="" method="post">
            <div class="form-group">
                <label for="task_name">Nama Tugas</label>
                <input type="text" name="task_name" id="task_name" placeholder="Masukkan Nama Tugas..." autocomplete="off" required>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status">
                    <option value="-- Pilih Status --">-- Pilih Status --</option>
                    <option value="Belum Selesai">Belum Selesai</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="form-group">
                <label for="priority">Prioritas</label>
                <select name="priority" id="priority">
                    <option value="-- Pilih Prioritas --">-- Pilih Prioritas --</option>
                    <option value="Rendah">Rendah</option>
                    <option value="Sedang">Sedang</option>
                    <option value="Tinggi">Tinggi</option>
                </select>
            </div>
            <div class="form-group">
                <label for="due_date">Tanggal</label>
                <input type="date" name="due_date" id="due_date" value="<?= date('Y-m-d') ?>" required>
            </div>
            <button type="submit" name="addtask" class="add-button">tambah</button>
        </form>
    </div>
</body>

</html>