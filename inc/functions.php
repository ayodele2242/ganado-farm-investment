<?php
include_once('config.php');


include_once('paginator.php');
include_once('Language/en.php');

//$mip = "41.58.231.207";
//$a = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$mip));
//$countrycode = $a['geoplugin_countryCode'];

//echo $countrycode;
	/*
     * Functions to format Dates and/or Times from the database
	 * http://php.net/manual/en/function.date.php for a full list of format characters
	 * Uncomment (remove the double slash - //) from the one you want to use
	 * Comment (Add a double slash - //) to the front of the ones you do NOT to use
	 * If you have any questions at all, please contact me through my CodeCanyon profile.
	 * http://codecanyon.net/user/Luminary
     *
     * @param string $v   		The database value (ie. 2014-10-31 20:00:00)
     * @return string           The formatted Date and/or Time
     */
	function randnumber(){
	$length = 1000;
	return $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);	 
	 }

	 function underscore($str) {
		return ucwords(str_replace("_", " ", $str));
	}
	 
	 //adding seperator to money in thousand, million etc
	 function parseCurrency($value) {
    if ( intval($value) == $value ) {
        $return = number_format($value, 0, ".", ",");
    }
    else {
        $return = number_format($value, 2, ".", ",");
        /*
        If you don't want to remove trailing zeros from decimals,
        eg. 19.90 to become: 19.9, remove the next line
        */
        $return = rtrim($return, 0);
    }

    return $return;
}
	 
	function dateFormat($v) {
		// $theDate = date("Y-m-d",strtotime($v));				// 2014-10-31
		// $theDate = date("m-d-Y",strtotime($v));				// 10-31-2014
		$theDate = date("F d, Y",strtotime($v));				// October 31, 2014
		return $theDate;
	}
	function dateTimeFormat($v) {
		// $theDateTime = date("Y-m-d g:i a",strtotime($v));	// 2014-10-31 8:00 pm
		// $theDateTime = date("m-d-Y g:i a",strtotime($v));	// 10-31-2014 8:00 pm
		$theDateTime = date("F d, Y at g:i a",strtotime($v));	// October 31, 2014 8:00 pm
		return $theDateTime;
	}
	function timeFormat($v) {
		$theTime = date("g:i a",strtotime($v));					// 8:00 pm
		return $theTime;
	}
	function dbDateFormat($v) {
		$theTime = date("Y-m-d",strtotime($v));					// 2014-10-31
		return $theTime;
	}
	function dbTimeFormat($v) {
		$theTime = date("H:i",strtotime($v));		// 20:00
		return $theTime;
	}

    /*
     * Function to show an Alert type Message Box
     *
     * @param string $message   The Alert Message
     * @param string $icon      The Font Awesome Icon
     * @param string $type      The CSS style to apply
     * @return string           The Alert Box
     */
    function alertBox($message, $icon = "", $type = "") {
        return "<div class=\"alertMsg alert-dismissible $type\" id=\"fades\"><span>$icon</span> $message </div>";
	}
	



function getParentCategoryName($id) {
    global $db_con;
    $sql = "SELECT * FROM mp_pages WHERE 1 AND page_id = :id";
    try {
        $stmt = $mysqli->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }
    
   return ($results[0]["page_title"] <> "" ) ? $results[0]["page_title"] : "None";
}

function getPageDetailsByName($pageAlias) {
    global $db_con;
    $rs = array();
    $sql = "SELECT * FROM mp_pages WHERE 1 AND page_alias = :pname";
    
    try {
        $stmt = $mysqli->prepare($sql);
        $stmt->bindValue(":pname", $pageAlias);
        $stmt->execute();
        $results = $stmt->fetchAll();
    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }

    if (count($results) > 0) {
       $rs =  $results[0];
    }
    return $rs;
}	

