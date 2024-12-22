<?php 
/**
 * Hooks 
 */

add_action( 'a1am:user_register_hook', 'a1am_user_register_send_verification_email', 20, 1 );