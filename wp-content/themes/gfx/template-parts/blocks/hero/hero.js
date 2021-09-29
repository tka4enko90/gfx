(function ($) {
    var switchToLoginFormBtn = $('.switch-to-login-form');
    var registerAffiliate = $('section#register-affiliate');
    if (switchToLoginFormBtn.length && registerAffiliate.length) {
        switchToLoginFormBtn.on('click', function () {
            var registerForm = registerAffiliate.find('form#affwp-register-form');
            var loginForm = registerAffiliate.find('form#affwp-login-form');

            if (registerForm.length && loginForm.length) {
                registerForm.hide();
                loginForm.show();
            }
        });
    }
})(jQuery);