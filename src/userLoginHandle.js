import './libs/userRegister';
((w, $)=> {
  'use strict';
  const { settings, lang } = A1AM_PHP_DATA;

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
    const $loginMessage = $('.a1am-login-container .a1am-login-message')

    $loginForm.on('submit', async function(e) {
      e.preventDefault();
      let formData = new FormData(e.target);
      formData.append('action', 'a1am_user_login_ajax');

      const res = await fetch(A1AM_PHP_DATA.ajax_url, {
        body: formData,
        method: 'POST',
      }).then(r => r.json())

      if(res?.errors) {
        $loginMessage.empty();
        Object.values(res.errors).forEach((messageHtml, __i_index) => {
          $loginMessage.append(`<div class="a1a-message __type-error">
            <div class="message-inner">${ messageHtml }</div>  
            <span class="__close" onClick="javascript: this.parentElement.remove()" title="remove">✕</span>
          </div>`);
        })
        return;
      }

      if(res?.ID) {
        $loginMessage.empty();
        $loginMessage.append(`<div class="a1a-message __type-success">
          <div class="message-inner">${ lang.login_successful }</div>  
          <span class="__close" onClick="javascript: this.parentElement.remove()" title="remove">✕</span>
        </div>`)
        setTimeout(() => {
          window.location.href = settings.a1a_after_login_redirect_page?.url
        }, 2000)
      }
      
      return;
    })
  }

  $(() => {
    LoginFormSwitch_Handle();
    UserLogin_Handle();
  })

})(window, jQuery)