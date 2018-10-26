<?php
namespace Elmage\libs;

class Debugging {

	function __construct() {
		echo "Debugging purposes only<br>\n";
	}

	public static function printArray($array) {

		echo "<pre>";

		print_r($array);

		echo "</pre>";
	}
}

?>