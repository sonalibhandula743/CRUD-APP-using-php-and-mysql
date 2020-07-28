
<?php
include  'db.php';
$id =(int)$_GET['id'];
$sql ="select * from tasks where id= '$id'";

$rows= $db->query($sql);

$row= $rows->fetch_assoc();

if(isset($_POST['send'])){
$task = htmlspecialchars($_POST['task']);
    $sql2 = "update tasks set name = '$task' where id= '$id'";

    $db->query($sql2);

    header('location: index.php');


}
?>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>crud-app</title>
</head>
<body>
<div class="container">

    <div class="row" style="margin-top: 70px">
        <center><h1> Update List </h1></center>


        <div class="col-md-10 col-md-offset-1">

                <div class="modal-body">
                   <form method="post" >
                        <div class="form-group">
                            <label> Task Name</label>
                            <input type="text" required name="task"  value="<?php echo $row['name']; ?>" class="form-control">
                        </div>
                        <input type="submit" name="send" value="Update Name" class="btn btn-success">
                        <a href="index.php" class="btn btn-warning">Back</a>
                   </form>

        </div>
    </div>
</div>

</body>

</html>

