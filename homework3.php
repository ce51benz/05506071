<?
$cx = mysql_connect("127.0.0.1","root","1234");
mysql_selectdb("webprog");
$query1 = "SELECT customer.CustNo,customer.CustName,customer.Sex,customer.Address,customer.Tel, stock.ProductCode,stock.ProductName,stock.PricePerUnit,supply.QTY,supply.QTY*stock.PricePerUnit FROM supply INNER JOIN customer ON customer.CustNo=supply.CustNo INNER JOIN stock ON stock.ProductCode=supply.ProductCode ORDER BY customer.custno;";
$result = mysql_query($query1);
$cur = "0";
echo "<style>
table{
border:3px solid blue;
border-collapse:collapse;
}

td,th{
padding:5px;
border:3px solid blue;
}
</style>";
echo "<font face=\"Courier New\"><center><h1>Receipt</h1></center></font>";

while($row = mysql_fetch_array($result)){
if($cur!=$row[0]){
if($cur!="0"){
$query2 = "SELECT SUM(supply.QTY*stock.PricePerUnit) FROM supply INNER JOIN customer ON customer.CustNo=supply.CustNo INNER JOIN stock ON stock.ProductCode=supply.ProductCode WHERE customer.CustNo='".$cur."' ORDER BY customer.custno;";
$total = mysql_query($query2);
$total = mysql_fetch_array($total);
echo "<tr><th>Total<td colspan=4 align=right bgcolor=yellow>$total[0]</tr>";
echo "</table><hr size=2 noshade>";
}
echo "<b>Cust No.:</b>$row[0] ";
echo "<b>Name:</b>$row[1] ";
echo " <b>Address:</b>$row[3] ";
echo " <b>Sex:</b>";
if($row[2] == "M")echo "Male";
else echo "Female";
echo "<br>";
echo "<b>Tel:</b>$row[4]<br>";
$cur = $row[0];
echo "<b>List of ordered</b><br>";
echo"<table>
<tr><th>Product Code<th>Product Name<th>Price/Unit<th>Qty.<th>Price</tr>";
echo "<tr><td>$row[5]<td>$row[6]<td>$row[7]<td>$row[8]<td align=right>$row[9]</tr>"; 
}
else{
echo "<tr><td>$row[5]<td>$row[6]<td>$row[7]<td>$row[8]<td align=right>$row[9]</tr>";
}


}
$query2 = "SELECT SUM(supply.QTY*stock.PricePerUnit) FROM supply INNER JOIN customer ON customer.CustNo=supply.CustNo INNER JOIN stock ON stock.ProductCode=supply.ProductCode WHERE customer.CustNo='".$cur."' ORDER BY customer.custno;";
$total = mysql_query($query2);
$total = mysql_fetch_array($total);
echo "<tr><th>Total<td colspan=4 align=right bgcolor=yellow>$total[0]</tr>";
mysql_close($cx);
?>