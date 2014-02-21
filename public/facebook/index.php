<?php
/*
	@! Facebook comments system
	@@ Using PHP, jQuery, and AJAX
-----------------------------------------------------------------------------	
	# author: @akshitsethi
	# web: http://www.akshitsethi.me
	# email: ping@akshitsethi.me
	# mobile: (91)9871084893
-----------------------------------------------------------------------------
	@@ The biggest failure is failing to try.
*/

session_start();
include('php/functions.php');

$token = get_token(20);
$_SESSION['token'] = $token;

?>
<!doctype html>
<html lang="en">
<head>
<title>Facebook comments, like system using PHP, jQuery and AJAX - A tutorial by akshitsethi.me</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="Description" content="Create a Facebook like comments system using PHP, jQuery and AJAX." />
<meta name="Keywords" content="" />
<meta name="Owner" content="Akshit Sethi" />
<link rel="shortcut icon" href="img/favicon.ico">
<link href="css/style.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.timeago.js"></script>
<script type="text/javascript" src="js/jquery.autosize.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var msg = '#message';

	$('.time').timeago();
	$(msg).autosize();

	$('#post_comment').click(function() {
		$(msg).focus();
	});

	$(msg).keypress(function(e) {
		if(e.which == 13) {
			var val = $(msg).val();

			$.ajax({
				url: 'php/ajax.php',
				type: 'GET',
				data: 'token=<?php echo $token; ?>&msg='+escape(val),
				success: function(data) {
					$(msg).val('');
					$(msg).css('height','14px');
					$('#commentscontainer').append(data);
					$('.time').timeago();
				}
			});
		}
	});

	$('#like_post').click(function() {
		var count = parseFloat($('#count').html()) + 1;
		if(count > 1) {
			$('#if_like').html('You and');
			$('#people').html('others');
		} else {
			$('#if_like').html('You like this.');
			$('#likecontent').hide();
		}

		$('#like_post').hide();
		$('#unlike_post').show();
	});

	$('#unlike_post').click(function() {
		var count = parseFloat($('#count').html()) - 1;
		if(count < 1) {
			$('#likecontent').show();	
		}
		$('#unlike_post').hide();
		$('#like_post').show();
		$('#if_like').html('');
		$('#people').html('people');
	});
});
</script>
</head>
<body>
	<div class="header">
		<div class="header-inner clearfix">
			<div class="pull-left">
				<a href="http://www.akshitsethi.me" target="_blank"><img src="img/logo.png" class="logo"></a>
			</div>

			<div class="pull-right">
				<p class="small-text no-margin"><span class="highlight">Facebook comments, like system using <strong>PHP</strong>, <strong>jQuery</strong> and <strong>AJAX</strong></span></p>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="page-header">
			<h1>Facebook comments, like system using PHP, jQuery, and AJAX</h1>
			<p>The main idea behind bringing this tutorial for you all is to explain and help you understand how we can implement a ajax comments system which is safe from <span class="highlight">CSRF / XSRF</span> attacks and looks decent enough. Below is the sweet demo. Please note that we are not storing any comments in the database.</p>
		</div>

		<div class="content">
			<div class="links">
				<a href="javascript:;" id="unlike_post" class="hide">Unlike</a><a href="javascript:;" id="like_post">Like</a> &middot; <a href="javascript:;" id="post_comment">Comment</a>
			</div>

			<div class="like clearfix">
				<img src="img/like.png" class="pull-left">
				<div class="pull-left">
					<span id="if_like"></span> <span id="likecontent"><span id="count" class="color">8</span> <span id="people" class="color">people</span> like this</span>
				</div>
			</div>

			<div id="commentscontainer">
				<div class="comments clearfix">
					<div class="pull-left lh-fix">
						<img src="img/default.gif">
					</div>

					<div class="comment-text pull-left">
						<span class="pull-left color strong"><a href="#">Mark Zuckerberg</a></span> &nbsp;This is a great example of how the multiple line comments will look like. It seems to be working well.
						<span class="info"><abbr class="time" title="2013-07-08T21:50:03+02:00"></abbr></span>
					</div>
				</div>

				<div class="comments clearfix">
					<div class="pull-left lh-fix">
						<img src="img/default.gif">
					</div>

					<div class="comment-text pull-left">
						<span class="color strong"><a href="#">Akshit Sethi</a></span> &nbsp;How is this going?
						<span class="info"><abbr class="time" title="2013-07-07T21:50:03+02:00"></abbr></span>
					</div>
				</div>
			</div>

			<div class="comments clearfix">
				<div class="pull-left lh-fix">
					<img src="img/default.gif">
				</div>

				<div class="comment-text pull-left">
					<textarea class="text-holder" placeholder="Write a comment.." id="message"></textarea>
				</div>
			</div>
		</div>

		<div class="page-footer">
			<p>A small piece of code by <strong><a href="http://www.akshitsethi.me" target="_blank">Akshit Sethi</a></strong></p>
		</div>
	</div>
</body>
</html>