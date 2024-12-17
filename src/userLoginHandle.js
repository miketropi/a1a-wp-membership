((w, $)=> {
  'use strict';

  const LoginFormSwitch_Handle = () => {
    $('.a1am-login-container').on('click', '.a1a1-switch-user-login-form .button', function(e) {
      e.preventDefault();
      const $btn = $(this);
      const activeForm = $btn.data('active-form');
      // console.log(activeForm);
      $btn.addClass('__active').siblings().removeClass('__active');
      $(`.a1am-login-forms ${ activeForm }`).addClass('__active').siblings().removeClass('__active');
    })
  }

  const UserLogin_Handle = () => {
    const $loginForm = $('.a1am-login-forms form#loginform');

    $loginForm.on('submit', async function(e) {
      e.preventDefault();
      let formData = new FormData(e.target);
      formData.append('action', 'a1am_user_login_ajax');

      const res = await fetch(A1AM_PHP_DATA.ajax_url, {
        body: formData,
        method: 'POST',
      }).then(res => res.json())

      if(res?.errors) {
        
        return;
      }
      console.log(res);
    })
  }

  $(() => {
    LoginFormSwitch_Handle();
    UserLogin_Handle();
  })

})(window, jQuery)