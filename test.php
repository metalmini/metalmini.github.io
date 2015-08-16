<?php
if ($_POST["submit"]) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $human = intval($_POST['human']);
    $from = 'CV Contact Form';
    $to = 'michael@schouman.info';
    $subject = 'CV Contact formulier ';
    $body = "From: $name\n E-Mail: $email\n Message:\n $message";
// Check if name has been entered
    if (!$_POST['name']) {
        $errName = 'Gelieve uw naam achter te laten';
    }
// Check if email has been entered and is valid
    if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errEmail = 'Gelieve een valide e-mail adres achter te laten';
    }
//Check if message has been entered
    if (!$_POST['message']) {
        $errMessage = 'Laat hier uw bericht achter';
    }
//Check if simple anti-bot test is correct
    if ($human !== 5) {
        $errHuman = 'Hat anti-spam antwoord is niet juist.';
    }
// If there are no errors, send the email
    if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
        if (mail($to, $subject, $body, $from)) {
            $result = '<div class="alert alert-success">Hartelijk dank voor uw bericht. Ik zal spoedig contact met u opnemen</div>';
        } else {
            $result = '
<div class="alert alert-danger">Er is iets fout gegaan tijdens het verzenden. Probeer het later nog eens.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Contact formulier www.schouman.info">
    <meta name="author" content="schouman.info">
    <title>Contact formulier www.schouman.info</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-4 page-header">
          <p>Gebruik het onderstaande formulier om contact op te nemen met mij of gebruik simpelweg uw eigen mail client. </p>
            <p><strong>E-mail:</strong><a href="mailto:#"> michael@schouman.info</a></p>
        </div>

        <div class="col-sm-8 contact-form">
            <form id="contact" method="post" class="form" role="form">
                <div class="row">
                    <div class="col-xs-6 col-md-6 form-group">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Uw naam" value="<?php echo htmlspecialchars(
                            $_POST['name']
                        ); ?>">
                        <?php echo "<p class='text-danger'>$errName</p>"; ?>
                    </div>
                    <div class="col-xs-6 col-md-6 form-group">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Uw e-mail adres" value="<?php echo htmlspecialchars(
                            $_POST['email']
                        ); ?>">
                        <?php echo "<p class='text-danger'>$errEmail</p>"; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="control-label">Bericht</label>
                    <textarea class="form-control" rows="3" name="message"><?php echo htmlspecialchars(
                            $_POST['message']
                        ); ?></textarea>
                    <?php echo "<p class='text-danger'>$errMessage</p>"; ?>
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="human" class="col-xs-6 col-md-6 control-label">2 + 3 = ?</label>

                        <div class="col-xs-6 col-md-6">
                            <input type="text" class="form-control" id="human" name="human" placeholder="Uw antwoord">
                            <?php echo "<p class='text-danger'>$errHuman</p>"; ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        <?php echo $result; ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-12 form-group">
                        <input id="submit" name="submit" type="submit" value="Versturen" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>