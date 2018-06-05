<?php
include '../../connect.php';
$subcategoryid=mysql_real_escape_string($_GET['subcategoryid']);
$state=mysql_query("SELECT * FROM manage_product_master WHERE sub_category_id='$subcategoryid' AND status='1' AND deleted='0' ORDER BY product_name")or die(mysql_error());
if(mysql_num_rows($state)>=1)
{
	echo '<option value="">Select</option>';
	while($row=mysql_fetch_array($state))
	{
		echo '<option value="'.$row['id'].'">'.$row['product_name'].'</option>';
	}
}
?>