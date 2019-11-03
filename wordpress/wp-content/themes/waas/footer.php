
</main>
    <footer class="footer l-footer" style="margin-top: 2.5em">
      <div class="container">
        <div class="row d-flex justify-content-around flex-wrap flex-column flex-sm-column flex-md-row my-4">

        <?php if ( is_active_sidebar('footer-contact') ) : ?>
          <div class="order-sm-1 pt-4 text-center text-sm-left">
            <h5 class="l-footer__title"> Fale com a gente</h5>
            <?php dynamic_sidebar('footer-contact');  ?>
          </div> 
          <?php endif; ?>

          
          <div class="order-sm-2 pt-4 text-center text-sm-left">
            <h5 class="l-footer__title"><?php echo __('Menu', 'waas_theme') ?></h5>
            <?php wp_nav_menu(
                array(
                  'theme_location' => 'top-menu',
                  'menu_class' => 'list-unstyled quick-links',
                  'link_class' => '',
                  'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                  'walker'          => new WP_Bootstrap_Navwalker()
                )
              );
            ?>
          </div>

          <div class="order-sm-3 pt-4 text-center text-sm-left">
            <h5 class="l-footer__title"><?php echo __('Social', 'waas_theme') ?></h5>
              <?php wp_nav_menu(
                array(
                  'theme_location' => 'footer-social',
                  'menu_class' => 'list-unstyled quick-links',
                  'link_class' => '',
                  'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                  'walker'          => new WP_Bootstrap_Navwalker()
                )
              );
            ?>
            
          </div>

          <div class="order-sm-0 order-md-4 pt-4 text-center">
            <span class="icon icon-waas-complete text-muted" style="font-size: 8rem"></span>
            <p class="pt-3">Tecnologia Fortalecendo Jovens</p>
          </div>


        </div>
        <div class="row text-center">
          <p class="w-100 col-12 text-center">Copyright 2019 Instituto Social WAAS </p>
        </div>
      </div>
    </footer>

    <?php wp_footer();?>

  </body>
</html>