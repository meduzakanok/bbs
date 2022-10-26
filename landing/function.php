<?php
function getLogin($enc, $ind) {
	include 'db_utf8.php';
     $r_enc = '';
	$l = '';
	$str_l = $enc;
	$str_l = trim(urlencode($str_l));
	$str_l = str_replace("+", "%2B",$str_l);
	$str_l = trim(urldecode($str_l));
	$l = $str_l;
	
	if ($ind ==1)
	{												//-----------------return dec l with Name
		$str_l = trim(decrypt($str_l));
		$chk=0;
		$sql = "SELECT * FROM login_session WHERE login_user='".$str_l."' and login_flag='Y' order by login_date desc";
		$query = mysqli_query($con, $sql);
		$rows = mysqli_num_rows($query);
		if ($rows>0){
			while($result = mysqli_fetch_assoc($query)){
				if ($chk>0)
					break;
				$r_enc = $str_l.'/'.$result['login_name']." ".$result['login_sname'];
				$chk++;
			}
		}
	}
	elseif ($ind ==2)
	{															//-----------------return Login
		$str_l = trim(decrypt($str_l));
		$chk=0;
		$sql = "SELECT * FROM login_session WHERE login_user='".$str_l."' and login_flag='N' order by login_date desc";
		$query = mysqli_query($con, $sql);
		$rows = mysqli_num_rows($query);
		if ($rows>0){
			while($result = mysqli_fetch_assoc($query)){
				//if ($chk>0)
				//	break;
				$r_enc = 'Last Access '.$result['login_date'];
				$chk++;
			}
		}
	}
	elseif ($ind ==3)
	{															//-----------------return dec l
		$r_enc = trim(decrypt($str_l));
	}
	else{														//-----------------return enc l
		$r_enc = $l;
	}
		
    return $r_enc;
}

function current_date() {
    date_default_timezone_set('Asia/Bangkok');
    return date("Y-m-d H:i:s");
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// --- Encrypt --- //
function encrypt($plaintext, $secret_key = "5fgf5HJ5g27", $cipher = "AES-128-CBC")
{
    $key = openssl_digest($secret_key, 'SHA256', TRUE);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = openssl_random_pseudo_bytes($ivlen);
    // binary cipher
    $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    // or replace OPENSSL_RAW_DATA & $iv with 0 & bin2hex($iv) for hex cipher (eg. for transmission over internet)
    // or increase security with hashed cipher; (hex or base64 printable eg. for transmission over internet)
    $hmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
    return base64_encode($iv . $hmac . $ciphertext_raw);
}
// --- Decrypt --- //
function decrypt($ciphertext, $secret_key = "5fgf5HJ5g27", $cipher = "AES-128-CBC")
{
    $c = base64_decode($ciphertext);
    $key = openssl_digest($secret_key, 'SHA256', TRUE);
    $ivlen = openssl_cipher_iv_length($cipher);
    $iv = substr($c, 0, $ivlen);
    $hmac = substr($c, $ivlen, $sha2len = 32);
    $ciphertext_raw = substr($c, $ivlen + $sha2len);
    $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, OPENSSL_RAW_DATA, $iv);
    $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, true);
    if (hash_equals($hmac, $calcmac))
        return $original_plaintext . "\n";
}
?>