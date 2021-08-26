<?php

class DummySection implements TrueAdminSection {
	public static function init() {
		View::addToMenu('DummySection', 'Dummy', Route::generateURL('DummySection'), 'fa-question-circle' );
	}

	public static function index() {
		// Used to render title and breadcrumb
		$title = 'Dummy Section';
		$breadcrumb = array();

		// In Section, use ::render() not ::getAdminTemplate!!
		View::render('dummy/content', compact('title', 'breadcrumb'));
	}
}