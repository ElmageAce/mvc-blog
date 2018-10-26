<?php
namespace Elmage\util;

class Token {
	public static function generate() {
		return Session::put(\get('session/token_name'), md5(uniqid()));
	}

	public static function check($token) {
		$tokenName = \get('session/token_name');
		
		if (Session::exists($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}

		return false;
	}

	public static function get() {

		return $this->_token;
	}
}

?>