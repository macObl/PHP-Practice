<html>
<head>
    <?php
    session_start();


    $dbConnection = parse_ini_file("Common/db_connection.ini");
    extract($dbConnection);
    $myPdo = new PDO($dsn, $user, $password);

?>
	<title>Algonquin College Book Store</title>
	<link rel = 'stylesheet' type = 'text/css' href = 'Styles.css' />
</head>
<body>


	<!--- menu at the top --->
	<p align=right><a href='Login.php'>Log in </a> |
					<a href='BookCatalog.php'>Book Catalog</a> |
	 			   <a href='ShoppingCart.php'>My Shopping Cart</a> |
				   <a href='Logout.php'>Log out</a> |
	<br/>
