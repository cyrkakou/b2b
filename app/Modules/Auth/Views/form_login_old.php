<!--begin::Login-->
<div  id="kt_login" class="login login-4 login-signin-on d-flex flex-row-fluid">
    <div class="d-flex flex-center flex-row-fluid" >
        <div class="login-form text-center p-7 position-relative overflow-hidden rounded shadow p-10 p-lg-15 mx-5 bg-white">
            <!--begin::Login Header-->
            <div class="d-flex flex-center mb-15">
                <img src="<?=base_url('');?>/assets/media/logos/logo.png" class="img-fluid" alt="" />
            </div>
            <!--end::Login Header-->
            <!--begin::Login Sign in form-->
            <div class="login-signin">
                <div class="mb-10">
                    <h2 class="text-dark">Identifiez-vous !</h2>
                </div>
                <form class="form" id="kt_login_signin_form" method="post" autocomplete="off">
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="text" placeholder="Login" name="username" autocomplete="off" />
                    </div>
                    <div class="form-group mb-5">
                        <input class="form-control h-auto form-control-solid py-4 px-8" type="password" placeholder="Mot de passe" name="password" />
                    </div>
                    <button id="kt_login_signin_submit" class="btn btn-primary btn-block font-weight-bold px-9 py-4 my-3">Continuer</button>
                </form>

            </div>
            <!--end::Login Sign in form-->
        </div>
    </div>
</div>
<!--end::Login-->
