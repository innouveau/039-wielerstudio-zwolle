<?php 
/*
 * 	Template Name: Home
 */?>
 
<?php get_header(); ?>

<div class="pagewrap">
    <?php include('php/message-box.php'); ?>
    <div class="grid">
    <?php
        $i = 0;
        $q = new WP_Query('category_name=block');
        if($q->have_posts()): while($q->have_posts()): $q->the_post();
            $title = get_the_title();
            $thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 5600,1000 ), false, '' );
            $link = get_post_meta($post->ID, 'external_link', true);
            $flipped = get_post_meta($post->ID, 'flipped', true);
            $double = get_post_meta($post->ID, 'double', true);
            if ($flipped == 'checked') {
                $status = ' flipped';
            } else {
                $status = '';
            }
            $i++;
    ?>

            <div class="grid-item grid-item-<?php echo $i; echo $status; ?>">
                <div class="grid-item-content">
                    <div class="item-rotor">
                        <div class="rotor-front">
                            <div class="rotor-front-img" style="background-image:url(<?php echo $thumbnail[0]; ?>)"></div>
                            <div class="rotor-front-txt">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>                     
                        <?php if ($double) { ?>
                        <div class="rotor-back full-screen">
                            <div class="rotor-back-container">
                                <?php the_content(); ?>
                            </div>
                         </div>
                        <?php } else { ?>
                        <div class="rotor-back">
                            <div class="rotor-back-container">
                                <?php if ($title) { ?>
                                    <h3>
                                        <?php echo $title; ?>
                                    </h3>
                                <?php } ?>
                                <div class="rotor-back-txt">
                                     <?php the_content(); ?>
                                </div>
                                <?php
                                    if ($link != '') {
                                        $link_text = get_post_meta($post->ID, 'link_appearance', true);
                                        if ($link_text == '') {
                                           $link_text = 'Lees verder';
                                        }
                                        echo '<div class="outer-link"><a class="a-outer-link" href="javascript:wireLink(\'' . $link . '\')">' . $link_text . '</a></div>';
                                    } 
                                ?>
                            </div>
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        <?php
            endwhile;
            endif;
        ?>
        <div class="grid-item grid-item--placeholder"></div>
        <div class="grid-item grid-item--placeholder"></div>
    </div>
</div>

<script>
    function wireLink(url) {
        var domain = '<?php echo get_bloginfo('home'); ?>';
        if (url.indexOf(domain) > -1) {
            window.open(url,'_self');
        } else {
            window.open(url,'_blank');
        }
    }

</script>

<?php get_footer(); ?>