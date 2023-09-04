<!DOCTYPE html>
<html>
<head>

  <title>Profit</title>
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

  background: orange;
  padding: 30px;
  text-transform: uppercase;
}
td:nth-child(7n+1){

  background: pink;
}
td:nth-child(7n+2){

  background: pink;
}
td:nth-child(7n+3){

  background: pink;
}
td:nth-child(7n+4){

  background: pink;
}
td:nth-child(7n+5){

  background: pink;
}
td:nth-child(7n+6){

  background: pink;
}
td:nth-child(7n+7){

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
  $query= "SELECT SUM(ts-te) 'total' FROM profit";
  $res=mysqli_query($con,$query);
  $data=mysqli_fetch_array($res);

  echo "NET PROFIT=".$data['total'];

   ?>

<?php
if(isset($_POST['insert'])){

$id=$_POST['id'];
$dt=$_POST['dt'];
$ts=$_POST['ts'];
$te=$_POST['te'];
$query = mysqli_query($con,"INSERT INTO profit (id,dt,ts,te)VALUES('$id','$dt','$ts','$te')");
}
 ?>

<table id="data" class="display">
  <thead>

<tr>
         <th>ID</th>
          <th>date</th>
           <th>total sell</th>
            <th>total expense</th>
             <th>Profit(day)</th>
             <th></th>
               <th>DELETE</th>
</tr>

  </thead>
<tbody>
  <?php
if(isset($_POST['delete'])){

  mysqli_query($con,"DELETE FROM profit WHERE id='$_POST[hidden]'");
}
$result=mysqli_query($con,"SELECT id,dt,ts,te,ts-te FROM profit");
while ($row=mysqli_fetch_array($result)) {


   ?>
   <tr>
      <form action="" method="POST">
        <td><center><?php echo $row['id'];?></center></td>
        <td><center><?php echo $row['dt'];?></center></td>
        <td><center><?php echo $row['ts'];?></center></td>
        <td><center><?php echo $row['te'];?></center></td>
        <td><center><?php echo $row['ts-te'];?></center></td>
        <td><input type=hidden name=hidden value=<?php echo $row['id'];?></td>
        <td><center><input type="submit" name="delete" value="delete"></center></td>
   </tr>
 </form>


<?php
}
 ?>

</tbody>
</table>




<form action="" method="POST">
  ID:              <input type="text" name='id'>
  DATE:     <input type="text" name='dt'>
  TOTAL SELL:   <input type="text" name='ts'>
  TOTAL EXPENSE:        <input type="text" name='te'>

                   <input type="submit" value="insert" name="insert">
 </form>



</body>
</html>