function strlimit($value, $limit = 250, $end = '...')
{
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }

    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}


    /*
     * Function to ellipse-ify text to a specific length
     *
     * @param string $text      The text to be ellipsified
     * @param int    $max       The maximum number of characters (to the word) that should be allowed
     * @param string $append    The text to append to $text
     * @return string           The shortened text
     */
    function ellipsis($text, $max = '', $append = '&hellip;') {
        if (strlen($text) <= $max) return $text;

        $replacements = array(
            '|<br /><br />|' => ' ',
            '|&nbsp;|' => ' ',
            '|&rsquo;|' => '\'',
            '|&lsquo;|' => '\'',
            '|&ldquo;|' => '"',
            '|&rdquo;|' => '"',
        );

        $patterns = array_keys($replacements);
        $replacements = array_values($replacements);

        // Convert double newlines to spaces.
        $text = preg_replace($patterns, $replacements, $text);
        // Remove any HTML.  We only want text.
        $text = strip_tags($text);
        $out = substr($text, 0, $max);
        if (strpos($text, ' ') === false) return $out.$append;
        return preg_replace('/(\W)&(\W)/', '$1&amp;$2', (preg_replace('/\W+$/', ' ', preg_replace('/\w+$/', '', $out)))).$append;
    }

    /*
     * Function to Encrypt sensitive data for storing in the database
     *
     * @param string	$value		The text to be encrypted
	 * @param 			$encodeKey	The Key to use in the encryption
     * @return						The encrypted text
     */
/*	function encryptIt($value) {
		// The encodeKey MUST match the decodeKey
		$encodeKey = 'swGn@7q#5y0z%E4!C#5y@9Tx@_*-=098765zyrad';
		$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encodeKey), $value, MCRYPT_MODE_CBC, md5(md5($encodeKey))));
		return($encoded);
	}*/

    /*
     * Function to decrypt sensitive data from the database for displaying
     *
     * @param string	$value		The text to be decrypted
	 * @param 			$decodeKey	The Key to use for decryption
     * @return						The decrypted text
     */
	/*function decryptIt($value) {
		// The decodeKey MUST match the encodeKey
		$decodeKey = 'swGn@7q#5y0z%E4!C#5y@9Tx@_*-=098765zyrad';
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($decodeKey), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($decodeKey))), "\0");
		return($decoded);
	}*/
	
	
		
	//Encryption function
function encryptIt($string) {
    return base64_encode($string . "_@#!@");
}

//Decodes encryption
function decryptIt($str) {
    $str = base64_decode($str);
    return str_replace("_@#!@", "", $str);
}
	
	
	
	
	
	//Encryption function
function easy_crypt($string) {
    return base64_encode($string . "_@#!@");
}

