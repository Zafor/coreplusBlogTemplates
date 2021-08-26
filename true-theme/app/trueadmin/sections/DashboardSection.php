<?php

class DashboardSection implements TrueAdminSection {
	public static function init() {

	}

	public static function index() {
		View::render('admin-content');
	}
}