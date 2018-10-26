<?php
namespace Elmage\libs;

class Hash {
	public static function make($string, $cost) {
		return password_hash($string, PASSWORD_BCRYPT, ["cost" => $cost]);
	}

	public static function getOptimalCost() {

		$timeTarget = 0.05;

		$cost = 8;

		do {
			
			$cost++;

			$start = microtime(true);

			password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);

			$end = microtime(true);

		} while (($end - $start) < $timeTarget);

		return $cost;

	}

	public static function verify($string, $hash) {
		return password_verify($string, $hash);
	}

	public static function unique() {
		return self::make(uniqid(), self::getOptimalCost());
	}

}

?>