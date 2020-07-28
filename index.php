
<?php
include  'db.php';

$page = (isset($_GET['page']) ? (int)$_GET['page']:1);

$perPage = (isset($_GET['per-page']) && (int)($_GET['per-page']) <=50 ? (int)$_GET['per-page'] : 5);

$start= ($page>1) ? ($page * $perPage)- $perPage:0;

$sql ="select * from tasks limit  ".$start.", ".$perPage."";

$total = $db->query("select * from tasks")->num_rows;

$pages= ceil($total / $perPage);

$rows= $db->query($sql);
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
        <center><h1> Crud App </h1></center>


        <div class="col-md-10 col-md-offset-1">

            <table class="table">

                <button type="button"  data-target="#myModal" data-toggle="modal"
                        class="btn btn-success">ADD</button>
                <button type="button" class="btn btn-default pull-right">Print</button>
                <hr><br>

                <!-- The Modal -->
                <div  id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Add Task</h4>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="add.php">
                                    <div class="form-group">
                                        <label> Task Name</label>
                                        <input type="text" required name="task" class="form-control">
                                    </div>
                                    <input type="submit" name="send" value="Add task" class="btn btn-success">
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>

                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php  while ($row= $rows->fetch_assoc()): ?>

                    <th><?php echo $row['id']?></th>
                    <td class="col-md-10"><?php echo $row['name']?></td>
                    <td><a href="update.php?id=<?php echo  $row['id']; ?>" class="btn btn-success">Edit</a></td>
                    <td><a href="delete.php?id=<?php echo  $row['id']; ?>" class="btn btn-danger">Delete</a></td>
                </tr>

                <?php  endwhile;?>
                </tbody>
            </table>
            <center>
                <ul class="pagination">
                    <?php  for($i=1; $i<=$pages; $i++): ?>
                    <li><a href="?page=<?php echo $i;?>"><?php echo $i; ?></a></li>

                    <?php  endfor; ?>
                </ul>

            </center>
                        </div>
    </div>
</div>

</body>

</html>
