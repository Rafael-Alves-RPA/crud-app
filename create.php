<?php
//require_once "iconn.php";
require "conn.php";

//Create Connection

$dbh = new conn();

//start as empty fields
$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $name = $_POST["name"];
     $email = $_POST["email"];
     $phone = $_POST["phone"];
     $address = $_POST["address"];

     do {
          //None field can be empty 
          if (empty($name) || empty($email) || empty($phone) || empty($address)) {
               $errorMessage = "All fields must be fill";
               break;
          }
          $stmt = $dbh->query("INSERT INTO persons (name, email, phone, address) VALUES ('$name', '$email', '$phone', '$address')");
          $result = $stmt->execute();
          if (!$result) {
               $errorMessage = "Invalid query: " . $conn->error;
               break;
          } //Error Message

          //initializing the empty fields again
          $name = "";
          $email = "";
          $phone = "";
          $address = "";

          //Success Message
          $successMessage = "Successfuly addded person";

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
     <title>2º CRUD - Add New Person</title>
</head>

<body>
     <div class="container my-5">
          <h2>New Person</h2>
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