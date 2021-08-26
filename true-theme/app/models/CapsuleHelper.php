<?php
use Illuminate\Database\Capsule\Manager as Capsule;

class CapsuleHelper {

	public static function describe($tableName) {
		$result = Capsule::select(Capsule::raw('DESCRIBE ' . $tableName));
		echo '<pre>';
		print_r($result);
		echo '</pre>';
	}

	public static function lastRunQueries() {
		$queries = Capsule::getQueryLog();

		echo '<pre>';
		print_r($queries);
		echo '</pre>';
	}

}