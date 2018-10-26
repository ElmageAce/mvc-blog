<?php

function get($path) {

    $config = $GLOBALS['config'];

    $path = explode('/', $path);

    foreach ($path as $bit) {

        if (isset($config[$bit])) {

            $config = $config[$bit];
        }
    }

    return $config;
}

function formatDate($date, $format = null) {

	if ($format === true) {
		return date("F d, Y", strtotime($date));
	}

	if ($format === "F Y") {
		
		return date($format, strtotime($date));

	}

	if ($format === 'time') {
		$dateStr = date("F d, Y", strtotime($date));

		$dateStr .= ' AT ' . date("h:i A", strtotime($date));

		return $dateStr;
	}

	$presentTime = time();

	$dbTime = strtotime($date);

	$timeDiff = $presentTime - $dbTime;

	$hours = round($timeDiff / 60 / 60);

	if ($timeDiff < 3600 && $timeDiff > 0) {
		
		return ($timeDiff / 60) . 'minutes ago';

	} elseif ($hours == 1) {
		
		return $hours . ' hour ago';

	} elseif ($hours > 1 && $hours < 24 && $timeDiff > 0) {

		return $hours . ' hours ago';

	} elseif ($hours >= 24 && $hours < 36) {
		
		return 'Yesterday';

	} else {

		return date("F d, Y", strtotime($date));
	}

}

?>