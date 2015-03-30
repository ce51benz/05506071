<?
$cx = mysql_connect("127.0.0.1","root","1234");
mysql_selectdb("webprog");
$query1 = "SELECT customer.CustNo,customer.CustName,customer.Sex,customer.Address,customer.Tel, stock.ProductCode,stock.ProductName,stock.PricePerUnit,supply.QTY,supply.QTY*stock.PricePerUnit FROM supply INNER JOIN customer ON customer.CustNo=supply.CustNo INNER JOIN stock ON stock.ProductCode=supply.ProductCode ORDER BY customer.custno;";
$result = mysql_query($query1);

$row = mysql_fetch_array($result);

echo $row[0]," ";
echo $row[1]," ";
echo $row[2]," ";
echo $row[3]," ";
echo $row[4]," ";
echo $row[5]," ";
echo $row[6]," ";
echo $row[7]," ";
echo $row[8]," ";
echo $row[9]," ";

mysql_close($cx);
?>