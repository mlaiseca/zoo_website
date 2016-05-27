<?php
ob_start();
require_once (__DIR__.'/scripts/config.php');
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/cart.css">
    </head>
    <body>
<div class="shopping-cart">
<h2>Your Shopping Cart</h2>
<?php
if(isset($_SESSION["cart_products"]) && count($_SESSION["cart_products"])>0)
{
    echo '<div id="view-cart">';
    echo '<form method="post" action="cart_update.php">';
    echo '<table width="100%"  cellpadding="6" cellspacing="0">';
    echo '<tbody>';

    $total =0;
    $b = 0;
    foreach ($_SESSION["cart_products"] as $cart_itm)
    {
        $product_name = $cart_itm["product_name"];
        $product_qty = $cart_itm["product_qty"];
        $product_price = $cart_itm["product_price"];
        $product_code = $cart_itm["product_code"];
        $bg_color = ($b++%2==1) ? 'odd' : 'even'; //zebra stripe
        echo '<tr class="'.$bg_color.'">';
        echo '<td>Qty <input type="text" size="2" maxlength="2" name="product_qty['.$product_code.']" value="'.$product_qty.'" /></td>';
        echo '<td>'.$product_name.'</td>';
        echo '<td>'.money_format("$%i",$product_price * $product_qty).'</td>';
        echo '<td><input type="checkbox" name="remove_code[]" value="'.$product_code.'" /> Remove</td>';
        echo '</tr>';
        $itemtotal = ($product_price * $product_qty);
        $subtotal = ($subtotal + $itemtotal);
    }
    session_start();
    $_SESSION['net']=$subtotal;
    $net=$_SESSION['net'];
    $_SESSION['tax']=number_format($net*.0825,2,'.','');
    $tax=$_SESSION['tax'];
    $_SESSION['total']=number_format($net+$tax,2,'.','');
    $total=$_SESSION['total'];

    echo '<tr><td><b>Sub total $'.$net.'</b></td></tr>';
    echo '<tr><td><b>Tax total $'.$tax.'</b></td></tr>';
    echo '<tr><td><big><b>Total Sale $'.$total.'</b></big></td></tr>';
    echo '<td colspan="4">';
    echo '<button type="submit">Update</button><a href="checkout.php" class="button">Checkout</a>';
    echo '</td>';
    echo '</tbody>';
    echo '</table>';
    
    $current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
    echo '<input type="hidden" name="return_url" value="'.$current_url.'" />';
    echo '</form>';
    echo '</div>';

}
else
{
    echo '<h3>Your Cart is Empty</h3>';
}
?>
</div>
<?php
	$page_Content=ob_get_contents();
	ob_end_clean();
	$pagetitle="Shopping Cart";
	include("master.php");
	?>
</body>
</html>