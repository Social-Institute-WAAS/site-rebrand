<!DOCTYPE html>
<html <?php language_attributes(); ?> >
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="title" content="">
        <meta name="url" content="">
        <meta name="author" content="">
        <meta name="robots" content="index,follow">
        <meta property="og:description" content="">
        <meta property="og:image" content="img/">
        <meta property="og:image:height" content="100">
        <meta property="og:image:type" content="image/jpg">
        <meta property="og:image:width" content="120">
        <meta property="og:title" content="">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <link href="img/favicon.png" rel="icon" type="image/vnd.microsoft.icon">
        <link href="img/favicon.png" rel="shortcut icon" type="image/vnd.microsoft.icon">
        <link href="img/favicon.png" rel="shortcut icon" type="image/x-icon">
        <link href="img/favicon.png" rel="image_src" type="image/jpeg">
        <!--link(rel="stylesheet", href!=`${page.url.static}css/fonts.css${page.version}`)-->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,900" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="css/app.min.css"> -->
        <?php wp_head(); ?>
    <head>
<body <?php body_class(); ?> id="site">
  
  <header>
    <nav class="c-nav navbar navbar-expand-lg navbar-dark fixed-top mb-4" id="navbar"><a class="navbar-brand c-nav__brand" href="/"> <span class="icon icon-waas" role="icon"></span></a>
      <button class="navbar-toggler c-nav__btn-toggle" id="js-btn-toggle" type="button" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="icon icon-bars" role="icon"></span></button>
      <div class="navbar-collapse c-nav__menu c-menu" id="navbarCollapse">
        <div class="c-menu__header">
          <div class="c-menu__header"><span class="icon icon-waas" role="icon"></span></div>
          <button class="c-menu__close"><span class="icon icon-close" role="icon"></span></button>
        </div>
          <!-- <li class="nav-item c-nav__item"><a class="nav-link c-nav__item-link" href="#">Sobre nos</a></li> -->
          <?php wp_nav_menu(
              array(
                'theme_location' => 'top-menu',
                'menu_class' => 'navbar-nav mr-auto c-nav__list',
                'link_class' => 'nav-link c-nav__item-link',
                'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
	              'walker'          => new WP_Bootstrap_Navwalker()
              )
            );
          ?>
          <ul class="navbar-nav c-nav__social">
            <li class="c-nav-item nav-item"><a class="nav-link c-nav__item-link" href="https://www.facebook.com/waas.ninja/" target="_blank"><span class="sr-only">Facebook</span><span class="icon icon-facebook"></span></a></li>
            <li class="c-nav-item nav-item"><a class="nav-link c-nav__item-link" href="https://www.instagram.com/waas.ninja/" target="_blank"><span class="sr-only" >Instagram</span><span class="icon icon-instagram"></span></a></li>
            <li class="c-nav-item nav-item"><a class="nav-link c-nav__item-link" href="https://www.linkedin.com/company/instituto-social-waas" target="_blank"><span class="sr-only">Linkedin</span><span class="icon icon-linkedin"></span></a></li>
          </ul>
      </div>
      <form class="c-search c-nav__search" method="post" target="_self" action="/" method="get"id="search_form">
        <button class="c-search--toggle" type="button"><span class="icon icon-search"></span></button>
        <div class="input-group input-group-lg c-search__wrapper">
          <input class="form-control c-search__input" type="text" name="s" placeholder="Search" aria-label="Search" value="<?php the_search_query();?>" />
          <div class="input-group-append c-search__append">
            <button class="btn py-1" type="submit"><span class="icon icon-search"></span><span class="sr-only">Buscar</span></button>
          </div>
        </div>
      </form>
    </nav>
  </header>
  <main class="container-fluid" role="main">