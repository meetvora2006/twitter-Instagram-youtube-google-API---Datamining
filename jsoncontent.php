<?php

mysql_connect("mysql507.ixwebhosting.com", "C266399_meet", "nita203A");
mysql_select_db("C266399_testdatatable");
	
$qry=mysql_query("SELECT subcatname FROM  tbl_subcategory WHERE subcatname LIKE '%".$_GET['q']."%' ");
$qry1=mysql_query("SELECT sub_text FROM  tbl_post WHERE sub_text LIKE '%".$_GET['q']."%' ");
$array_temp['words']=array();
while($row=mysql_fetch_array($qry)){
		
		$array_temp1["name"]=$row["subcatname"];
		$array_temp1["link"]=$row["subcatname"];
		$array_final1[]=$array_temp1;
		$array_final2['category']=$array_final1;	
		
		}

while($row1=mysql_fetch_array($qry1)){
		
		$array_temp2["name"]=$row1["sub_text"];
		$array_temp2["link"]=$row1["sub_text"];
		$array_final3[]=$array_temp2;
		$array_final2['post']=$array_final3;	
		
		}
	
$array_temp['suggests']=$array_final2;
echo json_encode($array_temp);
?>

