<?php
	$title = 'Contact | Wintersfear';
	$page = 'contact';
	include('../inc/header.php');
?>

<h1>Contact</h1>

<p class="intro">For booking or general contact, please complete the form.</p>
			

<div class="rule"></div>

<form>
	<div class="form-row">
		<label>Name:</label>
		<input type="text" />
	</div>
	<div class="form-row">
		<label>Email:</label>
		<input type="text" />
	</div>
	<div class="form-row">
		<label>Message:</label>
		<textarea></textarea>
	</div>
	<div class="form-row">
		<input type="submit" value="Submit" />
	</div>
	
</form>

<?php include('../inc/footer.php'); ?>