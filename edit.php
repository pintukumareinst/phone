<?php

                session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Phone Book</title>
  </head>
  <body>

    <?php

$servername="localhost";
$username="root";
$pass="";
$db="testing";
$con=mysqli_connect($servername,$username,$pass,$db);
if(!$con)
{
  echo "Connection failed";
}
else
{
   $id=$_SESSION['id'];


    $sel="SELECT id, name, email, phoneno, dob FROM phone where id='$id'";

    $res=mysqli_query($con,$sel);
    $row=mysqli_fetch_array($res);

    $_SESSION['name']=$row['name'];
    $_SESSION['phoneno']=$row['phoneno'];
    $_SESSION['email']=$row['email'];
    $_SESSION['dob']=$row['dob'];

     mysqli_close($con);

   }

  ?>

      <?php

      $flag=2;

if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$servername="localhost";
$username="root";
$pass="";
$db="testing";
$con=mysqli_connect($servername,$username,$pass,$db);
if(!$con)
{
  echo "Connection failed";
  $flag=0;
}
else
{

  $id=$_SESSION['id'];
  $phoneno=$_POST['phoneno'];
  $email=$_POST['email'];

        $sqlemail = "SELECT * FROM phone WHERE phoneno='$phoneno' and id!='$id'";
 
    $resemail = mysqli_query($con, $sqlemail);

    if(mysqli_num_rows($resemail) > 0)
    {
        $flag=0;
    }

    else
    {

  

       $sqlp = "UPDATE phone SET phoneno='$phoneno' WHERE id='$id'";
       $sqle = "UPDATE phone SET email='$email' WHERE id='$id'";

       mysqli_query($con, $sqlp);
       mysqli_query($con, $sqle);

       $flag=1;

        

        mysqli_close($con);

         echo "<script>
alert('Contact updated successfully');
window.location.href='edit.php'; 
</script>";

}

}

  }
  ?>



<nav class="navbar navbar-light sticky-top" style="background-color: #e3f2fd;">
  <a class="navbar-brand" href="#">
    <img src="Images/logo2.png" width="30" height="30" alt="logo" loading="lazy">
  Phone Book</a>
    <form class="form-inline" action="search.php" method="post">
    <input class="form-control mr-sm-2" type="search" placeholder="Search Contact" aria-label="Search" name="contact">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>


<br>


<div class="container" style="borer: 1px solid black; height: 1000px;">


  <div class="col-md-10 offset-md-1 text-xs-center">
    <br>
             
  <div class="card text-center">
  <div class="card-header">
    Edit Contact
  </div>

  <div class="card-body" style="background-color: #e3f2fd;">
    <br>

     <?php
    if($flag==1)
echo '<div class="alert alert-success" role="alert">Contact Updated Successfully</div><br>';
if($flag==0)
echo '<div class="alert alert-danger" role="alert">Error in Updating Contact</div><br>';

?>



       <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">

      

    
    <h5 style="color: green; text-align: left;">Name - <?php
        echo $_SESSION['name']; ?><br><br>
        Date of Birth - <?php
        echo $_SESSION['dob']; ?></h5>
        <br>



  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" id="inputEmail3" placeholder="Phone Number" name="phoneno" required minlength="10" maxlength="15" value="<?php
        echo $row['phoneno']; ?>">
    </div>
  </div>

   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="<?php
        echo $row['email']; ?>">
    </div>
  </div>

  <br>

  
  <div class="form-group row">
    <div class="col-sm-12">
      <a href="index.php"><button type="button" class="btn btn-danger">

    Back</button></a>

      <button type="submit" class="btn btn-success">

    Update</button>

    </div>
  </div>


  

</form>

</div>
</div>
</div>


</div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>