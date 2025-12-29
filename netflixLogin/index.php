<?php
include('connection.php');
session_start();

$loginMessage = "";
$display = "style='display:none'";

/* ------------------ FORM SUBMIT ------------------ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $pass  = mysqli_real_escape_string($con, $_POST['pass']);

    $sql = "SELECT * FROM data WHERE First='$email'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if ($row['Last'] == $pass) {

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['loginMessage'] = "Login Success";

            // REDIRECT
            header("Location: index.php");
            exit;

        } else {

            $_SESSION['loginMessage'] = "Incorrect Password<br>You can use a sign-in code, reset your password or try again,";

            // REDIRECT
            header("Location: index.php");
            exit;
        }

    } else {

        $_SESSION['loginMessage'] = "Sorry, we can't find an account with this email address. Please try again or create a new account.";

        // REDIRECT
        header("Location: index.php");
        exit;
    }
}

/* ------------------ SHOW MESSAGE AFTER REDIRECT ------------------ */
if (isset($_SESSION['loginMessage'])) {
    $loginMessage = $_SESSION['loginMessage'];
    $display = "style='display:block'";
    unset($_SESSION['loginMessage']);  // remove after showing once
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>netflix login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="wrapper">
        <div class="container upperPart">
            <div class="logo">
                <svg viewBox="0 0 111 30" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="default-ltr-iqcdef-cache-17hp4kx e38gzvf2"><g><path d="M105.06233,14.2806261 L110.999156,30 C109.249227,29.7497422 107.500234,29.4366857 105.718437,29.1554972 L102.374168,20.4686475 L98.9371075,28.4375293 C97.2499766,28.1563408 95.5928391,28.061674 93.9057081,27.8432843 L99.9372012,14.0931671 L94.4680851,-5.68434189e-14 L99.5313525,-5.68434189e-14 L102.593495,7.87421502 L105.874965,-5.68434189e-14 L110.999156,-5.68434189e-14 L105.06233,14.2806261 Z M90.4686475,-5.68434189e-14 L85.8749649,-5.68434189e-14 L85.8749649,27.2499766 C87.3746368,27.3437061 88.9371075,27.4055675 90.4686475,27.5930265 L90.4686475,-5.68434189e-14 Z M81.9055207,26.93692 C77.7186241,26.6557316 73.5307901,26.4064111 69.250164,26.3117443 L69.250164,-5.68434189e-14 L73.9366389,-5.68434189e-14 L73.9366389,21.8745899 C76.6248008,21.9373887 79.3120255,22.1557784 81.9055207,22.2804387 L81.9055207,26.93692 Z M64.2496954,10.6561065 L64.2496954,15.3435186 L57.8442216,15.3435186 L57.8442216,25.9996251 L53.2186709,25.9996251 L53.2186709,-5.68434189e-14 L66.3436123,-5.68434189e-14 L66.3436123,4.68741213 L57.8442216,4.68741213 L57.8442216,10.6561065 L64.2496954,10.6561065 Z M45.3435186,4.68741213 L45.3435186,26.2498828 C43.7810479,26.2498828 42.1876465,26.2498828 40.6561065,26.3117443 L40.6561065,4.68741213 L35.8121661,4.68741213 L35.8121661,-5.68434189e-14 L50.2183897,-5.68434189e-14 L50.2183897,4.68741213 L45.3435186,4.68741213 Z M30.749836,15.5928391 C28.687787,15.5928391 26.2498828,15.5928391 24.4999531,15.6875059 L24.4999531,22.6562939 C27.2499766,22.4678976 30,22.2495079 32.7809542,22.1557784 L32.7809542,26.6557316 L19.812541,27.6876933 L19.812541,-5.68434189e-14 L32.7809542,-5.68434189e-14 L32.7809542,4.68741213 L24.4999531,4.68741213 L24.4999531,10.9991564 C26.3126816,10.9991564 29.0936358,10.9054269 30.749836,10.9054269 L30.749836,15.5928391 Z M4.78114163,12.9684132 L4.78114163,29.3429562 C3.09401069,29.5313525 1.59340144,29.7497422 0,30 L0,-5.68434189e-14 L4.4690224,-5.68434189e-14 L10.562377,17.0315868 L10.562377,-5.68434189e-14 L15.2497891,-5.68434189e-14 L15.2497891,28.061674 C13.5935889,28.3437998 11.906458,28.4375293 10.1246602,28.6868498 L4.78114163,12.9684132 Z"></path></g></svg>
            </div>
            <div class="signbox mx-auto">
              <h1>Sign In</h1>
              <div id="alertmsg"class="alertbox" <?php echo $display; ?>>
                <p><?php echo $loginMessage; ?></p>
              </div>
              <form id="loginForm" action="index.php" method="post" class="myform">
                <div class="input-container">
                  <input type="text" class="form-control" placeholder="" name="email" id="email">
                  <label>Email Or Mobile Number</label>                 
                </div>
                <p id="error" class="error"></p>
                 <p id="rates" class="rate">Message and data rates may apply</p>
                <div class="input-container password-container" id="passcontainer">
                  <input type="password" class="form-control" placeholder="" name="pass" id="pass">
                  <label for="">Password</label>

                  <svg id="hide" onclick="togglePass()" viewBox="0 0 16 16" width="16" height="16" data-icon="LanguagesSmall" data-icon-id=":R135daqd7al96:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img"><title>Hide Password</title><path fill="currentColor" fill-rule="evenodd" d="m 10.87 11.93 l 3.6 3.6 l 1.06 -1.06 l -14 -14 L 0.47 1.53 L 3.7 4.76 A 12 12 0 0 0 0.93 6.94 l -0.03 0.04 l -0.01 0.01 L 2 8 L 0.88 7 a 1.5 1.5 0 0 0 0 2 L 2 8 L 0.88 9 l 0.02 0.02 l 0.03 0.04 l 0.52 0.5 c 0.35 0.33 0.84 0.75 1.45 1.17 c 1.2 0.83 3 1.77 5.1 1.77 a 8 8 0 0 0 2.87 -0.57 M 9.7 10.75 Q 8.89 11 8 11 c -3.31 0 -6 -3 -6 -3 s 1.12 -1.25 2.8 -2.14 l 1.36 1.36 A 2 2 0 0 0 8 10 a 2 2 0 0 0 0.78 -0.16 Z m 4.86 -1.18 c -0.32 0.3 -0.78 0.69 -1.34 1.08 l -1.08 -1.08 C 13.28 8.8 14 8 14 8 l 1.12 1 l -0.02 0.02 l -0.03 0.04 Z M 14 8 l 1.12 -1 l -0.02 -0.02 l -0.03 -0.04 l -0.52 -0.5 a 13 13 0 0 0 -1.45 -1.17 c -1.2 -0.83 -3 -1.77 -5.1 -1.77 q -0.9 0.01 -1.73 0.2 l 1.3 1.32 L 8 5 c 3.31 0 6 3 6 3 m 0 0 l 1.12 -1 a 1.5 1.5 0 0 1 0 2 Z" clip-rule="evenodd"></path></svg>
                  <svg id="show" onclick="togglePass()" viewBox="0 0 16 16" width="16" height="16" data-icon="LanguagesSmall" data-icon-id=":R135daqd7al96:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img"><title>Show Password</title><path fill="currentColor" fill-rule="evenodd" d="m 14 8 l 1.12 1 a 1.5 1.5 0 0 0 0 -2 Z M 2 8 L 0.88 7 l 0.02 -0.02 l 0.03 -0.04 l 0.52 -0.5 c 0.35 -0.33 0.84 -0.75 1.45 -1.17 C 4.1 4.44 5.9 3.5 8 3.5 s 3.9 0.94 5.1 1.77 a 13 13 0 0 1 1.97 1.67 l 0.03 0.04 l 0.01 0.01 L 14 8 s -2.69 -3 -6 -3 s -6 3 -6 3 m 0 0 L 0.88 7 a 1.5 1.5 0 0 0 0 2 Z m 0 0 L 0.88 9 l 0.02 0.02 l 0.03 0.04 l 0.52 0.5 c 0.35 0.33 0.84 0.75 1.45 1.17 c 1.2 0.83 3 1.77 5.1 1.77 s 3.9 -0.94 5.1 -1.77 a 13 13 0 0 0 1.97 -1.67 l 0.03 -0.04 l 0.01 -0.01 L 14 8 s -2.69 3 -6 3 s -6 -3 -6 -3 m 6 2 a 2 2 0 1 0 0 -4 a 2 2 0 0 0 0 4" clip-rule="evenodd"></path></svg>
                </div>
                <p id="errorTwo" class="error"></p>
                
                <button class="btn btn-secondary w-100 redbtn" id="redbutton" name="submit">Sign In</button>
                <p class="or">OR</p>
                <button type="button" class="btn btn-secondary  w-100" onclick="signCode()" id="signincode">Use a sign-in code</button>
                <a href="#" class="forgot" id="forgotep">Forgot password?</a>
                <div>
                 <label for="rememberMe" class="check">Remember me
                   <input type="checkbox" name="" id="rememberMe" checked>
                   <span class="checkmark"></span>
                </label>
                </div>
                <div class="newsign">
                  <span>New to Netflix?</span><a href="#">Sign up now.</a>
                </div>  
                <p class="para">This page is protected by Google reCAPTCHA to ensure you're not a bot.</p>
                <a href="" class="learnmore">Learn more.</a>
              </form>
            </div>
        </div>
    </div>
    <div class="lowerPart">
      <div class="footer">
        <b>Questions? Call 000-800-919-1743 (Toll-Free)</b>

        <div class="row lists pt-2">
          <div class="col-md-3 col-6">
            <a href="#">FAQ</a>
          </div>
          <div class="col-md-3 col-6">
            <a href="#">Help Centre</a>
          </div>
          <div class="col-md-3 col-6">
            <a href="#">Terms of Use</a>
          </div>
          <div class="col-md-3 col-6">
            <a href="#">Privacy</a>
          </div>
          <div class="col-md-3 col-6">
            <a href="#">Cookie Preferences</a>
          </div>
          <div class="col-md-3 col-6">
            <a href="#">Corporate Information</a>
          </div>
        </div>
        <div class="lang">
          <svg viewBox="0 0 16 16" width="17" height="17" data-icon="LanguagesSmall" data-icon-id=":R135daqd7al96:" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" role="img"><path fill="currentColor" fill-rule="evenodd" d="M10.77 5.33 10.5 6 9.34 8.94l-.57 1.44L7.33 14h1.78l.73-1.97h3.58l.74 1.97H16l-3.43-8.67zm-.15 4.6-.24.63h2.51l-1.26-3.35zm-1.1-5.09.1-.19h-3.2V2h-1.5v2.65H.55V6h3.77A11 11 0 0 1 0 10.43c.33.28.81.8 1.05 1.16 1.5-.91 2.85-2.36 3.88-4.02v5.1h1.49V7.52q.6.95 1.33 1.8l.57-1.43a12 12 0 0 1-1.34-1.9h2.09z" clip-rule="evenodd"></path></svg>
        <select name="language" id="">
          <option value="English" selected>English</option>
          <option value="hindi">Hindi</option>
        </select>
        </div>

      </div>
    </div>
     <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>