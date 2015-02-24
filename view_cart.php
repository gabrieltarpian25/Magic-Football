<?php
session_start();
include_once("config.php");
echo '<body style="background-color:#808080  ">';
?>
<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
    input[type=button]
    {
        height:30px;
        width:130px;
        font-size:18px;
        font-style: bold;
        background-color:#B0B0B0  ;
        box-shadow: 10px;
    }
    input[type=button]:hover
    {
        background-color: 00FFCC;
        cursor:pointer;
    }

    </style>
	<script type="text/javascript">
	function verificare()
	{
		if(document.forms["f"]["firstName"].value=="")
		{
			window.alert("First Name must be filled out !");
			return false;
		}
		if(document.forms["f"]["lastName"].value=="")
		{
			window.alert("Last Name must be filled out !");
			return false;
		}
		if(document.forms["f"]["streetAdress"].value=="")
		{
			window.alert("Street Adress must be filled out !");
			return false;
		}
		if(document.forms["f"]["apt"].value=="")
		{
			window.alert("Apartment/Suite must be filled out !");
			return false;
		}
		if(document.forms["f"]["city"].value=="")
		{
			window.alert("City must be filled out !");
			return false;
		}
		if(document.forms["f"]["district"].value=="")
		{
			window.alert("District must be filled out !");
			return false;
		}
		if(document.forms["f"]["postalCode"].value=="")
		{
			window.alert("Postal Code must be filled out !");
			return false;
		}
		if(document.forms["f"]["phone"].value=="")
		{
			window.alert("Phone must be filled out !");
			return false;
		}
	}
    function butTshirt()
    {
        window.open("tshirts.php","_self");
    }
    function butBalls()
    {
        window.open("mingi.php","_self");
    }
    function butBoots()
    {
        window.open("boots.php","_self");
    }
    function butJackets()
    {
        window.open("jackets.php","_self");
    }
    function butShorts()
    {
        window.open("shorts.php","_self");
    }
    function butShop()
    {
        window.open("view_cart.php","_self");
    }
    function butHome()
    {
        window.open("index.html","_self");
    }
  </script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View shopping cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css"></head>
<body>
	 <img src="logo2.jpg" height="20%" width="100%">
<table border=0 align="center">
    <span style="cursor:pointer"><tr><td><input type="button" onclick="butHome()" value="Home"></td></span>
    <td><input type="button" onClick="butTshirt()" value="T-Shirts"></td>
    <td><input type="button" onClick="butBalls()" value="Balls"></td>
    <td><input type="button" onClick="butBoots()" value="Boots"></td>
    <td><input type="button" onClick="butJackets()" value="Jackets"></td>
    <td><input type="button" onClick="butShorts()" value="Shorts"></td>
    <td><input type="button" onClick="butShop()" value="Shopping Cart"></td></tr></table>
<div id="products-wrapper">
 <h1>View Cart</h1>
 <div class="view-cart">
 	<?php
 	$comandafinala='';
    $current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	if(isset($_SESSION["products"]))
    {
	    $total = 0;
		echo '<ul>';
		$cart_items = 0;
		foreach ($_SESSION["products"] as $cart_itm)
        {
           $product_code = $cart_itm["code"];
		   $results = $mysqli->query("SELECT product_name,product_desc, price FROM products WHERE product_code='$product_code' LIMIT 1");
		   $obj = $results->fetch_object();
		   $comanda='Code:'.$product_code.' - Size:'.$cart_itm["size"].' - Qty:'.$cart_itm["qty"].' - Subtotal:'.$cart_itm["price"]*$cart_itm["qty"].'<br>';
		   $comandafinala=$comanda.$comandafinala;

		    echo '<li class="cart-itm">';
			echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
			echo '<div class="p-price">'.$currency.$obj->price.'</div>';
            echo '<div class="product-info">';
			echo '<h3>'.$obj->product_name.' (Code :'.$product_code.')</h3> ';
            echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
            echo '<div class="p-qty">Size : '.$cart_itm["size"].'</div>';
            echo '<div>'.$obj->product_desc.'</div>';
			echo '</div>';
            echo '</li>';
			$subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
			$total = ($total + $subtotal);
			

			echo '<input type="hidden" name="item_name['.$cart_items.']" value="'.$obj->product_name.'" />';
			echo '<input type="hidden" name="item_code['.$cart_items.']" value="'.$product_code.'" />';
			echo '<input type="hidden" name="item_desc['.$cart_items.']" value="'.$obj->product_desc.'" />';
			echo '<input type="hidden" name="item_qty['.$cart_items.']" value="'.$cart_itm["qty"].'" />';
			$cart_items ++;
			
        }
        $comandafinala=$comandafinala.'TOTAL PRICE : '.$total;
    	echo '</ul>';
		echo '<span class="check-out-txt">';
		echo '<strong>Total : '.$currency.$total.'</strong>  ';
		echo '</span>';
		echo '</form>';
		
    }else{
		echo 'Your Cart is empty';}
    echo '</div>';
    echo '<h3>Shipping Adress</h3>
	<form method="post" name="f" action="finish.php" onsubmit="return verificare()">
	<table border=0> 
	<tr><td>First Name*</td><td> <input tye="text" name="firstName"></td></tr>
	<tr><td>Last Name*</td><td>  <input type="text" name="lastName"></td></tr>
	<tr><td>Email*</td><td>  <input type="text" name="email"></td></tr>
	<tr><td>Street Adress*</td><td>  <input type="text" name="streetAdress"></td></tr>
	<tr><td>Apt/Suite*</td><td>  <input type="text" name="apt"></td></tr>
	<tr><td>City*</td><td>  <input type="text" name="city"></td></tr>
	<tr><td>District*</td><td>  <input type="text" name="district"></td></tr>
	<tr><td>Postal Code* </td><td>  <input type="text" name="postalCode"></td></tr>
	<tr><td>Phone*</td><td>  <input type="text" name="phone"></td></tr>
	<tr><td>Country*</td><td><select name="country"><option value="Romania">Romania</option></select></td></tr>
	<tr><td>Comanda: </td><td><textarea readonly name="textC" rows="5" cols="40">'.$comandafinala.'</textarea></td></tr></table>
	<input type="submit" value="Send Details!">
	<input type="reset" value="Reset">';
?>
</div>

</body>
</html>
