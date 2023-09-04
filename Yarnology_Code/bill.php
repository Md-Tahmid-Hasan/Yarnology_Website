<?php
include ('database_connection.php');

$statement = $connect->prepare("SELECT * FROM tbl_order ORDER BY order_id DESC");
$statement->execute();
$all_result = $statement->fetchAll();
$total_rows = $statement->rowCount();

if(isset($_POST["create_bill"]))
{
  $order_total_before_tax = 0;
  $order_total_tax1 = 0;
  $order_total_tax2 = 0;
  $order_total_tax3 = 0;
  $order_total_tax = 0;
  $order_total_after_tax = 0;
  $statement = $connect->prepare("INSERT INTO tbl_order(order_no,order_date,order_receiver_name,order_receiver_address,order_total_before_tax,order_total_tax1,order_total_tax2,order_total_tax3,order_total_tax,order_total_after_tax,order_datetime)
  VALUES(:order_no,:order_date,:order_receiver_name,:order_receiver_address,:order_total_before_tax,:order_total_tax1,:order_total_tax2,:order_total_tax3,:order_total_tax,:order_total_after_tax,:order_datetime)");
  $statement->execute(

array(
        ':order_no'  => trim($_POST["order_no"]),
        ':order_date'  => trim($_POST["order_date"]),
        ':order_receiver_name'  => trim($_POST["order_receiver_name"]),
        ':order_receiver_address'  => trim($_POST["order_receiver_address"]),
        ':order_total_before_tax'  => $order_total_before_tax,
        ':order_total_tax1'  => $order_total_tax1,
        ':order_total_tax2'  => $order_total_tax2,
        ':order_total_tax3'  => $order_total_tax3,
        ':order_total_tax'  => $order_total_tax,
        ':order_total_after_tax'  => $order_total_after_tax,
        ':order_datetime'    =>  date("Y-m-d")

  )


  );

$statement = $connect->query("SELECT LAST_INSERT_ID()");
$order_id = $statement->fetchColumn();

for($count= 0;$count<$_POST["total_item"]; $count++)
{
  $order_total_before_tax = $order_total_before_tax + floatval(trim($_POST["order_item_actual_amount"][$count]));
  $order_total_tax1 = $order_total_tax1 + floatval(trim($_POST["order_item_tax1_amount"][$count]));
  $order_total_tax2 = $order_total_tax2 + floatval(trim($_POST["order_item_tax2_amount"][$count]));
  $order_total_tax3 = $order_total_tax3 + floatval(trim($_POST["order_item_tax3_amount"][$count]));
  $order_total_after_tax = $order_total_after_tax + floatval(trim($_POST["order_item_final_amount"][$count]));

  $statement = $connect->prepare("INSERT INTO tbl_order_item(order_id,item_name,order_item_quantity,order_item_price,order_item_actual_amount,order_item_tax1_rate,order_item_tax1_amount,order_item_tax2_rate,order_item_tax2_amount,order_item_tax3_rate,order_item_tax3_amount,order_item_final_amount)
  VALUES(:order_id,:item_name,:order_item_quantity,:order_item_price,:order_item_actual_amount,:order_item_tax1_rate,:order_item_tax1_amount,:order_item_tax2_rate,:order_item_tax2_amount,:order_item_tax3_rate,:order_item_tax3_amount,:order_item_final_amount)
  ");
$statement->execute(

array(

':order_id'  => $order_id,
':item_name'  => trim($_POST["item_name"][$count]),
':order_item_quantity'  => trim($_POST["order_item_quantity"][$count]),
':order_item_price'  => trim($_POST["order_item_price"][$count]),
':order_item_actual_amount'  => trim($_POST["order_item_actual_amount"][$count]),
':order_item_tax1_rate'  => trim($_POST["order_item_tax1_rate"][$count]),
':order_item_tax1_amount'  => trim($_POST["order_item_tax1_amount"][$count]),
':order_item_tax2_rate'  => trim($_POST["order_item_tax2_rate"][$count]),
':order_item_tax2_amount'  => trim($_POST["order_item_tax2_amount"][$count]),
':order_item_tax3_rate'  => trim($_POST["order_item_tax3_rate"][$count]),
':order_item_tax3_amount'  => trim($_POST["order_item_tax3_amount"][$count]),
':order_item_final_amount'  => trim($_POST["order_item_final_amount"][$count]),

)

);

}
$order_total_tax = $order_total_tax1 + $order_total_tax2 + $order_total_tax3;

$statement = $connect->prepare("
              UPDATE tbl_order
              SET order_total_before_tax = :order_total_before_tax,
                  order_total_tax1 = :order_total_tax1,
                  order_total_tax2 = :order_total_tax2,
                  order_total_tax3 = :order_total_tax3,
                  order_total_tax = :order_total_tax,
                  order_total_after_tax = order_total_after_tax WHERE order_id = :order_id");

      $statement->execute(
     array(

     ':order_total_before_tax'  => $order_total_before_tax,
     ':order_total_tax1'  => $order_total_tax1,
     ':order_total_tax2'  => $order_total_tax2,
     ':order_total_tax3'  => $order_total_tax3,
     ':order_total_tax'  => $order_total_tax,
     ':order_total_after_tax'  => $order_total_after_tax,
     ':order_id'  => $order_id,

     )

      );
      header("location:bill.php");

}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="robots" content="noindex,nofollow">
   <link rel="stylesheet" href="css/bootstrap.min.css">
      <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
          <script src="js/jquery.dataTables.min.js"></script>
          <script src="js/dataTables.bootstrap.min.js"></script>
          <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">

          <style>
        .navbar {
          margin-bottom: 4px;
          border-radius: 0;
        }
        footer {
        background-color: #f2f2f2;
        padding: 25px;
        }
        .carousel-inner img {
          width: 100%;
          margin: auto;
          min-height: 200px;
        }
        .navbar-brand {
          padding: 5px 40px;
        }
        .navbar-brand:hover {
          background-color: #ffffff;
        }
        @media (max-width: 600px)
        {
          .carousel-caption{
            display: none;
          }
        }
      </style>
      

 </head>
 <body>
<style>
.box
{

width: 100%;
max-width: 1390px;
border-radius: 5px;
border: 1px solid #ccc;
padding: 15px;
margin: 0 auto;
margin-top: 50px;
box-sizing: border-box;
  }
  </style>
<link rel="stylesheet" href="css/datepicker.css">
<script src="js/bootstrap-datepicker1.js"></script>
<script>
  $(document).ready(function(){
    $('#order_date').datepicker({
      format: "yyyy-mm-dd",autoclose: true
    });
  });
</script>

<div class="container-fluid">
  <?php
if(isset($_GET["add"]))
{
  ?>
<form method="post" id="bill_form">
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <td colspan="2" align="center"><h2 style="margin-top:10.5px">Create Bill</h2></td>
      </tr>
      <tr>
        <td colspan="2">
          <div class="row">
            <div class="col-md-8">
              To,<br/>
              <b>Receiver (Bill To)</b><br/>
              <input type="text" name="order_receiver_name" id="order_receiver_name" class="form-control input-sm" placeholder="Enter Receiver Name"/>
              <textarea name="order_receiver_address" id="order_receiver_address" class="form-control" placeholder="Enter Billing Address"></textarea>
            </div>
            <div class="col-md-4">
              Reverse Charge<br />
              <input type="text" name="order_no" id="order_no" class="form-control input-sm" placeholder="Enter Bill No"/>
              <input type="text" name="order_date" id="order_date" class="form-control input-sm" readonly placeholder="Select Bill Date"/>
          </div>
        </div>
        <table id="bill_item_table" class="table table-bordered">
          <tr>
         <th>Sr No.</th>
         <th>Item Name</th>
        <th>Quantity</th>
          <th>Price</th>
       <th>Actual Amt.</th>
       <th colspan="2">Tax1 (%)</th>
       <th colspan="2">Tax2 (%)</th>
       <th colspan="2">Tax3 (%)</th>
       <th colspan="2">Total</th>
       <th colspan="2"></th>
          </tr>
<tr>


<th></th>
<th></th>
<th></th>
<th></th>
<th></th>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
<th>Rate</th>
<th>Amt.</th>
</tr>
<tr>
  <td><span id="sr_no">1</span></td>
  <td><input type="text" name="item_name[]" id="item_name1" class="form-control input-sm" /></td>
    <td><input type="text" name="order_item_quantity[]" id="order_item_quantity1" data-srno="1" class="form-control input-sm order_item_quantity" /></td>
  <td><input type="text" name="order_item_price[]" id="order_item_price1" data-srno="1" class="form-control input-sm number_only order_item_price" /></td>
<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount1" data-srno="1" class="form-control input-sm order_item_actual_amount"readonly /></td>
<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate1" data-srno="1" class="form-control input-sm number_only order_item_tax1_rate" /></td>
<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount1" data-srno="1" readonly class="form-control input-sm order_item_tax1_amount" /></td>
<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate1" data-srno="1" class="form-control input-sm number_only order_item_tax2_rate" /></td>
<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount1" data-srno="1" readonly class="form-control input-sm order_item_tax2_amount" /></td>
<td><input type="text" name="order_item_tax3_rate[]" id="order_item_tax3_rate1" data-srno="1" class="form-control input-sm number_only order_item_tax3_rate" /></td>
<td><input type="text" name="order_item_tax3_amount[]" id="order_item_tax3_amount1" data-srno="1" readonly class="form-control input-sm order_item_tax3_amount" /></td>
<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount1" data-srno="1" readonly class="form-control input-sm order_item_final_amount" /></td>

</tr>
      </table>
<div align="center">
<button type="button" name="add_row" id="add_row" class="btn btn-success btn-xs">+</button>
</div>

        </td>
      </tr>
      <tr>
        <td align="right"><b>Total</td>
            <td align="right"><b><span id="final_total_amt"></span></b></td>
      </tr>
      <tr>
        <td colspan="2"></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="hidden" name="total_item" id="total_item" value="1" />
          <input type="submit" name="create_bill" id="create_bill" class="btn btn-info" value="Create" />
        </td>
      </tr>
    </table>
  </div>
</form>
<script>
$(document).read(function(){
  var final_total_amt = $('#final_total_amt').text();
  var count = 1;
  $(document).on('click','#add_row',function(){
    count = count + 1;
    $('#total_item').val(count);
    var html_code= '';
    html_code += '<tr id="row_id_'+count+'">';
    html_code += '<td><span id="sr_no">'+count+'</span></td>';
    html_code +='<td><input type="text" name="item_name[]" id="item_name'+count+'" class="form-control input-sm" /></td>';
    html_code +='<td><input type="text" name="order_item_quantity[]" id="order_item_quantity'+count+'"data-srno="'+count+'" class="form-control input-sm number_only order_item_quantity" /></td>';
    html_code +='<td><input type="text" name="order_item_price[]" id="order_item_price'+count+'"data-srno="'+count+'" class="form-control input-sm number_only order_item_price" /></td>';
    html_code +='<td><input type="text" name="order_item_actual_amount[]" id="order_item_actual_amount'+count+'"data-srno="'+count+'" class="form-control input-sm order_item_actual_amount" readonly /></td>';
    html_code +='<td><input type="text" name="order_item_tax1_rate[]" id="order_item_tax1_rate'+count+'"data-srno="'+count+'" class="form-control input-sm number_only order_item_tax1_rate" /></td>';
    html_code +='<td><input type="text" name="order_item_tax1_amount[]" id="order_item_tax1_amount'+count+'"data-srno="'+count+'" readonly class="form-control input-sm order_item_tax1_amount" /></td>';
    html_code +='<td><input type="text" name="order_item_tax2_rate[]" id="order_item_tax2_rate'+count+'"data-srno="'+count+'" class="form-control input-sm number_only order_item_tax2_rate" /></td>';
    html_code +='<td><input type="text" name="order_item_tax2_amount[]" id="order_item_tax2_amount'+count+'"data-srno="'+count+'" readonly class="form-control input-sm order_item_tax2_amount" /></td>';
    html_code +='<td><input type="text" name="order_item_tax3_rate[]" id="order_item_tax3_rate'+count+'"data-srno="'+count+'" class="form-control input-sm number_only order_item_tax3_rate" /></td>';
    html_code +='<td><input type="text" name="order_item_tax3_amount[]" id="order_item_tax3_amount'+count+'"data-srno="'+count+'" readonly class="form-control input-sm order_item_tax3_amount" /></td>';

    html_code +='<td><input type="text" name="order_item_final_amount[]" id="order_item_final_amount'+count+'"data-srno="'+count+'" readonly class="form-control input-sm order_item_final_amount" /></td>';
    html_code +='<td><button type="button" name="remove_row" id="'+count+'" class="btn btn-danger btn-xs remove_row">X</button></td></tr>';
    $('#bill_item_table').append(html_code);


  });

$(document).on('click','.remove_row',function(){
  var row_id = $(this).attr("id");
  var total_item_amount = $('order_item_final_amount'+row_id).val();
  var final_amount = $('#final_total_amt').text();
  var result_amount = parseFloat(final_amount) - parseFloat(total_item_amount);
  $('#final_total_amt').text(result_amount);
  $('#row_id'+row_id).remove();
  count = count - 1;
  $('#total_item').val(count);
});

function cal_final_total(count)
{
  var final_item_total = 0;
  for(j=1;j<=total;j++)
  {
    var quantity = 0;
    var price = 0;
    var actual_amount = 0;
    var tax1_rate = 0;
    var tax1_amount = 0;
    var tax2_rate = 0;
    var tax2_amount = 0;
    var tax3_rate = 0;
    var tax3_amount = 0;
    var item_total = 0;

   quantity = $('#order_item_quantity'+j).val();
   if(quantity >0)
   {
     price = $('#order_item_price'+j).val();
     if(price >0)
     {
       actual_amount = parseFloat(quantity) * parseFloat(price);
       $('#order_item_actual_amount'+j).val(actual_amount);
       tax1_rate = $('#order_item_tax1_rate'+j).val();
       if(tax1_rate >0)
       {
         tax1_amount = parseFloat(actual_amount) * parseFloat(tax1_rate)/100;
         $('#order_item_tax1_amount'+j).val(tax1_amount);
       }
       tax2_rate = $('#order_item_tax2_rate'+j).val();
       if(tax2_rate >0)
       {
         tax2_amount = parseFloat(actual_amount) * parseFloat(tax2_rate)/100;
         $('#order_item_tax2_amount'+j).val(tax2_amount);
       }
       tax3_rate = $('#order_item_tax3_rate'+j).val();
       if(tax3_rate >0)
       {
         tax3_amount = parseFloat(actual_amount) * parseFloat(tax3_rate)/100;
         $('#order_item_tax3_amount'+j).val(tax3_amount);
       }
       item_total = parseFloat(actual_amount) + parseFloat(tax1_amount) + parseFloat(tax2_amount) + parseFloat(tax3_amount);
       final_item_total = parseFloat(final_item_total) + parseFloat(item_total);
       $('#order_item_final_amount'+j).val(item_total);

     }
   }

  }
  $('#final_total_amt').text(final_item_total);
}
$(document).on('blur','.order_item_price',function(){
  cal_final_total(count);
});
$(document).on('blur','.order_item_tax1_rate',function(){
  cal_final_total(count);
});
$(document).on('blur','.order_item_tax2_rate',function(){
  cal_final_total(count);
});
$(document).on('blur','.order_item_tax3_rate',function(){
  cal_final_total(count);
});
$('#create_bill').click(function(){
  if($.trim($('#order_receiver_name').val()).length == 0)
  {
    alert("Please Enter Receiver Name");
    return false;
  }
  if($.trim($('#order_no').val()).length == 0)
  {
    alert("Please Enter Bill Number");
    return false;
  }
  if($.trim($('#order_date').val()).length == 0)
  {
    alert("Please Select Bill Date");
    return false;
  }
  for(var no=1; no<=count; no++)
  {
    if($.trim($('#item_name'+no).val()).length == 0)
    {
      alert("Please Enter Item Name");
      $('#item_name'+no).focus();
      return false;
    }

    if($.trim($('#order_item_quantity'+no).val()).length == 0)
    {
      alert("Please Enter Quantity");
        $('#order_item_quantity'+no).focus();
      return false;
    }
    if($.trim($('#order_item_price'+no).val()).length == 0)
    {
      alert("Please Enter Price");
        $('#order_item_price'+no).focus();
      return false;
    }

  }

$('#bill_form').submit();

});
});
</script>
  <?php
}
else
{
   ?>
  <h3 align="center">Bill</h3><br/>
  <div align="right">
    <a href="bill.php?add=1" class="btn btn-info btn-xs">Create</a>
  </div>
<br/>


<table id="data-table" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Bill No</th>
      <th>Bill Date</th>
      <th>Receiver Name</th>
      <th>Bill Total</th>
      <th>PDF</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>

<?php

if($total_rows > 0)
{
foreach ($all_result as $row) {
  echo '
<tr><td>'.$row["order_no"].'</td>
    <td>'.$row["order_date"].'</td>
     <td>'.$row["order_receiver_name"].'</td>
     <td>'.$row["order_total_after_tax"].'</td>
     <td><a href="print_bill.php?pdf=1&id='.$row["order_id"].'">PDF</a></td>
     <td><a href="bill.php?update=1&id='.$row["order_id"].'"><span class="glyphicon glyphicon-edit"></span></a></td>
     <td><a href="#" id="'.$row["order_id"].'"class="delete"><span class="glyphicon glyphicon-remove"></span></a></td>
  </tr>
  ';
}

}


 ?>


</table>
<?php
}
 ?>
</div>
<br>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>
 </body>
 </html>
 <script type="text/javascript">
 $(document).ready(function(){
   var table= $('#data-table').DataTable();
 });
 </script>
