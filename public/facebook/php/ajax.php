<?php
/*
	@! Facebook comments system
	@@ Using PHP, jQuery, and AJAX
*/

session_start();
include('functions.php');

## Server's date and time. Converting it as per local time.
$date = date('Y-m-d H:i:s');
$date = date('c', strtotime($date));

if(isset($_GET['token']) && isset($_GET['msg'])) {
	$token = clean_input($_GET['token']);
	$msg = clean_input($_GET['msg']);
		if(!empty($token) && !empty($msg)) {
			if(isset($_SESSION['token']) && $token == $_SESSION['token']) {
				/*
					@@ We have done the validation and sending the result back to the index.php page.
					Normally, in an application we would be saving the information in the database.
				*/

?>
				<div class="comments clearfix">
					<div class="pull-left lh-fix">
						<img src="img/default.gif">
					</div>

					<div class="comment-text pull-left">
						<span class="color strong"><a href="#">Facebook User</a></span> &nbsp;<?php echo $msg; ?>
						<span class="info"><abbr class="time" title="<?php echo $date; ?>"></abbr></span>
					</div>
				</div>
<?php

			}
		}
}