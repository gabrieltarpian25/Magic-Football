<?php
session_start();
include_once("config.php");
echo '<body style="background-color:black">';
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
        background-color: #B0B0B0  ;
        box-shadow: 10px;
    }
    input[type=button]:hover
    {
        background-color: 00FFCC;
        cursor:pointer;
    }

    </style>
    <script type="text/javascript">
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
<title>Shopping Cart</title>
<link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<a href="http://www.powerleague.co.uk/playermatch?utm_source=prodirect&utm_medium=banner&utm_campaign=PM"><img src="reclama1.jpg" height="20%" width="100%"></a>
<table border=0 align="center">
    <span style="cursor:pointer"><tr><td><input type="button" value="Home" onClick="butHome()"></td></span>
    <td><input type="button" onClick="butTshirt()" value="T-Shirts"></td>
    <td><input type="button" onClick="butBalls()" value="Balls"></td>
    <td><input type="button" onClick="butBoots()" value="Boots"></td>
    <td><input type="button" onClick="butJackets()" value="Jackets"></td>
    <td><input type="button" onClick="butShorts()" value="Shorts"></td>
    <td><input type="button" onClick="butShop()" value="Shopping Cart"></td></tr></table>
<div id="products-wrapper">
    <h1>Products</h1>
    <div class="products">
    <?php
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    
	$results = $mysqli->query("SELECT * FROM products ORDER BY id ASC");
    if ($results) { 
	
        while($obj = $results->fetch_object())
        {
            if($obj->id>=10 and $obj->id<=13)
            {
			echo '<div class="product">'; 
            echo '<form method="post" action="cart_update.php">';
			echo '<div class="product-thumb"><img src="images/'.$obj->product_img_name.'"></div>';
            echo '<div class="product-content"><h3>'.$obj->product_name.'</h3>';
            echo '<div class="product-desc">'.$obj->product_desc.'</div>';
            echo '<div class="product-info">';
			echo 'Price '.$currency.$obj->price.' | ';
            echo 'Qty <select name="q">
                            <option value=1>1</option>
                            <option value=2>2</option> 
                            <option value=3>3</option>
                            <option value=4>4</option>
                            <option value=5>5</option></select>';
            echo 'Size <select name="size">
                            <option value="S">S</option>
                            <option value="M">M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option></select>';
			echo '<button class="add_to_cart">Add To Cart</button>';
			echo '</div></div>';
            echo '<input type="hidden" name="product_code" value="'.$obj->product_code.'" />';
            echo '<input type="hidden" name="type" value="add" />';
			echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
            echo '</form>';
            echo '</div>';
        }
        }
    
    }
    ?>
    </div>
    
<div class="shopping-cart">
<h2>Your Shopping Cart</h2>
<?php
if(isset($_SESSION["products"]))
{
    $total = 0;
    echo '<ol>';
    foreach ($_SESSION["products"] as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'&return_url='.$current_url.'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Quantity : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-qty">Size : '.$cart_itm["size"].'</div>';
        echo '<div class="p-price">Price :'.$currency.$cart_itm["price"].'</div>';
        echo '</li>';
        $subtotal = ($cart_itm["price"]*$cart_itm["qty"]);
        $total = ($total + $subtotal);
    }
    echo '</ol>';
    echo '<span class="check-out-txt"><strong>Total : '.$currency.$total.'</strong> <a href="view_cart.php">Check-out!</a></span>';
	echo '<span class="empty-cart"><a href="cart_update.php?emptycart=1&return_url='.$current_url.'">Empty Cart</a></span>';
}else{
    echo 'Your Cart is empty';
}
?>
</div>
    
</div>

</body>
</html>
