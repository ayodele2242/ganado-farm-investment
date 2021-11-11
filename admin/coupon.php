<script type="text/javascript">
function applyCouponCode() {
    $("#csuc, #cerr").hide();
    $("#csuc, #cerr").html('');
    var coupon = $("#ccode").val();
    if(coupon!='') {
        $("#cload").show();
        $.post('ajax/coupon.php', { coupon: coupon }, function(data) {
            /*optional stuff to do after success */
            switch(data) {
                case 'A':
                    $("#cerr").html('Please enter valid coupon code');
                    $("#cerr").show();
                    $("#cload").hide();
                    break;
                case 'B':
                    $("#cerr").html('You have already used this coupon code');
                    $("#cerr").show();
                    $("#cload").hide();
                case 'C':
                    $("#cerr").html('Please enter a valid coupon code');
                    $("#cerr").show();
                    $("#cload").hide();
                default:
                    var coupon = data;

                    // Now calculate the %age
                    var price = $("#event_subtotal_price").val();
                    var pctge = parseFloat(price) * ( parseFloat(coupon) / 100 );
                    var npric = parseFloat(price) - parseFloat(pctge);

                    pctge = pctge.toFixed('2');  // Total price dicount
                    npric = npric.toFixed('2');  // New price after discount

                    // Display the discount in totalling menu
                    $("#csuc").html('Coupon applied.');
                    $("#csuc").show();
                    $("#cload").hide();
            }
        });
    } else {
        $("#cerr").html('Please enter your coupon code');
        $("#cerr").show();
    }
}
</script>

<div style="margin: 15px 85px;">
    <p>
        Coupon Code <br />
        <span><input type="text" name="ccode" id="ccode" value="" /></span>
        <span id="cbtn"><input type="button" value="Apply" style="margin-bottom: 5px;" onclick="applyCouponCode();"></span>
        <span id="cload" style="display:none;"><img style="margin-bottom: -3px;" src="loader.gif"></span>
        <span id="csuc" style="color:#016B06; display:none;"></span>
        <span id="cerr" style="color:#E40303; display:none;"></span>
    </p>
</div>



Coupon.php


<?php 

$coupon = $_REQUEST['coupon'];
$user = $_SESSION['picturebooth_customer_id'];

// Get the coupon detail
$coupon_count=$wpdb->get_var("SELECT COUNT(*) FROM `TABLE_COUPON` WHERE `coupan_code` = '$coupon' AND `status`='1'");

if($coupon_count) {

    $result = $wpdb->get_row("SELECT * FROM `TABLE_COUPON` WHERE `coupan_code` = '$coupon'");

    $discount = $result->discount;
    $today = strtotime(date("Y-m-d"));
    $from = strtotime($result->from_date);
    $to = strtotime($result->to_date);
    $total = $result->total_number;
    $used = $result->used_number;

    // Checking if the user has already has applied that coupon
    $uc_count = $wpdb->get_var("SELECT COUNT(*) FROM `USER_COUPON` WHERE `user_id` = '$user' AND `coupon_id`='$result->id'");

    if($uc_count) {
        echo 'B';
    } elseif( $today < $from ) {
        echo 'C';
    } elseif( ($today > $to) || ($used >= $total) ) {
        $wpdb->update('wp_coupons', array( 'status' => '0'), array( 'id' => $result->id ));
        echo 'C';
    } else {
        $wpdb->query("UPDATE `TABLE_COUPON` SET used_number = used_number+1 WHERE `id` = '$result->id'");
        $wpdb->query("INSERT INTO `USER_COUPON` SET `user_id` = '$user', `coupon_id`='$result->id', `date_added` = now()");
        echo $discount;
    }

} else {
    echo 'A';
}