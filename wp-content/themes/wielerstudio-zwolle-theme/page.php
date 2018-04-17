<?php get_header(); ?>

<div class="pagewrap">
    <div class="single-page">
    <?php if(have_posts()): while(have_posts()) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
                <div class="page-footer">
                    <a href="<?php echo get_bloginfo('home'); ?>" target="_self">
                        Terug naar Home
                    </a>
                </div>
                           
    <?php endwhile; endif; ?>
    </div>
</div>

<?php get_footer(); ?>