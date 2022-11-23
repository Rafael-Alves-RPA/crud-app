<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
     <title>2º CRUD</title>
</head>

<body>
     <div class='container my-5'>
          <h2>List of People</h2>
          <a class="btn btn-primary" href="create.php" role="button">New Client</a>
          <br>
          <table class="table">
               <thead>
                    <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Email</th>
                         <th>Phone</th>
                         <th>Address</th>
                         <th>Created At</th>
                         <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                    <?php
                    require_once "iconn.php";
                    require_once "conn.php";

                    //Create Connectionaa
                    //$conn = new conn("localhost", "crud2", "root", "");

                    $conn = new conn("us-cdbr-east-06.cleardb.net", "heroku_c6d76a1a0db8ac9", "bf87fbf69295b7", "64613672");

                    //read all row from database 
                    $sql = "SELECT * FROM crud2.persons";
                    $result = $conn->query($sql);


                    if ($result == TRUE) {
                         echo "Successful";
                    } else {
                         die("Invalid query: " . $conn->error);
                    }

                    //read data of each row
                    while ($row = $result->fetch_assoc()) {
                         echo "
                         <tr>
                              <td>$row[id]</td>
                              <td>$row[name]</td>
                              <td>$row[email]</td>
                              <td>$row[phone]</td>
                              <td>$row[address]</td>
                              <td>$row[created_at]</td>
                              <td>
                                   <a class='btn btn-primary btn-sm' href=' update.php?id=$row[id]'>Update</a>
                                   <a class='btn btn-danger btn-sm' href=' delete.php?id=$row[id]'>Delete</a>
                              </td>
                         </tr>
                         ";
                    }

                    ?>

               </tbody>
          </table>

     </div>
</body>

</html>