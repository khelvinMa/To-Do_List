<?php
require 'function.php';

$id = $_GET['id'];
$task = AmbilData("SELECT * FROM task WHERE id ='$id'");

if (isset($_POST['edittask'])) {
    if (EditTugas($_POST) > 0) {
        echo "<script>
    alert('Data Berhasil Diedit')
    document.location.href = 'index.php'
    </script>";
    } else {
        echo "<script>
    alert('Data Gagal Diedit')
    </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do_list | Edit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Edit Tugas</h1>
        <a href="index.php">Back</a>
        <?php foreach ($task as $data): ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="task_name">Nama Tugas</label>
                    <input type="text" name="task_name" id="task_name" autocomplete="off" value="<?= $data['task_name'] ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="-- Pilih Status --">-- Pilih Status --</option>
                        <option value="Belum Selesai" <?php if ($data['status'] == 'Belum Selesai')
                            echo 'selected' ?>>Belum
                                Selesai</option>
                            <option value="Selesai" <?php if ($data['status'] == 'Selesai')
                            echo 'selected' ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="priority">Prioritas</label>
                        <select name="priority" id="priority">
                            <option value="-- Pilih Prioritas --">-- Pilih Prioritas --</option>
                            <option value="Rendah" <?php if ($data['priority'] == 'Rendah')
                            echo 'selected' ?>>Rendah</option>
                            <option value="Sedang" <?php if ($data['priority'] == 'Sedang')
                            echo 'selected' ?>>Sedang</option>
                            <option value="Tinggi" <?php if ($data['priority'] == 'Tinggi')
                            echo 'selected' ?>>Tinggi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="due_date">Tanggal</label>
                        <input type="date" name="due_date" id="due_date" value="<?= $data['due_date'] ?>" required>
                </div>
                <button type="submit" name="edittask" class="edit-button"
                    onclick="return confirm('Apakah Anda Yakin Ingin Mengedit Tugas Ini?')">Edit</button>
            </form>
        <?php endforeach ?>
    </div>
</body>

</html>