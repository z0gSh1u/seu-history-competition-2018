<?php
//
// --- BRIEF INSTRUCTION ---
// 
// Crumb is a simple but effective method developed by Yahoo
// to avoid request forgery attack and verify the submission
// of forms.
// You can modify:
//   SALT - a string as you like
//   ttl - period of token validity
//   substr range - might decide token length
//
	
class Crumb {
	CONST SALT = "meiyuan2Fmalaxiangguoistoosalty";
	static $ttl = 4800;
	
	static public function challengeHMAC($data) {
		return hash_hmac('md5', $data, self::SALT);
	}

	static public function genToken($uid, $action = -1) {
		$i = ceil(time() / self::$ttl);
		return substr(self::challengeHMAC($i . $action . $uid), -13, 12);
	}

	static public function verifyToken($uid, $crumb, $action = -1) {
		$i = ceil(time() / self::$ttl);
		if (substr(self::challengeHMAC($i . $action . $uid), -13, 12) == $crumb || substr(self::challengeHMAC(($i - 1) . $action . $uid), -13, 12) == $crumb)
			return true;
		return false;
	}
}

?>