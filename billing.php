<?php
session_start();
$usr=$_SESSION["id"];
$tme=$_SESSION["t"];
$tim=time();
if($tim>$tme)
{
  unset($usr);
  session_destroy();
  header("Refresh:0;url=index.php");
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="container" >
      <div class="row">
        <div class="col-sm-1 col-xs-12">

        </div>
    <div class="col-sm-1 col-xs-12">
    </div>
    </div>
    </div>
    <br>
    <nav class="navbar navbar-inverse container">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">Bill Generator</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
          <form class="" action="billing.php" method="post">
            <li class="active"><button type="submit" name="ss15"style="background:none;border:none;color:white;margin-top:13px;"><span class="glyphicon glyphicon-log-in"> Logout</button></li>
          </form>
        </ul>
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <table align="center" id="numrow" style="color:black;">
            <tr>
              <td>Total Number Of Items</td>
              <td>&nbsp;<input type="text" onkeyup="sendAlert()" id="num">&nbsp;<input type="button" value="Add" onclick="addcol()"></td>
            </tr>
          </table>
          <br>
          <table align="center" id="billtb" border="1"style="padding: 4px;width:95%;height: 100%;color:black;display:none;border:1px solid black;border-collapse: collapse;" >
            <tr>
              <td colspan="5" style="border:none;"><p style="font-size:30px;text-align:center;">Invoice</p></td>
            </tr>
            <tr>
              <td colspan="5" style="border:none;"><br><br><br><p style="float:left;"><big><big><b><input type="text" style="background:none;border:none;" placeholder="Shop Name">

              </b></big></big><br>
              <b>GSTIN</b>:<input type="text" style="background:none;border:none;" placeholder="GSTIN.NO"><br>
              <b>Address:</b><input type="text" style="background:none;border:none;" placeholder="Shop.No. and Landmark"><br><input type="text" style="background:none;border:none;" placeholder="Area"><br><input type="text" style="background:none;border:none;" placeholder="City-Pincode"><br><br><br></p>
              <p style="float:right;"><br>Customer:&nbsp;&nbsp;<input type="text" style="background:none;border:none;" placeholder="Enter Customer Name">
                <br>Date:&nbsp;&nbsp;<span id="datetime"></span><br>Time:&nbsp;&nbsp;<span id="datetimes"></span></p><br></td>
            </tr>
            <tr>
              <th style="text-align:center;border:1px solid black;">Sl.No.</th>
              <th style="width:400px;text-align:center;border:1px solid black;">Item</th>
              <th style="width:300px;text-align:center;border:1px solid black;">Quantity</th>
              <th style="width:150px;text-align:center;border:1px solid black;">Unit price</th>
              <th style="width:150px;text-align:center;border:1px solid black;height:30px;">Total Amount</th>
            </tr>
            <tr>
              <td colspan="4" style="width:150px;text-align:center;border:1px solid black;height:30px;"><p style="text-align:center;">Subtotal</p></td>
              <td style="width:150px;text-align:center;border:1px solid black;height:30px;" id="subtotal"></td>
            </tr>
            <tr>
              <td colspan="4" style="width:150px;text-align:center;border:1px solid black;height:30px;"><p style="text-align:center;">GST%</p></td>
              <td style="width:150px;text-align:center;border:1px solid black;height:30px;"><input type="text" id="gstp" style="background:none;border:none;text-align:center;" onkeyup="mul()" onblur="adp()"placeholder="GST%"></td>
            </tr>
            <tr>
              <td colspan="4" style="width:150px;text-align:center;border:1px solid black;height:30px;"><p style="text-align:center;">GST</p></td>
              <td style="width:150px;text-align:center;border:1px solid black;height:30px;" id="gst"></td>
            </tr>
            <tr>
              <td colspan="4" style="width:150px;text-align:center;border:1px solid black;height:30px;"><p style="text-align:center;">Total Amount</p></td>
              <td style="width:150px;text-align:center;border:1px solid black;height:30px;" id="total"></td>
            </tr>
            <tr>
              <td colspan="5" style="border:none;"><p style="float:left;">Cashier Signature<br><br>_________________________<br><br><br><b><u>Thank You For Doing Business With Us</u></b>
                <br><br>For Suggestion or Complaint Please dial : 9525349089 or visit store</p>
                <p style="float:right;">Customer Signature<br><br>_________________________<br><br><br><br></p></td>
            </tr>
          </table><br>
          <button type="button" name="button" id="pnt" onclick="prnt()" style="float:right;margin-right:60px;display:none">Print</button>
        </div>
      </div>
    </div>
    <br>
        <br><br>
            <br><br>
        <footer class="container" id="ft" style="height:30px;background-color:black;border-radius:4px;">

          <p style="color:white;text-align:center;">© 2019 <a href="tanweer.php" style="text-decoration:none;color:white;">Tanweer</a>. All Rights Reserved.</p>
    </footer><br>
    </body>
    <script type="text/javascript">
    function sendAlert(){
      var a=parseInt(document.getElementById("num").value);
      if(a<=0||a>10)
        alert("Note : You can only enter upto 10 items to generate the bill");
      }
    var dt = new Date();
document.getElementById("datetime").innerHTML = (("0"+dt.getDate()).slice(-2)) +"/"+ (("0"+(dt.getMonth()+1)).slice(-2)) +"/"+ (dt.getFullYear());
document.getElementById("datetimes").innerHTML = dt.toLocaleTimeString();
      function addcol() {
        var n=parseInt(document.getElementById("num").value);
        var table = document.getElementById("billtb");
        if(n>0&&n<=10)
        {
          var i=1;
          j=n;
          document.getElementById("billtb").style.display="block";
          document.getElementById("numrow").style.display="none";
          document.getElementById("pnt").style.display="block";
          for(i=1;i<=n;i++){
            var row = table.insertRow(3);
            var cell0 = row.insertCell(0);
            var cell1 = row.insertCell(1);
            var cell2 = row.insertCell(2);
            var cell3 = row.insertCell(3);
            var cell4 = row.insertCell(4);
            cell0.innerHTML = j;
            cell0.style.border="1px solid black";
            cell0.style.textAlign="center";
            cell1.innerHTML = "<input type='text' style='background:none;border:none;width:100%;border:1px solid black;height:30px;'>";
            cell2.innerHTML = "<input type='text' style='background:none;border:none;width:100%;border:1px solid black;height:30px;' id='p"+i+"'>";
            cell3.innerHTML = "<input type='text' style='background:none;border:none;width:100%;border:1px solid black;height:30px;' id='r"+i+"'onkeyup='mul()'>";
            cell4.innerHTML = "<input type='text' style='background:none;border:none;width:100%;border:1px solid black;height:30px;' id='c"+i+"'>";
            j--;
          }

        }
        else if (n>10) {
          alert('You cannot enter more the 10 Items');
        }
        else {
          alert('You must enter number of rows ');
          }
        }
      function mul() {
        var n=parseInt(document.getElementById("num").value);
        if(n==10)
        {
        var pics10=parseInt(document.getElementById("p1").value);
        var rate10=parseInt(document.getElementById("r1").value);
        var pics9=parseInt(document.getElementById("p2").value);
        var rate9=parseInt(document.getElementById("r2").value);
        var pics8=parseInt(document.getElementById("p3").value);
        var rate8=parseInt(document.getElementById("r3").value);
        var pics7=parseInt(document.getElementById("p4").value);
        var rate7=parseInt(document.getElementById("r4").value);
        var pics6=parseInt(document.getElementById("p5").value);
        var rate6=parseInt(document.getElementById("r5").value);
        var pics5=parseInt(document.getElementById("p6").value);
        var rate5=parseInt(document.getElementById("r6").value);
        var pics4=parseInt(document.getElementById("p7").value);
        var rate4=parseInt(document.getElementById("r7").value);
        var pics3=parseInt(document.getElementById("p8").value);
        var rate3=parseInt(document.getElementById("r8").value);
        var pics2=parseInt(document.getElementById("p9").value);
        var rate2=parseInt(document.getElementById("r9").value);
        var pics1=parseInt(document.getElementById("p10").value);
        var rate1=parseInt(document.getElementById("r10").value);
        var cost1=pics1*rate1;
        var cost2=pics2*rate2;
        var cost3=pics3*rate3;
        var cost4=pics4*rate4;
        var cost5=pics5*rate5;
        var cost6=pics6*rate6;
        var cost7=pics7*rate7;
        var cost8=pics8*rate8;
        var cost9=pics9*rate9;
        var cost10=pics10*rate10;
        var gstsp= parseInt(document.getElementById("gstp").value);
        var subt=cost10+cost9+cost8+cost7+cost6+cost5+cost4+cost3+cost2+cost1;
        var gsts=(subt*gstsp)/100;
        var tot=subt+gsts;
        document.getElementById("c10").value= cost1;
        document.getElementById("c9").value= cost2;
        document.getElementById("c8").value= cost3;
        document.getElementById("c7").value= cost4;
        document.getElementById("c6").value= cost5;
        document.getElementById("c5").value= cost6;
        document.getElementById("c4").value= cost7;
        document.getElementById("c3").value= cost8;
        document.getElementById("c2").value= cost9;
        document.getElementById("c1").value= cost10;
        document.getElementById("subtotal").innerHTML= subt;
        document.getElementById("gst").innerHTML= gsts;
        document.getElementById("total").innerHTML= tot;
       }
       else if (n==9) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var pics6=parseInt(document.getElementById("p5").value);
         var rate6=parseInt(document.getElementById("r5").value);
         var pics5=parseInt(document.getElementById("p6").value);
         var rate5=parseInt(document.getElementById("r6").value);
         var pics4=parseInt(document.getElementById("p7").value);
         var rate4=parseInt(document.getElementById("r7").value);
         var pics3=parseInt(document.getElementById("p8").value);
         var rate3=parseInt(document.getElementById("r8").value);
         var pics2=parseInt(document.getElementById("p9").value);
         var rate2=parseInt(document.getElementById("r9").value);
         var cost2=pics2*rate2;
         var cost3=pics3*rate3;
         var cost4=pics4*rate4;
         var cost5=pics5*rate5;
         var cost6=pics6*rate6;
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7+cost6+cost5+cost4+cost3+cost2;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c9").value= cost2;
         document.getElementById("c8").value= cost3;
         document.getElementById("c7").value= cost4;
         document.getElementById("c6").value= cost5;
         document.getElementById("c5").value= cost6;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==8) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var pics6=parseInt(document.getElementById("p5").value);
         var rate6=parseInt(document.getElementById("r5").value);
         var pics5=parseInt(document.getElementById("p6").value);
         var rate5=parseInt(document.getElementById("r6").value);
         var pics4=parseInt(document.getElementById("p7").value);
         var rate4=parseInt(document.getElementById("r7").value);
         var pics3=parseInt(document.getElementById("p8").value);
         var rate3=parseInt(document.getElementById("r8").value);
         var cost3=pics3*rate3;
         var cost4=pics4*rate4;
         var cost5=pics5*rate5;
         var cost6=pics6*rate6;
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7+cost6+cost5+cost4+cost3;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c8").value= cost3;
         document.getElementById("c7").value= cost4;
         document.getElementById("c6").value= cost5;
         document.getElementById("c5").value= cost6;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==7) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var pics6=parseInt(document.getElementById("p5").value);
         var rate6=parseInt(document.getElementById("r5").value);
         var pics5=parseInt(document.getElementById("p6").value);
         var rate5=parseInt(document.getElementById("r6").value);
         var pics4=parseInt(document.getElementById("p7").value);
         var rate4=parseInt(document.getElementById("r7").value);
         var cost4=pics4*rate4;
         var cost5=pics5*rate5;
         var cost6=pics6*rate6;
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7+cost6+cost5+cost4;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c7").value= cost4;
         document.getElementById("c6").value= cost5;
         document.getElementById("c5").value= cost6;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==6) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var pics6=parseInt(document.getElementById("p5").value);
         var rate6=parseInt(document.getElementById("r5").value);
         var pics5=parseInt(document.getElementById("p6").value);
         var rate5=parseInt(document.getElementById("r6").value);
         var cost5=pics5*rate5;
         var cost6=pics6*rate6;
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7+cost6+cost5;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c6").value= cost5;
         document.getElementById("c5").value= cost6;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==5) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var pics6=parseInt(document.getElementById("p5").value);
         var rate6=parseInt(document.getElementById("r5").value);
         var cost6=pics6*rate6;
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7+cost6;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c5").value= cost6;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==4) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var pics7=parseInt(document.getElementById("p4").value);
         var rate7=parseInt(document.getElementById("r4").value);
         var cost7=pics7*rate7;
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9+cost8+cost7;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c4").value= cost7;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==3) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var pics8=parseInt(document.getElementById("p3").value);
         var rate8=parseInt(document.getElementById("r3").value);
         var cost8=pics8*rate8;
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var subt=cost10+cost9+cost8;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c3").value= cost8;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==2) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var pics9=parseInt(document.getElementById("p2").value);
         var rate9=parseInt(document.getElementById("r2").value);
         var cost9=pics9*rate9;
         var cost10=pics10*rate10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var subt=cost10+cost9;
         var gsts=(subt*gstsp)/100;
         var tot=subt+gsts;
         document.getElementById("c2").value= cost9;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= subt;
         document.getElementById("gst").innerHTML= gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else if (n==1) {
         var pics10=parseInt(document.getElementById("p1").value);
         var rate10=parseInt(document.getElementById("r1").value);
         var cost10=pics10*rate10;
         document.getElementById("c1").value= cost10;
         document.getElementById("subtotal").innerHTML= cost10;
         var gstsp= parseInt(document.getElementById("gstp").value);
         var gsts=(subt*gstsp)/100;
         document.getElementById("gst").innerHTML= gsts;
         var tot=cost10+gsts;
         document.getElementById("total").innerHTML= tot;
       }
       else {
         alert('Zero Rows cannot be added');
       }
      }
      function prnt() {
        document.getElementById("pnt").style.display="none";
        document.getElementById("ft").style.display="none";
        window.print();
        document.getElementById("pnt").style.display="block";
        document.getElementById("ft").style.display="block";
            }
            function adp() {
              var num=document.getElementById("gstp").value;
              document.getElementById("gstp").value=num+"%";
              var gum=document.getElementById("gstp").value;
              num=num+"%";
              if(gum==num)
              {
                return false;
              }

            }
    </script>
    </html>
    <?php
      if(isset($_POST["ss15"]))
      {
        unset($usr);
        session_destroy();
        if(!$usr)
        {
          header("Refresh:0;url=index.php");
        }
        header("Refresh:0;url=index.php");
      }
     ?>
