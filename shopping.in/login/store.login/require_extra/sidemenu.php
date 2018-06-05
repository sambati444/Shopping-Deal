<ul>
	<li><a href="#" data-target=".products-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Products<i class="fa fa-collapse"></i></a></li>
	<li><ul class="products-menu nav nav-list collapse">
			<li><a href="product_add.php"><span class="fa fa-caret-right"></span>Add New Product</a></li>
			<li><a href="product_view.php"><span class="fa fa-caret-right"></span>View Products</a></li>
	</ul></li>
	<!--*************************** END OF PRODUCTS MANAGEMENT **************************-->
	<li><a href="#" data-target=".sales-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Sale<i class="fa fa-collapse"></i></a></li>
	<li><ul class="sales-menu nav nav-list collapse">
			<li><a href="sales.php?orderno=&status=&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Total Orders</a></li>
			<li><a href="sales.php?orderno=&status=NEW&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>New Orders</a></li>
			<li><a href="sales.php?orderno=&status=PENDING&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Pending Orders</a></li>
			<li><a href="sales.php?orderno=&status=DISPATCH&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Dispatched Orders</a></li>
			<li><a href="sales.php?orderno=&status=CANCEL&city=&state=&sdate=&edate=&search=Search"><span class="fa fa-caret-right"></span>Cancelled Orders</a></li>
			<li><a href="sale_billed.php"><span class="fa fa-caret-right"></span>Sale Register</a></li>
	</ul></li>
		<!--*************************** END OF SALES MANAGEMENT **************************-->
		<li><a href="#" data-target=".purchase-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Purchase<i class="fa fa-collapse"></i></a></li>
		<li><ul class="purchase-menu nav nav-list collapse">
				<li><a href="purchase_new.php"><span class="fa fa-caret-right"></span>New Purchase</a></li>
				<li><a href="purchasereturn_new.php"><span class="fa fa-caret-right"></span>New Purchase Return</a></li>
				<li><a href="purchase_register.php"><span class="fa fa-caret-right"></span>Purchase Register</a></li>
		</ul></li>
		<!--*************************** END OF PURCHASE MANAGEMENT '.$_SESSION['permission_purchase'].'**************************-->
		<li><a href="#" data-target=".stock-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-dashboard"></i>Stock<i class="fa fa-collapse"></i></a></li>
		<li><ul class="stock-menu nav nav-list collapse">
				<li><a href="stock_register.php"><span class="fa fa-caret-right"></span>Stock Register</a></li>
		</ul></li>
		<!--*************************** END OF STOCK MANAGEMENT '.$_SESSION['permission_stock'].'**************************-->
        <li><a href="user.php" data-target=".accounts-menu" class="nav-header collapsed" data-toggle="collapse"><i class="fa fa-fw fa-briefcase"></i>User Account Setting</a></li>
	<!--*************************** END OF USER ACCOUNT SETTING **************************-->
</ul>