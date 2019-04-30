<?php get_header();?>

    <section class="container">
      <div class="c-card c-card--cover">
      <?php if ( dynamic_sidebar('home-cover') ) : else : endif; ?>
      </div>
    </section>

		<?php //if ( dynamic_sidebar('home-cover') ) : else : endif; ?>
		<?php if ( dynamic_sidebar('how-we-do') ) : else : endif; ?>
    <?php if ( dynamic_sidebar('methodology') ) : else : endif; ?>
    
    <!-- GRADUATION SYSTEM -->
    <section class="l-section container c-grad">
        <h2 class="l-section__title" id="sistema-de-graduacao"><?php echo __('Graduation System', 'waas_theme') ?></h2>
        <div class="c-grad__display">
          <div class="card-deck">
            <?php if ( dynamic_sidebar('graduations') ) : else : endif; ?>
          </div>
        </div>
    </section>

    <!-- SERVICES -->
    <?php if ( is_active_sidebar('partners') ) : ?>
      <section class="l-section container">
          <h2 class="l-section__title" id="eventos"><?php echo __('Services', 'waas_theme') ?></h2>
          <div class="c-grad__display">
            <div class="card-deck">
              <?php dynamic_sidebar('services');  ?>
            </div>
          </div>
      </section> 
      <?php endif; ?>

    <!-- AWARDS -->
    <?php if ( is_active_sidebar('awards') ) : ?>
      <section class="l-section mb-4 container">
          <h2 class="l-section__title" id="premios"><?php echo __('Awards', 'waas_theme') ?></h2>
          <div class="card-deck justify-content-center">
            <?php dynamic_sidebar('awards'); ?>
          </div>
      </section>
    <?php endif; ?>

     <!-- PARTNERS -->
     <?php if ( is_active_sidebar('partners') ) : ?>
      <section class="l-section mb-4 container">
          <h2 class="l-section__title" id="premios"><?php echo __('Partners', 'waas_theme') ?></h2>
          <div class="card-deck justify-content-center">
            <?php dynamic_sidebar('partners'); ?>
          </div>
      </section>
    <?php endif; ?>


    <!-- DATAS -->
    <?php if ( is_active_sidebar('operations') ) : ?>
    <section class="l-section mb-4 container">
        <h2 class="l-section__title" id="operacao"><?php echo __('Operation', 'waas_theme') ?></h2>

    </section>
    <?php endif; ?>


    <!-- <section class="container">
        <div class="c-card c-card--cover" style="background-image:url(https://placeimg.com/480/480/any)">
          <h1 class="c-card__title w-25">Tecnologia Fortalecendo Jovens</h1>
        </div>
    </section>

    <section class="container">
        <div class="c-card c-card--section bullets">
          <h2 class="c-card__title text-center" id="como-fazemos">Como Fazemos</h2>
          <div class="c-card__body">
            <p>Lorem ipsum dolor sit amet, ...</p>
          </div>
        </div>
    </section> -->
		
		
<?php get_footer(); ?>