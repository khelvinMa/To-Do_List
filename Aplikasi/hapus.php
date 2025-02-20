<?php
require 'function.php';
$id = $_GET['id'];

$task = AmbilData("SELECT * FROM task WHERE id ='$id'")[0];
$task_id = $task['id'];
$task_name = $task['task_name'];
$status = $task['status'];
$priority = $task['priority'];
$due_date = $task['due_date'];

mysqli_query($conn, "INSERT INTO task_history(task_id,task_name,status,priority,due_date,action) VALUES('$task_id','$task_name','$status','$priority','$due_date','Deleted')");

if (HapusTugas($id) > 0) {
    echo "<script>
    alert('Data Berhasil Dihapus')
    document.location.href = 'index.php'
    </script>";
} else {
    echo "<script>
    alert('Data Gagal Dihapus')
    document.location.href = 'index.php'
    </script>";
}