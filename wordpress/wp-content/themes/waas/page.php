<?php get_header();?>

    <?php if (have_posts()) : while(have_posts()) : the_post(); ?>
        <?php if ( waas_theme_can_show_post_thumbnail() ) : ?>
            <section class="container">
                <div class="c-card c-card--cover bullets--orange c-card--cover--orange">
                    <h1 class="c-card__title w-100 text-center text-white"><?php the_title(); ?></h1>
                    <div class="textwidget">
                        <figure>
                            <?php  
                                echo '<img src="'. get_the_post_thumbnail_url(get_the_ID(),'full').'">';
                            ?>
                        </figure>
                    </div>
                </div>
            </section>
        <?php endif;?>
        <section class="l-section container pb-4">
        <?php if ( ! waas_theme_can_show_post_thumbnail() ) : ?>
            <h1 class="l-section__title justify-content-start"><?php the_title(); ?></h1>
        <?php endif;?>
        <?php 
                the_content();
            ?>
        </section>
        <?php endwhile; endif; ?>

    </div>

<?php get_footer(); ?>