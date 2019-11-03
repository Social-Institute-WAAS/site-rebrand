<?php get_header();?>

    <section class="container">
      <div class="c-card c-card--cover">
      <?php if ( dynamic_sidebar('home-cover') ) : else : endif; ?>
      </div>
    </section>

		<?php //if ( dynamic_sidebar('home-cover') ) : else : endif; ?>
		<?php if ( dynamic_sidebar('why-we-do') ) : else : endif; ?>
    <?php if ( dynamic_sidebar('how-we-do') ) : else : endif; ?>

    <!-- SERVICES -->
      <?php if ( is_active_sidebar('partners') ) : ?>
      <section class="l-section container my-4" id="o-que-fazemos">
          <h2 class="l-section__title" >O que fazemos?</h2>
          <div class="c-grad__display">
            <div class="card-deck">
              <?php dynamic_sidebar('services');  ?>
            </div>
          </div>
      </section> 
      <?php endif; ?>

    <!-- GRADUATION SYSTEM -->
    <section class="l-section container c-grad my-4">
        <h2 class="l-section__title" id="sistema-de-graduacao">Sistema de Graduação</h2>
        <div class="c-grad__display">
          <div class="card-deck">
            <?php if ( dynamic_sidebar('graduations') ) : else : endif; ?>
          </div>
        </div>
    </section>

    <!-- AWARDS -->
    <?php if ( is_active_sidebar('awards') ) : ?>
      <section class="l-section my-4 container">
          <h2 class="l-section__title" id="premios">Prêmios</h2>
          <div class="row d-flex justify-content-center">
            <?php dynamic_sidebar('awards'); ?>
          </div>
      </section>
    <?php endif; ?>

     <!-- PARTNERS -->
     <?php if ( is_active_sidebar('partners') ) : ?>
      <section class="l-section my-4 pb-4 container">
          <h2 class="l-section__title" id="parceiros">Parceiros</h2>
          <div class="row d-flex justify-content-center">
            <?php dynamic_sidebar('partners'); ?>
          </div>
      </section>
    <?php endif; ?>

    <!-- DATAS -->
    <?php if ( is_active_sidebar('operations') ) : ?>
    <section class="l-section my-4 pb-4 container">
        <h2 class="l-section__title" id="impacto-social">Impacto Social</h2>
          <div class="c-card__body h-100">
            <div class="card-deck justify-content-center">
              <?php dynamic_sidebar('operations'); ?>
            </div>
          </div>
    </section>
    <?php endif; ?>

    <!-- MIDIA -->
    <?php if ( is_active_sidebar('media') ) : ?>
    <section class="container my-4 pb-4">
        <div class="c-card c-card--section mb-4 px-0 bullets bullets--red">
          <h2 class="c-card__title mb-4 text-center" id="imprensa">Imprensa</h2>
          <div class="c-card__body h-100">
            <div class="card-deck justify-content-center">
              <?php dynamic_sidebar('media'); ?>
            </div>
          </div>
        </div>
      </section>
      <?php endif; ?>
		
		
<?php get_footer(); ?>