<?php
 require_once('reCAPTCHA.class.php');
 define('RECAPTCHA_PUBLIC_KEY', '');
 define('RECAPTCHA_PRIVATE_KEY', '');
?>
<!DOCTYPE html>
<html>
 <head>
  <title> reCAPTCHA Test </title>
  <script src="https://www.google.com/recaptcha/api.js"></script>
 </head>
 <body>

    <?php
     if (isset($_POST['submit'])) {
         if (!isset($_POST['g-recaptcha-response'])) {
             echo 'Something went wrong.';
         }
         else {
             $captcha = new reCAPTCHA($_POST['g-recaptcha-response'], RECAPTCHA_PRIVATE_KEY);
             $captcha->sendRequest();

             if (!$captcha->isSolved()) {
                 echo 'You didn\'t solve the reCAPTCHA.';
                 print_r($captcha->getResult());
             }
             else {
                 echo 'You did solve the reCAPTCHA.';
             }
         }

         echo '<br /><br />';
     }
    ?>

    <form action="example.php" method="post">
     <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_PUBLIC_KEY; ?>"></div><br /><br />
     <input type="submit" name="submit" value="Check" />
    </form>

 </body>
</html>
