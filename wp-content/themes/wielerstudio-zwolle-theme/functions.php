<?php 

// $update_url = '';
// update_option('siteurl', $update_url );
// update_option('home', $update_url );


register_nav_menu('main', 'The main menu');

add_theme_support('post-thumbnails');




if(!(is_admin()))
{
	wp_enqueue_script('jquery');
};


function widgets_init() {
    register_sidebar( array(
        'name'          => 'Message Box',
        'id'            => 'message_box',
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );
}

add_action( 'widgets_init', 'widgets_init' );



/*
 * Meta box 05: flipped
 */
 
 function add_flipped_box() {

    $screens = array( 'post');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'flipped_sectionid',
            __( 'Flipped', 'myplugin_textdomain' ),
            'flipped_box',
            $screen
        );
    }
}


add_action( 'add_meta_boxes', 'add_flipped_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function flipped_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'flipped_box', 'flipped_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, 'flipped', true );

    echo '<label for="flipped">';
    _e( 'Kaartje omgedraaid of niet<br>', 'myplugin_textdomain' );
    echo '</label>';
    echo '<input type="checkbox" ' . $value . ' id="flipped" name="flipped" value="checked">'; ?>
    
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function flipped( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['flipped_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['flipped_nonce'], 'flipped_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    // if ( ! isset( $_POST['flipped'] ) ) {
        // return;
    // }

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['flipped'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'flipped', $my_data );
}
add_action( 'save_post', 'flipped' );


/*
 * Meta box 06: tweezijdig afbeelding
 */
 
 function add_double_box() {

    $screens = array( 'post');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'double_sectionid',
            __( 'Double', 'myplugin_textdomain' ),
            'double_box',
            $screen
        );
    }
}


add_action( 'add_meta_boxes', 'add_double_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function double_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'double_box', 'double_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, 'double', true );

    echo '<label for="double">';
    _e( 'Full-screen image op de achterkant van het kaartje (plaats dan alleen die afbeelding in het tekstvak)<br>', 'myplugin_textdomain' );
    echo '</label>';
    echo '<input type="checkbox" ' . $value . ' id="double" name="double" value="checked">'; ?>
    
    <?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function double( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['double_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['double_nonce'], 'double_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */

    // Sanitize user input.
    $my_data = sanitize_text_field( $_POST['double'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'double', $my_data );
}
add_action( 'save_post', 'double' );





/*
 * Meta box 02 & 03: links
 */

 function add_links_box() {

    $screens = array( 'post');

    foreach ( $screens as $screen ) {

        add_meta_box(
            'links_sectionid',
            __( 'links', 'myplugin_textdomain' ),
            'links_box',
            $screen
        );
    }
}


add_action( 'add_meta_boxes', 'add_links_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function links_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'links_box', 'links_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $linkappearance = get_post_meta( $post->ID, 'link_appearance', true );
	$externallink = get_post_meta( $post->ID, 'external_link', true );

    echo '<label for="link_appearance">';
    _e( 'Hier de link beschrijving', 'myplugin_textdomain' );
    echo '</label><br /> ';
    echo '<input type="text" id="link_appearance" name="link_appearance" value="' . esc_attr( $linkappearance ) . '" size="25" />'; 
    
	echo "<br /><br />";
    echo '<label for="external_link">';
    _e( 'Hier de externe link', 'myplugin_textdomain' );
    echo '</label><br /> ';
    echo '<input type="text" id="external_link" name="external_link" value="' . esc_attr( $externallink ) . '" size="25" />'; 
    
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function links( $post_id ) {

    /*
     * We need to verify this came from our screen and with proper authorization,
     * because the save_post action can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['links_nonce'] ) ) {
        return;
    }

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['links_nonce'], 'links_box' ) ) {
        return;
    }

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Check the user's permissions.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, it's safe for us to save the data now. */
    
    // Make sure that it is set.
    if ( ! isset( $_POST['link_appearance'] ) ) {
        return;
    }

    // Sanitize user input.
    $link_appearance = sanitize_text_field( $_POST['link_appearance'] );
	$external_link = sanitize_text_field( $_POST['external_link'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'link_appearance', $link_appearance );
	update_post_meta( $post_id, 'external_link', $external_link );
}
add_action( 'save_post', 'links' );


