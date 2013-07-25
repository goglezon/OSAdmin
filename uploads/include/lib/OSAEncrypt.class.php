<?php
class OSAEncrypt{
	public static function encrypt($value){
	   if(!$value){return false;}
	   //$key = 'WhatAFuck1ngDay!';
	   $key = OSA_ENCRYPT_KEY;
	   $text = $value;
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv);
	   return trim(base64_encode($crypttext)); //encode for cookie
	}

	public static function decrypt($value){
	   if(!$value){return false;}
	   //$key = 'WhatAFuck1ngDay!';
	   $key = OSA_ENCRYPT_KEY;
	   $crypttext = base64_decode($value); //decode cookie
	   $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
	   $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
	   $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $crypttext, MCRYPT_MODE_ECB, $iv);
	   return trim($decrypttext);
	}
}
?>