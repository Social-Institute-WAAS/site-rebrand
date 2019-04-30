<?php get_header();?>

    <section class="container">
        <div class="c-card c-card--cover" style="background-image:url(https://placeimg.com/480/480/any)">
          <h1 class="c-card__title w-25">Tecnologia Fortalecendo Jovens</h1>
        </div>
    </section>

    <div class="container" >
        <h1><?php the_title(); ?></h1>

        <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
        
            <?php the_content();?>

        <?php endwhile; endif; ?>

    </div>

<?php get_footer(); ?>