//Decodes encryption
function easy_decrypt($str) {
    $str = base64_decode($str);
    return str_replace("_@#!@", "", $str);
}
	

	/*
     * Function to strip slashes for displaying database content
     *
     * @param string	$value		The string to be stripped
     * @return						The stripped text
     */
	function clean($value) {
		$str = str_replace('\\', '', $value);
		return $str;
	}
	
	function slug($text){ 

  // replace non letter or digits by -
  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

  // trim
  $text = trim($text, '-');

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // lowercase
  $text = strtolower($text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  if (empty($text))
  {
    return 'n-a';
  }

  return $text;
}

function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $mysqlidition = array(
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $mysqlidition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}

function safe_input($mysqli, $data) {
  return htmlspecialchars(mysqli_real_escape_string($mysqli, trim($data)));
}

function class_maillist($class) {

	$emails = array();

	$query = "SELECT email FROM users WHERE grad_year = '$class'";
	$result = mysqli_query($mysqli, $query);
	$j = mysqli_fetch_array($result);
	$emails[] = $j['email'];
	while($row = mysqli_fetch_array($result)) {
		$emails[] .= implode("\t", $row);
	}
	$emails = implode(",", $emails);
	return $emails;
	
}




function getCountry(){
	global $mysqli;
	global $country_name;
	$ccsql="SELECT id,name,iso2 FROM countries";
		$ccsql_run = mysqli_query($mysqli, $ccsql);

		while ($row=mysqli_fetch_array($ccsql_run)) {
       if($country_name == $row["id"]){
        $selected = "selected";
       }else{
       	$selected = "";
       }

			echo '<option value="'.$row["id"].'" '.$selected.'>'.$row["name"].'</option>';
	}
}



function getSMSGroup(){
	global $mysqli;
	$ccsql="SELECT * FROM `sms_group` ";
		$ccsql_run = mysqli_query($mysqli, $ccsql);

		while ($ccsql_get=mysqli_fetch_array($ccsql_run)) {
			$id = $ccsql_get['id'];
			$class_name = $ccsql_get['group_name'];
			echo "<option value=".$id.">$class_name</option>";
	}
}




function getMonth(){
	echo '<option value="01">January</option>
	<option value="02">February</option>
	<option value="03">March</option>
	<option value="04">April</option>
	<option value="05">May</option>
	<option value="06">June</option>
	<option value="07">July</option>
	<option value="08">August</option>
	<option value="09">September</option>
	<option value="10">October</option>
	<option value="11">November</option>
	<option value="12">December</option>';
}

function getMonthName($month){
	if ($month == 1) {
		$month_name = "January";
	}else if ($month == 2) {
		$month_name = "February";
	}else if ($month == 3) {
		$month_name = "March";
	}else if ($month == 4) {
		$month_name = "April";
	}else if ($month == 5) {
		$month_name = "May";
	}else if ($month == 6) {
		$month_name = "June";
	}else if ($month == 7) {
		$month_name = "July";
	}else if ($month == 8) {
		$month_name = "August";
	}else if ($month == 9) {
		$month_name = "September";
	}else if ($month == 10) {
		$month_name = "October";
	}else if ($month == 11) {
		$month_name = "November";
	}else if ($month == 12) {
		$month_name = "December";
	}
	return $month_name;
}

function sendShortSMS($sms,$num){
	global $mysqli;
	$sql="SELECT * FROM `sms_config` ";
	$sql_run = mysqli_query($mysqli, $sql);
	$sql_get=mysqli_fetch_array($sql_run);

		$username = $sql_get['username'];
		$pass = $sql_get['pass'];
		$sender = $sql_get['sender'];
		$sms = urlencode($sms);

		//$str = file("http://app.itsolutionbd.net/api/sendsms/plain?user=".$username."&password=".$pass."&sender=".$sender."&SMSText=".$sms."&GSM=".$num."");
		//var_dump($str);
}



function sendLongSMS($sms,$num){
	global $mysqli;
	$sql="SELECT * FROM `sms_config` ";
	$sql_run = mysqli_query($mysqli, $sql);
	$sql_get=mysqli_fetch_array($sql_run);

		$username = $sql_get['username'];
		$pass = $sql_get['pass'];
		$sender = $sql_get['sender'];
		$sms = urlencode($sms);

		//$str = file("http://app.itsolutionbd.net/api/v3/sendsms/plain?user=".$username."&password=".$pass."&sender=".$sender."&SMSText=".$sms."&GSM=".$num."&type=longSMS");
		//var_dump($str);
}






function getOS() { 

    global $user_agent;

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}

function getBrowser() {

    global $user_agent;

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}





/*function convert_number_to_words($number) {
    $hyphen      = ' ';
    $mysqlijunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
    if (!is_numeric($number)) {
        return false;
    }
    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }
    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }
    $string = $fraction = null;
    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }
    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $mysqlijunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $mysqlijunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
    return $string;
}*/


/*function money_format($format, $number) {
	$regex = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' .
			'(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
	if (setlocale(LC_MONETARY, 0) == 'C') {
		setlocale(LC_MONETARY, '');
	}
	$locale = localeconv();
	preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
	foreach ($matches as $fmatch) {
		$value = floatval($number);
		$flags = array(
			'fillchar' => preg_match('/\=(.)/', $fmatch[1], $match) ?
					$match[1] : ' ',
			'nogroup' => preg_match('/\^/', $fmatch[1]) > 0,
			'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
					$match[0] : '+',
			'nosimbol' => preg_match('/\!/', $fmatch[1]) > 0,
			'isleft' => preg_match('/\-/', $fmatch[1]) > 0
		);
		$width = trim($fmatch[2]) ? (int) $fmatch[2] : 0;
		$left = trim($fmatch[3]) ? (int) $fmatch[3] : 0;
		$right = trim($fmatch[4]) ? (int) $fmatch[4] : $locale['int_frac_digits'];
		$conversion = $fmatch[5];

		$positive = true;
		if ($value < 0) {
			$positive = false;
			$value *= -1;
		}
		$letter = $positive ? 'p' : 'n';

		$prefix = $suffix = $cprefix = $csuffix = $signal = '';

		$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
		switch (true) {
			case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
				$prefix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
				$suffix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
				$cprefix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
				$csuffix = $signal;
				break;
			case $flags['usesignal'] == '(':
			case $locale["{$letter}_sign_posn"] == 0:
				$prefix = '(';
				$suffix = ')';
				break;
		}
		if (!$flags['nosimbol']) {
			$currency = $cprefix .
					($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
					$csuffix;
		} else {
			$currency = $cprefix .$csuffix;
		}
		$space = $locale["{$letter}_sep_by_space"] ? ' ' : '';

		$value = number_format($value, $right, $locale['mon_decimal_point'], $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
		$value = @explode($locale['mon_decimal_point'], $value);

		$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
		if ($left > 0 && $left > $n) {
			$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
		}
		$value = implode($locale['mon_decimal_point'], $value);
		if ($locale["{$letter}_cs_precedes"]) {
			$value = $prefix . $currency . $space . $value . $suffix;
		} else {
			$value = $prefix . $value . $space . $currency . $suffix;
		}
		if ($width > 0) {
			$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
							STR_PAD_RIGHT : STR_PAD_LEFT);
		}

		$format = str_replace($fmatch[0], $value, $format);
	}
	return $format;
}

function new_members_year_only() {
global $mysqli;
	
	$query = "SELECT count(grad_year) as num, grad_year FROM alumni_users WHERE status='active' GROUP BY grad_year ORDER BY grad_year DESC";
    $result = mysqli_query($mysqli, $query);
	$get = mysqli_num_rows($result);
	
	if($get < 1){
		echo '<div class="alert alert-warning">No register users at the moment</div>';
	}else{
		echo '<ul class="list-group">';
	while($row = mysqli_fetch_array($result))
		{
			if($row['num'] < 2){
				$nums = "Member";
			}else {
				$nums = "Members";
			}
		echo '<a href="year-list?class=' . $row['grad_year'] . '">
		<li class="list-group-item list-group-item-action list-group-item-light">
		' . $row['grad_year'] .' ('.$row['num']. ' '.$nums.')</li></a>';
		}
		echo '</ul>';
	}
	}

	function grad_list_register() {
		global $mysqli;
		$query_grad_year = "SELECT grad_year FROM alumni_users WHERE grad_year > 1900 GROUP BY grad_year ORDER BY grad_year DESC";
		$grad_year = mysqli_query($mysqli, $query_grad_year);
		$row_grad_year = mysqli_fetch_assoc($grad_year);
		$totalRows_grad_year = mysqli_num_rows($grad_year);
		?>	
		  <select name="grad_year"  class="form-control">
		  <option value="">Select Your Class</option>
		<?php
	do {  
	global $grad;
	?>
		<option value="<?php echo $row_grad_year['grad_year']?>"><?php echo $row_grad_year['grad_year']?></option>
		<?php
	} while ($row_grad_year = mysqli_fetch_assoc($grad_year));
	  $rows = mysqli_num_rows($grad_year);
	  if($rows > 0) {
		  mysqli_data_seek($grad_year, 0);
		  $row_grad_year = mysqli_fetch_assoc($grad_year);
	  }
	?>
	  </select>
	<?php  
	 }

*/
	 
function getNavigation($row){
 global $mysqli;
 echo "<li class='nav-item'><a class='nav-link' href=index?nav_id={$row['id']}&parent_id={$row['parent_id']}";
 if(isset($_GET['nav_id'])
 && $_GET['nav_id']==($row['id'])){
 echo " class=\"selected\"";
 }
 
 if(isset($_GET['parent_id']) 
 && $_GET['parent_id']==($row['id'])){
 echo " class=\"selected\"";
 }
 echo ">".$row['name']."</a>";
 $select_subnav="select * from navigation_bar where parent_id=".$row['id']. " order
  by position ";
 $run_subnav=mysqli_query($mysqli,$select_subnav);
 if(mysqli_num_rows($run_subnav)>0){
	 echo "<ul>";
	 while($row=mysqli_fetch_array($run_subnav)){
		  getNavigation($row);
		 }
	 echo "</ul>";
	 }
	 echo "</li>";
	}
	
	
	// getting category list
	function cat_list($p_id=0,$space=''){  
     global $mysqli;
    $q="SELECT * FROM navigation_bar WHERE parent_id='$p_id' order by position ASC ";  
$r=mysqli_query($mysqli,$q);  
 $count=mysqli_num_rows($r);  
 
if($p_id==0){  
    $space='';  
}else{  
   $white_space= "--";
   
    $space = $space . $white_space;
}  
if($count > 0){  
      
    while($row=mysqli_fetch_array($r)){  
	    
        echo "<option value=".$row['id'].">".$space.$row['name']."</option>";  
          
        cat_list($row['id'],$space);  
    }  
      
}  
  
  
}  	

// getting category list
function menu_list($p_id=0,$space=''){  
	global $mysqli;
   $q="SELECT * FROM navigation_bar WHERE parent_id='$p_id' order by position ASC ";  
$r=mysqli_query($mysqli,$q);  
$count=mysqli_num_rows($r);  

if($p_id==0){  
   $space='';  
}else{  
  $white_space= "&nbsp; &nbsp; &nbsp;";
  
   $space = $space . $white_space;
}  
if($count > 0){  
	 
   while($row=mysqli_fetch_array($r)){  
	   
	   echo "<option value=".$row['link'].">".$space.$row['name']."</option>";  
		 
	   cat_list($row['id'],$space);  
   }  
	 
}  
 
 
} 



function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
 	

function edit_cat_list($p_id=0,$space=''){  
     global $mysqli;
    $q="SELECT * FROM navigation_bar WHERE parent_id='$p_id' order by position ASC ";  
$r=mysqli_query($mysqli,$q);  
 $count=mysqli_num_rows($r);  
 
if($p_id==0){  
    $space='';  
}else{  
   $white_space= "&nbsp; &nbsp; &nbsp;";
   
    $space = $space . $white_space;
}  
if($count > 0){  
      
    while($row=mysqli_fetch_array($r)){ 
	    
	    $edit_navid=$row['id'];
        echo "<option value=".$row['id']."";
		// selected menu for edit navigation
		if(isset($_GET['parent_id'])){
		$pid=$_GET['parent_id'];
		if($pid==$edit_navid){
		echo " selected ";
		}else{echo " ";}
		}
		// selected menu for edit post
		if(isset($_GET['menu_id'])){
			$menu_id=$_GET['menu_id'];
			if($menu_id==$edit_navid ){
				echo " selected " ;
				}else{echo "";}
			}	
					
		echo ">".$space.$row['name']."</option>";  
        edit_cat_list($row['id'],$space);  
    }  
 }  
} 


function selected_parent($p_id=0,$space=''){  
     global $mysqli;
    $q="SELECT * FROM navigation_bar WHERE parent_id='$p_id' order by position ASC ";  
$r=mysqli_query($mysqli,$q);  
 $count=mysqli_num_rows($r);  
 
if($p_id==0){  
    $space='';  
}else{  
   $white_space= "&nbsp; &nbsp; &nbsp;";
   
    $space = $space . $white_space;
}  
if($count > 0){  
      
    while($row=mysqli_fetch_array($r)){  
	    $nav_id=$row['id'];
        echo "<option value=".$row['id']."";
		if(isset($_GET['select_pid'])){
			$select_pid=$_GET['select_pid'];
			if($select_pid==$nav_id){
				echo " selected " ;
				
				}else{echo "";}
			}
		echo ">".$space.$row['name']."</option>";  
          
        selected_parent($row['id'],$space);  
    }  
   }  
 }  



 /*
 * Function requested by Ajax
 */
if(isset($_POST['func']) && !empty($_POST['func'])){
    switch($_POST['func']){
        case 'getCalender':
            getCalender($_POST['year'],$_POST['month']);
            break;
        case 'getEvents':
            getEvents($_POST['date']);
            break;
        default:
            break;
    }
}


function redirect($url) {

    echo "<script language=\"JavaScript\">\n";
    echo "<!-- hide from old browser\n\n";

    echo "window.location = \"" . $url . "\";\n";

    echo "-->\n";
    echo "</script>\n";

    return true;
}

function set_rights($menus, $menuRights, $topmenu) {
    $data = array();

    for ($i = 0, $c = count($menus); $i < $c; $i++) {


        $row = array();
        for ($j = 0, $c2 = count($menuRights); $j < $c2; $j++) {
            if ($menuRights[$j]["rr_modulecode"] == $menus[$i]["mod_modulecode"]) {
                if (authorize($menuRights[$j]["rr_create"]) || authorize($menuRights[$j]["rr_edit"]) ||
                        authorize($menuRights[$j]["rr_delete"]) || authorize($menuRights[$j]["rr_view"])
                ) {

                    $row["menu"] = $menus[$i]["mod_modulegroupcode"];
                    $row["menu_name"] = $menus[$i]["mod_modulename"];
                    $row["page_name"] = $menus[$i]["mod_modulepagename"];
                    $row["create"] = $menuRights[$j]["rr_create"];
                    $row["edit"] = $menuRights[$j]["rr_edit"];
                    $row["delete"] = $menuRights[$j]["rr_delete"];
                    $row["view"] = $menuRights[$j]["rr_view"];

                    $data[$menus[$i]["mod_modulegroupcode"]][$menuRights[$j]["rr_modulecode"]] = $row;
                    $data[$menus[$i]["mod_modulegroupcode"]]["top_menu_name"] = $menus[$i]["mod_modulegroupname"];
                }
            }
        }
    }
    
    return $data;
}

function authorize($module) {
    return $module == "yes" ? TRUE : FALSE;
}



/*Function to set JSON output*/
function output($Return=array()){
    /*Set response header*/
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    /*Final JSON response*/
    exit(json_encode($Return));
}




?>
