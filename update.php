<?php
//require_once "iconn.php";
require "conn.php";


//Create Connection
//$conn = new conn("localhost", "root", "", "crud2");

$dbh = new conn();

//start as empty fields
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

//checking if the data has being trasmited
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
     //detemine if the variable is different than null, and if it get the id of the person
     if (!isset($_GET["id"])) {
          header("location: index.php");
          exit;
     }
     //read the id of the person from the request
     $id = $_GET["id"];

     //read the row of the selected id from the database
     $stmt = $dbh->query("SELECT * FROM persons WHERE id=$id");
     $row = $stmt->execute()->fetch();
     //$row = $result->fetch_assoc();

     //if we don't have any data from the database
     if (!$row) {
          header("location: index.php");
          exit;
     }
     //can read the data from the database
     $name = $row["name"];
     $email = $row["email"];
     $phone = $row["phone"];
     $address = $row["address"];
} else {

     //read the data from the form
     $id = $_POST["id"];
     $name = $_POST["name"];
     $email = $_POST["email"];
     $phone = $_POST["phone"];
     $address = $_POST["address"];

     do {
          //none of the field can be empty
          if (empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
               $errorMessage = "All fields must be fill";
               break;
          }
          //update the itens on the database
          $stmt = $dbh->query("UPDATE persons SET name = '$name', email = '$email', phone = '$phone', address = '$address' WHERE id = $id");
          $result = $stmt->execute();

          if (!$result) {
               $errorMessage = "Invalid query: " . $conn->error;
               break;
          }
          //Success Message
          $successMessage = "Update Completely";
          //back to index page
          header("location: index.php");
          exit;
     } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
     <link rel="shortcut icon" type="image/x-ico" href="favicon_io/favicon-16x16.png">
     <title>2º CRUD Update</title>
</head>

<body>
     <div class="container my-5">
          <h2>Update Person</h2>
          <!--Error Message-->
          <?php
          if (!empty($errorMessage)) {
               echo "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                         <strong>$errorMessage</strong>
                         <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>    
                    ";
          }
          ?>
          <form method="POST">
               <input type="hidden" name="id" value="<?= $id ?>">
               <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-6">
                         <input type="text" class="form-control" name="name" value="<?php echo $name ?>">
                    </div>
               </div>
               <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-6">
                         <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                    </div>
               </div>
               <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Phone</label>
                    <div class="col-sm-6">
                         <input type="text" class="form-control" name="phone" value="<?php echo $phone ?>">
                    </div>
               </div>
               <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Address</label>
                    <div class="col-sm-6">
                         <input type="text" class="form-control" name="address" value="<?php echo $address ?>">
                    </div>
               </div>
               <!--Success Message-->
               <?php
               if (!empty($successMessage)) {
                    echo "
                         <div class='row mb-3'
                              <div class='offset-sm-3 col-sm-6'>
                                   <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                        <strong>$successMessage</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                   </div>
                              </div>
                         </div>    
                         ";
               }
               ?>
               <div class="row mb-3">
                    <div class="offset-sm-3 col-sm-3 d-grid">
                         <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                    <div class="col-sm-3 d-grid">
                         <a class="btn btn-outline-primary" href=" index.php" role="button">Cancel</a>
                    </div>
               </div>
          </form>
     </div>
</body>

</html>