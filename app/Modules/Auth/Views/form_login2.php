<div id="kt_login" class="login login-4 login-signin-on d-flex flex-row-fluid" >
    <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
         style="background-image: url('<?=base_url()?>/assets/media/bg/bg-3.jpg');">
        <div class="login-form text-center p-7 position-relative overflow-hidden">
            <!--begin::Login Header-->
            <div class="d-flex flex-center mb-15">
                <a href="#">
                    <img src="<?=base_url()?>/assets/media/logos/logo-letter-13.png" class="max-h-75px" alt="">
                </a>
            </div>
            <!--end::Login Header-->
            <!--begin::Login Sign in form-->
            <div class="login-signin">
                <div class="mb-20">
                    <h2>Se connecter</h2>
                </div>
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_signin_form"
                      novalidate="novalidate">
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <select class="form-control h-auto form-control-solid py-4 px-8 select2-simple" name="helper">
                            <option value="">Choisir un rôle</option>
                            <option value="assureur1|assureur1">Assureur</option>
                            <option value="hopital1|hopital1">Hopital</option>
                            <option value="docteur1|docteur1">Docteur</option>
                            <option value="pharmacie1|pharmacie1">Pharmacie</option>
                            <option value="patient1|patient1">Patient</option>
                            <option value="administrateur|administrateur">Admin</option>
                        </select>
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text"
                               placeholder="Email/Numéro de téléphone" name="username" autocomplete="off">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password"
                               placeholder="Password" name="password">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <button id="kt_login_signin_submit" class="btn btn-pill btn-primary font-weight-bolder text-uppercase px-9 py-4 my-3 mx-4">
                        Continuer
                    </button>
                    <div class="form-group d-flex flex-wrap justify-content-center align-items-center my-4">
                        <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Mot de passe
                            oublié ?</a>
                    </div>
                    <input type="hidden">
                    <div></div>
                </form>
                <div class="mt-10">
                    <span class="opacity-70 mr-4">Pas encore membre ?</span>
                    <a href="javascript:;" id="kt_login_signup" class="text-muted text-hover-primary font-weight-bold">Créer votre compte</a>
                </div>
            </div>
            <!--end::Login Sign in form-->
            <!--begin::Login Sign up form-->
            <div class="login-signup">
                <div class="mb-10">
                    <h2>Créer un compte</h2>
                    <div class="text-muted font-weight-bold">Saisissez vos informations pour créer votre compte</div>
                </div>
                <form id="kt_login_signup_form" method="post" class="form fv-plugins-bootstrap fv-plugins-framework" action="<?=base_url('auth/signup')?>" autocomplete="off">
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Nom complet" name="fullname">
                        <div class="fv-plugins-message-container"></div></div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Adresse electronique" name="email" autocomplete="off">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Numéro de telephone" name="telephone" autocomplete="off">
                        <div class="fv-plugins-message-container"></div>
                    </div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Mot de passe" name="password">
                        <div class="fv-plugins-message-container"></div></div>
                    <div class="form-group mb-5 fv-plugins-icon-container">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Confirmer mot de passe" name="cpassword">
                        <div class="fv-plugins-message-container"></div></div>
                    <div class="form-group mb-5 text-left fv-plugins-icon-container">
                        <div class="checkbox-inline">
                            <label class="checkbox m-0">
                                <input type="checkbox" name="agree">
                                <span></span>J'accepte les termes
                                <a href="javascript:;" class="font-weight-bold ml-1">les termes et conditions</a>.</label>
                        </div>
                        <div class="form-text text-muted text-center"></div>
                        <div class="fv-plugins-message-container"></div></div>
                    <div class="form-group d-flex flex-wrap justify-content-between mt-10">
                        <button id="kt_login_signup_submit" class="btn btn-pill btn-primary font-weight-bolder px-9 py-4 my-3 mx-2">Continuer</button>
                        <button id="kt_login_signup_cancel" class="btn btn-pill btn-light-primary font-weight-bolder px-9 py-4 my-3 mx-2">Annuler</button>
                    </div>
                    <div></div></form>
            </div>
            <!--end::Login Sign up form-->
            <!--begin::Login forgot password form-->
            <div class="login-forgot">
                <div class="mb-10">
                    <h2>Mot de passe oublié ?</h2>
                    <div class="text-muted font-weight-bold">Entrer votre adresse email pour récupérer votre mot de passe</div>
                </div>
                <form class="form fv-plugins-bootstrap fv-plugins-framework" id="kt_login_forgot_form">
                    <div class="form-group mb-10 fv-plugins-icon-container">
                        <input class="form-control form-control-solid h-auto py-4 px-8" type="text" placeholder="Email" name="email" autocomplete="off">
                        <div class="fv-plugins-message-container"></div></div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button id="kt_login_forgot_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Request</button>
                        <button id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel</button>
                    </div>
                    <div></div></form>
            </div>
            <!--end::Login forgot password form-->
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('[name="helper"]').on('change',function(){
            let args = $(this).val().split('|')
            $(this).closest('form').find('[name="username"]').val(args[0])
            $(this).closest('form').find('[name="password"]').val(args[1])
        })
    })
</script>
