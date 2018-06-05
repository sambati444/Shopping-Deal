<ul>
	<?php 
	if($_SESSION['permission_administrator']==1)
	{
		echo '<li><a href="#" data-target=".admin-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Administrator<i class="fa fa-collapse"></i></a></li>
		<li><ul class="admin-menu nav nav-list collapse">
				<li><a href="a_user_add.php"><span class="fa fa-caret-right"></span>Add New Operator</a></li>
				<li><a href="a_user_view.php"><span class="fa fa-caret-right"></span>View Operators</a></li>
				<li><a href="a_tax_type.php"><span class="fa fa-caret-right"></span>Manage Tax Type</a></li>
				<li><a href="a_weight_type.php"><span class="fa fa-caret-right"></span>Manage Weight Type</a></li>
				<li><a href="a_length_type.php"><span class="fa fa-caret-right"></span>Manage Length Type</a></li>
				<li><a href="a_store.php"><span class="fa fa-caret-right"></span>Manage Stores</a></li>
		</ul></li>';
		echo '<!--*************************** END OF ADMIN MANAGEMENT **************************-->';
	}
	else
	{
		echo '<li><a href="#" data-target=".admin-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Administrator<i class="fa fa-collapse"></i></a></li>
		<li><ul class="admin-menu nav nav-list collapse">
		</ul></li>';
		echo '<!--*************************** END OF ADMIN MANAGEMENT **************************-->';
	}
	if($_SESSION['permission_management']==1)
	{
		echo '<li><a href="#" data-target=".customer-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Customers<i class="fa fa-collapse"></i></a></li>
		<li><ul class="customer-menu nav nav-list collapse">
				<li><a href="customer_new.php"><span class="fa fa-caret-right"></span>Add New Customer</a></li>
				<li><a href="customerinfo.php"><span class="fa fa-caret-right"></span>View Customers</a></li>
		</ul></li>';
		echo '<!--*************************** END OF CUSTOMER MANAGEMENT **************************-->';
		echo '<li><a href="#" data-target=".products-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Products<i class="fa fa-collapse"></i></a></li>
		<li><ul class="products-menu nav nav-list collapse">
				<li><a href="product_manufacturer.php"><span class="fa fa-caret-right"></span>Manufacturer</a></li>
				<li><a href="product_marketer.php"><span class="fa fa-caret-right"></span>Marketing By</a></li>
				<li><a href="product_webmenu.php"><span class="fa fa-caret-right"></span>Web Menus</a></li>
				<li><a href="product_category.php"><span class="fa fa-caret-right"></span>Categories</a></li>
				<li><a href="product_subcategory.php"><span class="fa fa-caret-right"></span>Sub-Categories</a></li>
				<li><a href="product_add.php"><span class="fa fa-caret-right"></span>Add New Product</a></li>
				<li><a href="product_view.php"><span class="fa fa-caret-right"></span>View Products</a></li>
				<li><a href="product_specialview.php"><span class="fa fa-caret-right"></span>View Special Products</a></li>
		</ul></li>';
		echo '<!--*************************** END OF PRODUCTS MANAGEMENT '.$_SESSION['permission_management'].'**************************-->';
	}
	else
	{
		echo '<li><a href="#" data-target=".customer-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Customers<i class="fa fa-collapse"></i></a></li>
		<li><ul class="customer-menu nav nav-list collapse">
		</ul></li>';
		echo '<!--*************************** END OF CUSTOMER MANAGEMENT **************************-->';
		echo '<li><a href="#" data-target=".products-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Products<i class="fa fa-collapse"></i></a></li>
		<li><ul class="products-menu nav nav-list collapse">
		</ul></li>';
		echo '<!--*************************** END OF PRODUCTS MANAGEMENT '.$_SESSION['permission_management'].'**************************-->';
	}
    if($_SESSION['permission_sales']==1)
	{
		echo '<li><a href="#" data-target=".sales-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Sale<i class="fa fa-collapse"></i></a></li>
		<li><ul class="sales-menu nav nav-list collapse">
				<li><a href="sales.php?orderno=&status=&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Total Orders</a></li>
				<li><a href="sales.php?orderno=&status=NEW&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>New Orders</a></li>
				<li><a href="sales.php?orderno=&status=PENDING&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Pending Orders</a></li>
				<li><a href="sales.php?orderno=&status=DISPATCH&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Dispatched Orders</a></li>
				<li><a href="sales.php?orderno=&status=CANCEL&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Cancelled Orders</a></li>
				<li><a href="sale_billed.php"><span class="fa fa-caret-right"></span>Sale Register</a></li>
		</ul></li>';
		echo '<!--*************************** END OF SALES MANAGEMENT '.$_SESSION['permission_sales'].'**************************-->';
	}
	else
	{
		echo '<li><a href="#" data-target=".sales-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Sale<i class="fa fa-collapse"></i></a></li>
		<li><ul class="sales-menu nav nav-list collapse">
		</ul></li>';
		echo '<!--*************************** END OF SALES MANAGEMENT '.$_SESSION['permission_sales'].'**************************-->';
	}
	if($_SESSION['permission_purchase']==1)
	{
		echo '<li><a href="#" data-target=".purchase-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Purchase<i class="fa fa-collapse"></i></a></li>
		<li><ul class="purchase-menu nav nav-list collapse">
				<li><a href="purchase_new.php"><span class="fa fa-caret-right"></span>New Purchase</a></li>
				<li><a href="purchasereturn_new.php"><span class="fa fa-caret-right"></span>New Purchase Return</a></li>
				<li><a href="purchase_register.php"><span class="fa fa-caret-right"></span>Purchase Register</a></li>
		</ul></li>
		<!--*************************** END OF PURCHASE MANAGEMENT '.$_SESSION['permission_purchase'].'**************************-->';
	}
	else
	{
		echo '<li><a href="#" data-target=".purchase-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Purchase<i class="fa fa-collapse"></i></a></li>
		<li><ul class="purchase-menu nav nav-list collapse">
		</ul></li>
		<!--*************************** END OF PURCHASE MANAGEMENT '.$_SESSION['permission_purchase'].'**************************-->';
	}
	if($_SESSION['permission_stock']==1)
	{
		echo '<li><a href="#" data-target=".stock-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Stock<i class="fa fa-collapse"></i></a></li>
		<li><ul class="stock-menu nav nav-list collapse">
				<li><a href="stock_register.php"><span class="fa fa-caret-right"></span>Stock Register</a></li>
		</ul></li>
		<!--*************************** END OF STOCK MANAGEMENT '.$_SESSION['permission_stock'].'**************************-->';
	}
	else
	{
		echo '<li><a href="#" data-target=".stock-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Purchase<i class="fa fa-collapse"></i></a></li>
		<li><ul class="stock-menu nav nav-list collapse">
		</ul></li>
		<!--*************************** END OF STOCK MANAGEMENT '.$_SESSION['permission_stock'].'**************************-->';
	}
	?>
        <li><a href="user.php" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>User Account Setting</a></li>
	<!--*************************** END OF USER ACCOUNT SETTING **************************-->
	<?php
	if($_SESSION['usertype']=='ADMIN')
	{
		echo '<li><a href="company.php" data-target=".company-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>Company Setting</a></li>
		<!--*************************** END OF COMPANY SETTING **************************-->';
		echo '<li><a href="indexbanner.php" data-target=".indexbanner-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>Index Page Banner</a></li>
		<!--*************************** END OF INDEX BANNER **************************-->';
		echo '<li><a href="indexshutter.php" data-target=".indexshutter-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>Index Page Shutter</a></li>
		<!--*************************** END OF INDEX SHUTTER **************************-->';
		echo '<li><a href="popularcate.php" data-target=".popular-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>Popular Seller</a></li>
		<!--*************************** END OF INDEX BANNER **************************-->';
	}
	?>
</ul>