export default {
    /**
     * Handle recaptcha integration using Google Recaptcha V3
    * {@link https://developers.google.com/recaptcha/docs/v3}
     */
    execute () {
        return new Promise(function (resolve) {
          grecaptcha.ready(function() {
              grecaptcha.execute(window._trial_form.captchaSiteKey, {action: 'submit'}).then(function(token) {
                  resolve(token);
              })
          })
        })
    }
}
