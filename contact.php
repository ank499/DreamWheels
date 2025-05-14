<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Sanitize user input (prevent malicious code injection)
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $subject = filter_var($_POST['Subject'], FILTER_SANITIZE_STRING);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  // Additional validation (optional)
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    $error = "Please fill out all fields.";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Please enter a valid email address.";
  }

  // Send email if no errors
  if (empty($error)) {

    $to = "kumarpraveen49820@gmail.com"; // Replace with your recipient email
    $body = "Name: $name \nEmail: $email \nSubject: $subject \nMessage: $message";
    $headers = "From: $name <$email>";

    if (mail($to, $subject, $body, $headers)) {
      $success = "Your message has been sent successfully!";
    } else {
      $error = "There was an error sending your message. Please try again later.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  </head>
<body>
  <section class="contact">
    <div class="contact-form">
      <h3>Send me a message</h3>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="text/plain">
        <fieldset>
          <div class="form-field">
            <input name="name" type="text" id="name" placeholder="Your Name" value="<?php echo isset($name) ? $name : ''; ?>">
          </div>
          <div class="form-field">
            <input name="email" type="email" id="email" placeholder="Your Email" value="<?php echo isset($email) ? $email : ''; ?>">
          </div>
          <div class="form-field">
            <input name="Subject" type="text" id="subject" placeholder="Subject" value="<?php echo isset($subject) ? $subject : ''; ?>">
          </div>
          <div class="form-field">
            <textarea name="message" type="text" id="message" placeholder="Your Message"><?php echo isset($message) ? $message : ''; ?></textarea>
          </div>
          <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
          <?php endif; ?>
          <?php if (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
          <?php endif; ?>
        </fieldset>
        <input id="form-btn" type="submit" value="send">
      </form>
    </div>
  </section>

  </body>
</html>