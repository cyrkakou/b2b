<!--begin::Login-->
<div  id="kt_login" class="login login-4 login-signin-on d-flex flex-row-fluid">
    <!--begin::Aside-->
    <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
            <!--begin::Content-->
            <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                <!--begin::Logo-->
                <a href="../../demo1/dist/index.html" class="py-9 mb-5">
                    <img alt="Logo" src="<?=base_url('');?>/assets/media/logos/logo.png" class="h-60px" />
                </a>
                <!--end::Logo-->
                <!--begin::Title-->
                <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;"></h1>
                <!--end::Title-->
                <!--begin::Description-->
                <h3 class="fw-bold fs-2" style="color: #986923;">Salon  international de l’Agriculture et des Ressources Animales</h3>
                <!--end::Description-->
            </div>
            <!--end::Content-->
            <!--begin::Illustration-->
            <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/sketchy-1/13.png"></div>
            <!--end::Illustration-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Aside-->
    <div class="d-flex flex-center flex-row-fluid" >
        <div class="login-form text-center p-7 position-relative overflow-hidden rounded shadow p-10 p-lg-15 mx-5 bg-white">
            <!--begin::Login Header-->
<!--            <div class="d-flex flex-center mb-15">-->
<!--                <img src="--><?php //=base_url('');?><!--/assets/media/logos/logo.png" class="img-fluid" alt="" />-->
<!--            </div>-->
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
