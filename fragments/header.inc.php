<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?php echo 'Welcome to TWONE Studios'; ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="<?php echo URL; ?>public/img/favicon.png" rel="icon">
  <link href="<?php echo URL; ?>public/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="<?php echo URL; ?>public/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="<?php echo URL; ?>public/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/libs/animate/animate.min.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/libs/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
  <link href="<?php echo URL; ?>public/css/mystyle.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Regna
    Theme URL: https://bootstrapmade.com/regna-bootstrap-onepage-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body>

  <!--==========================
  Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
      <!--
        <a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>
      -->
        <!-- Uncomment below if you prefer to use a text logo -->
        <h1><a href="<?php echo URL; ?>index">BLOG</a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="<?php echo URL; ?>index">Home</a></li>
          <?php
          if($login === true) {
          ?>
            <li><a href="<?php echo URL; ?>dashboard">Dashboard</a></li>
          <?php
          } else {
          ?>
          <li><a href="<?php echo URL; ?>login">Login</a></li>
          <?php
          }
          ?>
            <li class="menu-has-children"><a href="">Categories</a>
              <ul>
                <li><a href="<?php echo URL ?>index/posts/1">Web Development</a></li>
                <li class="menu-has-children"><a href="#">Mobile App Design</a>
                  <ul>
                    <li><a href="<?php echo URL ?>index/posts/5">IOS</a></li>
                    <li><a href="<?php echo URL ?>index/posts/6">Android</a></li>
                    <li><a href="<?php echo URL ?>index/posts/7">Misc</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo URL ?>index/posts/2">Mobile App Designs</a></li>
                <li><a href="<?php echo URL ?>index/posts/3">Graphic Designs</a></li>
                <li><a href="<?php echo URL ?>index/posts/4">SEO</a></li>
              </ul>
            </li>

            <li><a href="<?php echo URL; ?>archive">Archives</a></li>
          <li><a href="<?php echo URL; ?>about">About Us</a></li>
          <li><a href="<?php echo URL; ?>contact">Contact Us</a></li>
          <?php
          if ($login === true) {
          ?>
          <li><a href="<?php echo URL; ?>logout">Logout</a></li>
          <?php
          }
          ?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->