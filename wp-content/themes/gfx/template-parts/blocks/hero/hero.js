(function ($) {
    var registerAffiliate = $('section#register-affiliate');
    var switchToLoginFormBtn = $('.switch-to-login-form');
    var switchToRegisterFormBtn = $('.switch-to-register-form');

    if (switchToLoginFormBtn.length && registerAffiliate.length) {
        switchToLoginFormBtn.on('click', function () {
            switchForm('register');
        });

        switchToRegisterFormBtn.on('click', function () {
            switchForm('login');
        });

        function switchForm(hideForm) {
            var registerForm = registerAffiliate.find('form#affwp-register-form');
            var loginForm = registerAffiliate.find('form#affwp-login-form');

            if (registerForm.length && loginForm.length) {
                switch (hideForm) {
                    case 'register' :
                        registerForm.hide();
                        loginForm.show();

                        var registerErrors = registerForm.prev('.affwp-errors');
                        if (registerErrors.length) {
                            registerErrors.remove();
                        }

                        break;
                    case 'login' :
                        loginForm.hide();
                        registerForm.show();

                        var loginErrors = loginForm.prev('.affwp-errors');
                        if (loginErrors.length) {
                            loginErrors.remove();
                        }

                        break;
                }
            }
        }
    }

    $(document).on('ready', function () {
        var affWpErrors = $('.affwp-errors');
        if (affWpErrors.length) {
            var forms = $('form.affwp-form');
            var form = affWpErrors.next('form');

            if (forms.length && form.length) {
                forms.hide();
                form.show();
            }

            var top = affWpErrors.offset().top;
            $('body,html').animate({scrollTop: top - 100}, 0);
        }
    });
})(jQuery);