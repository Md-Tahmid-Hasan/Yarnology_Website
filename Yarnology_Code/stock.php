<?php
 $con=mysqli_connect("localhost","Md Tahmid Hasan","tahmid1694","yarnology registration");
 $sql="SELECT E.prname,E.qn-K.qn FROM purchase E JOIN sell K USING(prname) GROUP BY E.prname";
 $result=mysqli_query($con,$sql);
 ?>
 <!DOCTYPE html>
 <html>
 <head>

   <title>Stock</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <style>
   body{

     background: gray;
   }
   table{

     width:800px;
     margin: auto;
     table-layout: fixed;
     text-align: center;
     margin-top: 50px;
     font-family: arial;
     color: black;
   }
   table,th,td{
     border: 1px dotted white;
     border-collapse: collapse;
     padding: 20px;
     font-size: 20px;
   }
   th{

     background: white;
     padding: 30px;
     text-transform: uppercase;
   }

   td:nth-child(7n+1){

     background: pink;
   }

   td:nth-child(7n+2){

     background: pink;
   }



   </style>
 </head>
 <body>

   <div class="container" style="width:500px;">
     <div class="table-responsive">
       <table class="table table-striped">
         <tr>

           <th>Product Name</th>
           <th>Quantity</th>
         </tr>
         <?php
if (mysqli_num_rows($result)>0) {
  while ($row=mysqli_fetch_array($result)) {

    ?>
<tr>

<td><?php echo $row["prname"];?></td>
<td><?php echo $row["E.qn-K.qn"];?></td>
</tr>

    <?php

  }
}
          ?>
       </table>
     </div>
   </div>
 </body>
 </html>
