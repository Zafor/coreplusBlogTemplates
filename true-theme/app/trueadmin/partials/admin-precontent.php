<?php
	if (View::countNotifications() > 0) {
		?>
		<div id="notif-wrapper" style="display:none">
		<?php

		$notif = View::getNotifications();
		foreach($notif as $n) {
		?>
		<div class="notif" data-notif-type="<?= $n['type'] ?>"><?= $n['message'] ?></div>
		<?php
		}
		?>
		</div>
		<?php
	}
?>

<div class="page-content-wrapper">
		<div class="page-content">