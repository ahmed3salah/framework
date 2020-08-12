<!DOCTYPE html>
<html lang="ar" dir='rtl'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo Config('WEBSITE_NAME'); ?> | Login</title>
    <link rel= "stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity= "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin= "anonymous" > 
    <script src= "https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity= "sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin= "anonymous" ></script>
    <script src= "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity= "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin= "anonymous" ></script>
    <script src= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity= "sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin= "anonymous" ></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js" integrity="sha512-M+hXwltZ3+0nFQJiVke7pqXY7VdtWW2jVG31zrml+eteTP7im25FdwtLhIBTWkaHRQyPrhO2uy8glLMHZzhFog==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css" integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA==" crossorigin="anonymous" />

</head>
<style>
    .form-signin{
        width: 100%;
        max-width: 30vw;
        padding: 15px;
        margin: 0 auto;
    }
</style>
<body>
    
    
    <!-- Header -->
    <?php View('layout/header') ?>
    <!-- Body -->

    <form action="<?php echo Route('login_process') ?>" class="form-signin mt-4" method='POST'>
      <h1 class="h3 mb-3 font-weight-normal">من فضلك قم بتسجيل الدخول</h1>
      <label for="input-username" class="sr-only"><?php echo Lang('login.username') ?></label>
      <input type="username" id="input-username" name="username" class="form-control my-2" required="" autofocus="">
      <label for="inputPassword" class="sr-only"><?php echo Lang('login.password') ?></label>
      <input type="password" id="inputPassword" name="password" class="form-control my-2" required="">
      <div class="checkbox mb-3">
      </div>
      <button class="btn btn-lg btn-primary btn-block my-2" name="submit" type="submit"><?php echo Lang('login.login')?></button>
    </form>

    <!-- Footer -->
    <?php View('layout/footer') ?>


</body>
</html>