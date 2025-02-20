<?php
require 'function.php';
$task = AmbilData("SELECT * FROM task_history");

if (isset($_GET['centang'])) {
    $id = $_GET['centang'];
    mysqli_query($conn, "DELETE FROM task_history WHERE id = '$id'");
    header("Location:history.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List | History</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>History</h1>
        <a href="index.php">Back</a>
        <table>
            <tr>
                <th><input type="checkbox" name="semua" id=""></th>
                <th>No</th>
                <th>Nama Tugas</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Tanggal</th>
                <th>Action</th>
                <th>Waktu</th>
            </tr>
            <?php if (empty($task)): ?>
                <tr>
                    <th colspan="10">No Data</th>
                </tr>
            <?php endif ?>
            <?php $no = 1; ?>
            <?php foreach ($task as $data): ?>
                <tr>
                    <td><input type="checkbox" name="satu" onclick="document.location.href = '?centang=<?= $data['id'] ?>'">
                    </td>
                    <td><?= $no++ ?></td>
                    <td><?= $data['task_name'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['priority'] ?></td>
                    <td><?= $data['due_date'] ?></td>
                    <td><?= $data['action'] ?></td>
                    <td><?= $data['time'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>

</html>