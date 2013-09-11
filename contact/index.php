<?php
	require_once '../libraries/swiftmailer/swift_required.php';
	$config = require_once '../configuration.php';

	$input = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$params = ["name", "email", "message"];
		$errors = [];

		foreach ($params as $param) {
			if (!isset($_REQUEST[$param]) || $_REQUEST[$param] == '') {
				$errors[$param] = ucfirst($param)." is required.";
			}
		}

		if (!isset($errors['email'])) {
			if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL) == false) {
				$errors['email'] = 'Please enter a valid email address.';
			}
		}

		if (count($errors) == 0) {
			$name    = str_ireplace(array("\r", "\n", '%0A', '%0D'), '', $_REQUEST['name']);
			$email   = str_ireplace(array("\r", "\n", '%0A', '%0D'), '', $_REQUEST['email']);
			$message = filter_var($_REQUEST['message'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

			$subject = "Wintersfear.com: Message from ".$name;

			$msg = Swift_Message::newInstance()
				->setSubject($subject)
				->setFrom("info@wintersfear.com")
				->setTo($config['mail.contact_recipients'])
				->setReplyTo(array($email => $name))
				->setBody($message);

			$transport = Swift_SmtpTransport::newInstance($config['mail.host'], $config['mail.port'])
				->setUsername($config['mail.username'])
				->setPassword($config['mail.password']);

			$mailer = Swift_Mailer::newInstance($transport);

			$result = $mailer->send($msg);

			if ($result) {
				$messages = ["Message was sent successfully"];
			}
			else {
				$messages = ["An error occurred while sending your message."];
			}
		}
		else {
			$input = [
				'name' => $_REQUEST['name'],
				'email' => $_REQUEST['email'],
				'message' => $_REQUEST['message'],
			];
		}
	}

	$title = 'Contact | Wintersfear';
	$page = 'contact';
	include('../inc/header.php');
?>

<h1>Contact</h1>

<p class="intro">For booking or general contact, please complete the form.</p>

<div class="rule"></div>

<?php if (isset($messages) && count($messages)): ?>
<ul>
	<?php echo '<li>'.implode('</li><li>', $messages).'</li>'; ?>
</ul>
<?php endif; ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div class="form-row<?php if (isset($errors['name'])) echo ' required'; ?>">
		<label>Name:</label>
		<input type="text" name="name" value="<?php if (isset($input['name'])) echo $input['name']; ?>" />
		<?php if (isset($errors['name'])): ?>
		<span class="errors">*<?php echo $errors['name']; ?></span>
		<?php endif; ?>
	</div>
	<div class="form-row<?php if (isset($errors['email'])) echo ' required'; ?>">
		<label>Email:</label>
		<input type="text" name="email" value="<?php if (isset($input['email'])) echo $input['email']; ?>" />
		<?php if (isset($errors['email'])): ?>
		<span class="errors">*<?php echo $errors['email']; ?></span>
		<?php endif; ?>
	</div>
	<div class="form-row<?php if (isset($errors['message'])) echo ' required'; ?>">
		<label>Message:</label>
		<textarea name="message"><?php if (isset($input['message'])) echo $input['message']; ?></textarea>
		<?php if (isset($errors['message'])): ?>
		<span class="errors">*<?php echo $errors['message']; ?></span>
		<?php endif; ?>
	</div>
	<div class="form-row">
		<input type="submit" value="Submit" />
	</div>
	
</form>

<?php include('../inc/footer.php'); ?>