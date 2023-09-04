<!DOCTYPE html>
<html>
<head>

  <title>Expense</title>
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

td:nth-child(7n+3){

  background: pink;
}
td:nth-child(7n+4){

  background: pink;
}
td:nth-child(7n+5){

  background: white;
}
td:nth-child(7n+6){

  background: pink;
}
td:nth-child(7n+2){

  background: pink;
}



</style>
<?php
   $con=mysqli_connect("localhost","Md Tahmid Hasan","tahmid1694","yarnology registration");

 ?>
 <!DOCTYPE html>
 <html>
 <head>
  <link rel="stylesheet" type="text/css" href="./css/datatables.css">
   <link rel="stylesheet" type="text/css" href="./css/ui.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/plug-ins/725b2a2115b/integration/jqueryui/dataTables.jqueryui.css">
    <link rel="stylesheet" type="text/css" href="./css/form.css">
    <script type="text/javascript" charset="utf-8" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/jqueryui/dataTables.jqueryui.js"></script>
  <script type="text/javascript" charset="utf-8" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
   <script type="text/javascript" language="javascript" src="//cdn.datatables.net/plug-ins/725b2a2115b/integration/jqueryui/dataTables.jqueryui.css"></script>
 <script type="text/javascript" src="./js/fancy.js"></script>
 <link rel="stylesheet" type="text/css" href="./css/fancy.css"/>
 <link rel="stylesheet" type="text/css" href="./css/gh-buttons.css"/>
 <link rel="stylesheet" type="text/css" href="./css/buttons.css"/>
 <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
 <script src="./js/buttons.js"></script>




 </head>

 </html>

 <script>

$(document).ready(function(){
$('#data').dataTable();

});

 </script>

</head>
<body>
  <?php
     $con=mysqli_connect("localhost","Md Tahmid Hasan","tahmid1694","yarnology registration");

  if(!$con){
    echo "Database Error";
  }
  $query= "SELECT SUM(am) 'total' FROM expense";
  $res=mysqli_query($con,$query);
  $data=mysqli_fetch_array($res);

  echo "TOTAL EXPENSE=".$data['total'];

   ?>

<?php
if(isset($_POST['insert'])){

$no=$_POST['no'];
$name=$_POST['name'];
$am=$_POST['am'];

$query = mysqli_query($con,"INSERT INTO expense (no,name,am)VALUES('$no','$name','$am')");
}
 ?>

<table id="data" class="display">
  <thead>

<tr>
         <th>NUMBER</th>
          <th>EXPENSE  NAME</th>
           <th>AMOUNT</th>
             <th></th>
               <th>DELETE</th>
</tr>

  </thead>
<tbody>
  <?php
if(isset($_POST['delete'])){

  mysqli_query($con,"DELETE FROM expense WHERE no='$_POST[hidden]'");
}
$result=mysqli_query($con,"SELECT * FROM expense");
while ($row=mysqli_fetch_array($result)) {


   ?>
   <tr>
      <form action="" method="POST">
        <td><center><?php echo $row['no'];?></center></td>
        <td><center><?php echo $row['name'];?></center></td>
        <td><center><?php echo $row['am'];?></center></td>
        <td><input type=hidden name=hidden value=<?php echo $row['no'];?></td>
        <td><center><input type="submit" name="delete" value="delete"></center></td>
   </tr>
 </form>
<?php
}
 ?>
</tbody>
</table>

<form action="" method="POST">
  NUMBER:              <input type="text" name='no'>
  EXPENSE  NAME:     <input type="text" name='name'>
  AMOUNT:   <input type="text" name='am'>

                   <input type="submit" value="insert" name="insert">
 </form>



</body>
</html>
