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
}
else
{

  
  $text=$_POST['contact'];


    $sel="SELECT id, name, email, phoneno, dob FROM phone WHERE name LIKE '$text%' order by name";

     $resemail = mysqli_query($con, $sel);

    if(mysqli_num_rows($resemail) > 0)
    {
        $flag=1;
    }
    else
      $flag=0;

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

<form action="search.php" method="post">
  <div class="form-row">
          
          <div class="form-group col-sm-3 offset-sm-4">
            <input type="text" class="form-control" placeholder="Search Contact" id="contact" name="contact">
          </div>

    
          <div class="form-group col-sm-1">
                 <button type="submit" class="btn btn-primary btn-block">Search</button>
          </div>
          
  </div>

</form>

<div class="container">

  

  <br>

            <?php

if($flag==0)
echo '<div class="alert alert-danger" role="alert"><center>No contact with the name - '.$_POST['contact'].'</center></div><br>';
else
echo '<div class="alert alert-success" role="alert"><center>Results with the name - '.$_POST['contact'].'</center></div><br>';


?>

<div id="accordion">

   <?php
            while($row=mysqli_fetch_array($resemail))
            {  ?>

  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="<?php
        echo '#a'.$row['id']; ?>" aria-expanded="true" aria-controls="<?php
        echo 'a'.$row['id']; ?>">
         <?php
        echo $row['name']; ?>

        </button>
      </h2>
    </div>



    <div id="<?php
        echo 'a'.$row['id']; ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body" style="background-color: #e3f2fd;">


     
        <h5 style="color: green;">Name - <?php
        echo $row['name']; ?><br><br>
        Date of Birth - <?php
        echo $row['dob']; ?></h5>
        <br>

<div class="row">
        <div class="col-md-12 text-xs-center">
             
  <div class="card text-center">

  <br>
  <div class="card-body">

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Phone -</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="phoneno" value="<?php
        echo $row['phoneno']; ?>" readonly>
    </div>
  </div>

   <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Email -</label>
    <div class="col-sm-9">
      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email" value="<?php
        echo $row['email']; ?>" readonly>
    </div>
  </div>

   <div class="form-group row">
    <div class="col-sm-12">

      <?php

        echo '<form method="post">
             <button type="submit" class="btn btn-danger" name="button1" value="'.$row["id"].'">Remove</button>
             <button type="submit" class="btn btn-success" name="button2" value="'.$row["id"].'">&nbsp;&nbsp;Edit&nbsp;&nbsp;</button>
             </form>';

      ?>

    </div>
  </div>

  
</div>



    </div>
  </div>

</div>
</div>
</div>

</div>

   <?php 
           }
 ?>



  
  
</div>

</div>

    <?php 
    mysqli_close($con);
} 

}
?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>