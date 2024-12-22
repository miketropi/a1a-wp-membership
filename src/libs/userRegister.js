((w, $) => {
  'use strict';
  const { ajax_url, settings, lang } = A1AM_PHP_DATA;

  const userRegister_Handle = () => {
    const $registerForm = $('form#a1am-user-register-form');
    const $loginMessage = $('.a1am-login-container .a1am-login-message');

    $registerForm.on('submit', async function(e) {
      e.preventDefault();
      let formData = new FormData(e.target);
      formData.append('action', 'a1am_user_register_ajax');

      const res = await fetch(ajax_url, {
        body: formData,
        method: 'POST',
      }).then(r => r.json())

      console.log(res);

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
    })
  }
  
  $(() => {
    userRegister_Handle();
  })
})(window, jQuery)