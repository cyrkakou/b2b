"use strict";

// Class Definition
var KTLogin = function() {
    var _login;

    var _showForm = function(form) {
        var cls = 'login-' + form + '-on';
        var form = 'kt_login_' + form + '_form';

        _login.removeClass('login-forgot-on');
        _login.removeClass('login-signin-on');
        _login.removeClass('login-signup-on');

        _login.addClass(cls);

        KTUtil.animateClass(KTUtil.getById(form), 'animate__animated animate__backInUp');
    }

    var _handleSignInForm = function() {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_signin_form'),
			{
				fields: {
					username: {
						validators: {
							notEmpty: {
								message: ' '
							}
						}
					},
					password: {
						validators: {
							notEmpty: {
								message: ' '
							}
						}
					},
					pin: {
						validators: {
							notEmpty: {
								message: ' '
							}
						}
					}
				},
				plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();
            var spinner = "spinner spinner-white spinner-right"
			var btn = $(this);

            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					btn.addClass(spinner).attr('disabled', true);
					axios.post(BASE_URL + '/api/auth/login',{
						username: $('#kt_login_signin_form [name="username"]').val(),
						password: $('#kt_login_signin_form [name="password"]').val(),
						pin: $('#kt_login_signin_form [name="pin"]').val(),
					})
						.then(function (response) {
							console.log(response.data);
							// handle success
							if (response.data.status == 'success') {
								location.href = BASE_URL + '/dashboard'

							}else{
								setTimeout(function () {
									btn.removeClass(spinner).attr('disabled', false);
									swal.fire({
										text: response.data.message,
										icon: response.data.status,
										buttonsStyling: false,
										confirmButtonText: "Ok",
										customClass: {
											confirmButton: "btn btn-wide font-weight-bold btn-light-danger"
										}
									}).then(function() {
										KTUtil.scrollTop();
									});
								}, 2000);
							}

						})
						.catch(function (error) {
							btn.addClass(spinner).attr('disabled', true);
							// handle error
							console.log(error);
						})
				}
		    });
        });

        // Handle forgot button
        $('#kt_login_forgot').on('click', function (e) {
            e.preventDefault();
            _showForm('forgot');
        });

        // Handle signup
        $('#kt_login_signup').on('click', function (e) {
            e.preventDefault();
            _showForm('signup');
        });
    }

    var _handleSignUpForm = function(e) {
        var validation;
        var form = KTUtil.getById('kt_login_signup_form');

        validation = FormValidation.formValidation(
			form,
			{
				fields: {
					fullname: {
						validators: {
							notEmpty: {
								message: 'Username is required'
							}
						}
					},
					email: {
                        validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					},
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    },
                    cpassword: {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation is required'
                            },
                            identical: {
                                compare: function() {
                                    return form.querySelector('[name="password"]').value;
                                },
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    agree: {
                        validators: {
                            notEmpty: {
                                message: 'You must accept the terms and conditions'
                            }
                        }
                    },
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        $('#kt_login_signup_submit').on('click', function (e) {
			let the = $(this)
            e.preventDefault();
            validation.validate().then(function(status) {
		        if (status == 'Valid') {
					the.parents('form').submit()
				} else {
					swal.fire({
		                text: "Sorry, looks like there are some errors detected, please try again.",
		                icon: "error",
		                buttonsStyling: false,
		                confirmButtonText: "Ok, got it!",
                        customClass: {
    						confirmButton: "btn font-weight-bold btn-light-primary"
    					}
		            }).then(function() {
						KTUtil.scrollTop();
					});
				}
		    });
        });
        // Handle cancel button
        $('#kt_login_signup_cancel').on('click', function (e) {
            e.preventDefault();
            _showForm('signin');
        });
    }

    var _handleForgotForm = function(e) {
        var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
			KTUtil.getById('kt_login_forgot_form'),
			{
				fields: {
					email: {
						validators: {
							notEmpty: {
								message: 'Email address is required'
							},
                            emailAddress: {
								message: 'The value is not a valid email address'
							}
						}
					}
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
		);

        // Handle submit button
        $('#kt_login_forgot_submit').on('click', function (e) {
            e.preventDefault();
            validation.validate().then(function(status) {
				var spinner = "spinner spinner-white spinner-right"
				var btn = $(this);

				validation.validate().then(function(status) {
					if (status == 'Valid') {
						btn.addClass(spinner).attr('disabled', true);
						axios.post(BASE_URL + 'auth/ajaxPasswordRecover',{
							email: $('#kt_login_forgot_form [name="email"]').val(),
						})
							.then(function (response) {
								// handle success
								if (response.data.statut == 'success') {
									swal.fire({
										title: "Vérifiez votre email",
										text: response.data.message,
										icon: response.data.statut,
										buttonsStyling: false,
										confirmButtonText: "Ok",
										customClass: {
											confirmButton: "btn btn-lg font-weight-bold btn-light-success"
										}
									})
								}else{
									setTimeout(function () {
										btn.removeClass(spinner).attr('disabled', false);
										swal.fire({
											title: "Attention !",
											text: response.data.message,
											icon: response.data.statut,
											buttonsStyling: false,
											confirmButtonText: "Ok",
											customClass: {
												confirmButton: "btn btn-lg font-weight-bold btn-light-danger"
											}
										}).then(function() {
											KTUtil.scrollTop();
										});
									}, 2000);
								}

							})
							.catch(function (error) {
								// handle error
								console.log(error);
							})
					}
				});
		    });
        });

        // Handle cancel button
        $('#kt_login_forgot_cancel').on('click', function (e) {
            e.preventDefault();

            _showForm('signin');
        });
    }

    // Public Functions
    return {
        // public functions
        init: function() {
            _login = $('#kt_login');
			$('.integer').numeric('integer');
            _handleSignInForm();
            _handleSignUpForm();
            _handleForgotForm();
        }
    };
}();

// Class Initialization
jQuery(document).ready(function() {
    KTLogin.init();
});
