<?php
session_start(); //start session
require_once (__DIR__.'/scripts/config.php');
?>
<html>
    <head>
        
    </head>
    <body>
<?php
if(isset($_POST["type"]) && $_POST["type"]=='complete')
{
    //add transaction to header,details and totals
    echo '<h1>Order processed</h1>';
    $date=date("Y-m-d h:i:s");
    $user_id = $_SESSION['user_session'];
    if($user_id==null)
    {
        print 'no user';
        $memberid=0;
    }
    else{
        print 'member';
    $sql="Select customerID from customer where customerEmail='$user_id'";
    $querystmt=$DB_con->prepare($sql);
	$querystmt->execute();
	$row=$querystmt->fetchObject();
	$memberid=$row->customerID;
    }
    
    $sql="INSERT INTO Purchase_Hdr(`TransactionDate`, `MemberID`) VALUES ('$date',$memberid)";
    $querystmt=$DB_con->prepare($sql);
	$querystmt->execute();
    
    //remove session values
    $_SESSION['cart_products']=NULL;
    $_SESSION['net']=NULL;
    $_SESSION['tax']=NULL;
    $_SESSION['total']=NULL;
}?>
</body>
<?php $page_Content=ob_get_contents(); 
	ob_end_clean(); 
	$pagetitle="Item List" ;
	include( "master.php");
?>
</html>