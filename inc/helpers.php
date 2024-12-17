<?php 

function a1am_membership_dashboard() {
  if(is_user_logged_in()) {
    a1am_membership_dashboard_template();
  } else {
    a1am_login_form_template();
  }
}