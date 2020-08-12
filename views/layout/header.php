<?php use App\Account; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php

echo Route('home') ?>" ><?php echo Config('WEBSITE_NAME') ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo Route('home') ?>">الرئيسية <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo Lang('navbar.services') ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="<?php echo Route('results') ?>"><?php echo Lang('results') ?></a>
          <a class="dropdown-item" href="<?php echo Route('news') ?>">آخر الاخبار</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo Route('about') ?>">عنا</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo Route('contact-us') ?>">أتصل بنا</a>
      </li>
    </ul>

    <?php
      if(! Account::IsLogged()){
        echo "<a class='btn btn-outline-success my-2 my-sm-0' href='".Route('login')."'>تسجيل الدخول</a>";
      }else{
        echo "<a class='btn btn-outline-success my-2 my-sm-0' href='".Route('logout')."'>تسجيل الخروج</a>";
      }
    ?>

    

  </div>
</nav>