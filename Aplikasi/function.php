<?php
$conn = mysqli_connect("localhost", "root", "", "to-do_list");

function AmbilData($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function TambahTugas($data)
{
    global $conn;
    $task_name = htmlspecialchars($data['task_name']);
    $status = htmlspecialchars($data['status']);
    $priority = htmlspecialchars($data['priority']);
    $due_date = htmlspecialchars($data['due_date']);

    if ($status == '-- Pilih Status --') {
        echo "<script>
        alert('Silakan Pilih Status Terlebih dahulu')
        </script>";
        return false;
    } elseif ($priority == '-- Pilih Prioritas --') {
        echo "<script>
        alert('Silakan Pilih Prioritas Terlebih Dahulu')
        </script>";
        return false;
    }

    $query = "INSERT INTO task(task_name,status,priority,due_date) VALUES('$task_name','$status','$priority','$due_date')";
    mysqli_query($conn, $query);

    mysqli_query($conn, "INSERT INTO task_history(task_name,status,priority,due_date,action) VALUES('$task_name','$status','$priority','$due_date','Add')");
    if ($status == 'Selesai') {
        mysqli_query($conn, "INSERT INTO task_history(task_name,status,priority,due_date,action) VALUES('$task_name','Selesai','$priority','$due_date','Completed')");
    }

    return mysqli_affected_rows($conn);
}

function EditTugas($data)
{
    global $conn;
    $id = $_GET['id'];
    $task_name = htmlspecialchars($data['task_name']);
    $status = htmlspecialchars($data['status']);
    $priority = htmlspecialchars($data['priority']);
    $due_date = htmlspecialchars($data['due_date']);

    $query = "UPDATE task SET
    task_name = '$task_name',
    status = '$status',
    priority = '$priority',
    due_date = '$due_date'
    WHERE id = '$id'";
    mysqli_query($conn, $query);

    mysqli_query($conn, "INSERT INTO task_history(task_id,task_name,status,priority,due_date,action) VALUES('$id','$task_name','$status','$priority','$due_date','Edit')");
    if ($status == 'Selesai') {
        mysqli_query($conn, "INSERT INTO task_history(task_id,task_name,status,priority,due_date,action) VALUES('$id','$task_name','Selesai','$priority','$due_date','Completed')");
    }
    return mysqli_affected_rows($conn);
}

function HapusTugas($id)
{
    global $conn;
    $query = "DELETE FROM task WHERE id ='$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function CariTugas($data)
{
    $query = "SELECT * FROM task WHERE
    task_name LIKE '%$data%'";
    return AmbilData($query);
}