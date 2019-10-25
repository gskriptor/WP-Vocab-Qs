<?php

function value_generator() {
  global $wpdb;
  $lastUserID = $wpdb->get_results( "SELECT MAX(ID)  FROM {$wpdb->prefix}users", ARRAY_A);
  function generatePass($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  $username = 'quizStudent'.$lastUserID;
  $email = $username.'@onestoneapparel.com';
  $password = generatePass().$lastUserID;
  echo '
    <input type="hidden" name="username" value="' . ( isset( $_POST['username'] ) ? $username : null ) . '">
    <input type="hidden" name="password" value="' . ( isset( $_POST['password'] ) ? $password : null ) . '">
    <input type="hidden" name="email" value="' . ( isset( $_POST['email']) ? $email : null ) . '">
  ';
}

function skip_btn_form($username, $password, $email) {

  echo '
    <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">';

      value_generator();

      echo'<input class="btn" type="submit" name="submit" value="Skip"/>
    </form>
  ';
}

function complete_registration() {
    global $reg_errors, $username, $password, $email;
    if ( 1 > count( $reg_errors->get_error_messages() ) ) {
        $userdata = array(
        'user_login'    =>   $username,
        'user_email'    =>   $email,
        'user_pass'     =>   $password
        );
        $user = wp_insert_user( $userdata );
        echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
    }
}

function custom_registration() {
    if ( isset($_POST['submit'] ) ) {
        registration_validation(
        $_POST['username'],
        $_POST['password'],
        $_POST['email']
        );

        // sanitize user form input
        global $username, $password, $email;
        $username   =   sanitize_user( $_POST['username'] );
        $password   =   esc_attr( $_POST['password'] );
        $email      =   sanitize_email( $_POST['email'] );

        // call @function complete_registration to create the user
        // only when no WP_error is found
        complete_registration(
        $username,
        $password,
        $email
        );
    }

    skip_btn_form(
        $username,
        $password,
        $email
        );
}

// The callback function that will replace [book]
function custom_registration_shortcode() {
    ob_start();
    custom_registration();
    return ob_get_clean();
}

// Register a new shortcode: [cr_custom_registration]
add_shortcode( 'skip_reg', 'custom_registration_shortcode' );

 ?>
