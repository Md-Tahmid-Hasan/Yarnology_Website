<?php

session_start();

 ?>


 <html>
 <head>

   <title>Home Page</title>
   <link rel="stylesheet" type="text/css" href="style1.css">

           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 </head>
 <body>

   <header class="header">
  <nav class="navbar navbar-style">
    <div class="container">
      <div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#micon">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>

</button>

        <a href=""><img class="logo" src="flag.jpg"</a>

    </div>
    <div class="collapse navbar-collapse" id="micon">
    <ul class="nav navbar-nav navbar-right">
<li><a href=""> </a></li>
    <li><a href="purchase.php"><b>Purchase</b></a></li>
    <li><a href="sell.php"><b>sell</b></a></li>
    <li><a href="stock.php"><b>stock</b></a></li>
    <li><a href="expense.php"><b>expense</b></a></li>
    <li><a href="profit.php"><b>profit</b></a></li>
    <li><a href="invoice.php"><b>bill</b></a></li>
    </ul>
    </div>
    </div>
  </nav>
  <div class="container">
    <div class="row">

      <div class="col-sm-6 banner-info">

        <a href="logout.php"> <b>Log Out</b></a>
        <h1 class="sm-text"> Welcome To YARNOLOGY!!! </h1>
        <p class="big-text">YARNOLOGY is developed for yarn shops where a set of useful features will help the shops of getting information about their business and removes the complexity of work,unnecessary errors, and unproductive time.


        </div>
        <div class="col-sm-6 banner-image">
           <img src="yarn.jpg" height="500" width="400"class="img-responsive">
          </div>

      </div>
  </div>


   </header>

 </body>
 </html>
