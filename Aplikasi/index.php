<?php
require 'function.php';

$task = AmbilData("SELECT * FROM task");

if (isset($_POST['cari'])) {
    $task = CariTugas($_POST['katakunci']);
}

if (isset($_GET['Selesai'])) {
    $id = $_GET['Selesai'];
    mysqli_query($conn, "UPDATE task SET status = 'Belum Selesai' WHERE id ='$id'");
    header("Location:index.php");
} elseif (isset($_GET['Belum'])) {
    $id = $_GET['Belum'];
    mysqli_query($conn, "UPDATE task SET status = 'selesai' WHERE id ='$id'");
    header("Location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>To-Do List</h1>
        <button type="submit" class="add-button" onclick="document.location.href = 'tambah.php'">Tambah Tugas</button>
        <form action="" method="post" class="search-form">
            <input type="text" name="katakunci" class="search-input" placeholder="Masukkan Katakunci..."
                autocomplete="off">
            <button type="submit" name="cari" class=search-button>cari</button>
        </form>
        <button type="submit" class="history-button" onclick="document.location.href ='history.php'">History</button>
        <table>
            <th colspan="10">
                <h1>Daftar Tugas</h1>
            </th>
            <tr>
                <th>Nama Tugas</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
            <?php if (empty($task)): ?>
                <tr>
                    <th colspan="10">No Data</th>
                </tr>
            <?php endif ?>
            <?php foreach ($task as $data): ?>
                <?php if ($data['status'] == 'Selesai') { ?>
                    <tr class="Selesai">
                        <td><?= $data['task_name'] ?></td>
                        <td><a href="?Selesai=<?= $data['id'] ?>" class="Selesai"><?= $data['status'] ?></a></td>
                        <td><?= $data['priority'] ?></td>
                        <td><?= $data['due_date'] ?></td>
                        <td><button type="submit" class="delete-button"
                                onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tugas Ini?') , document.location.href = 'hapus.php?id=<?= $data['id'] ?>'">Hapus</button>
                        </td>
                    </tr>
                <?php } elseif ($data['status'] == 'Belum Selesai') { ?>
                    <tr>
                        <td><?= $data['task_name'] ?></td>
                        <td><a href="?Belum=<?= $data['id'] ?>" class="Belum-Selesai"><?= $data['status'] ?></a></td>
                        <td><?= $data['priority'] ?></td>
                        <td><?= $data['due_date'] ?></td>
                        <td><button type="submit" class="edit-button"
                                onclick="document.location.href ='edit.php?id=<?= $data['id'] ?>'">Edit</button>
                            <button type="submit" class="delete-button"
                                onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Tugas Ini?') , document.location.href = 'hapus.php?id=<?= $data['id'] ?>'">Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>