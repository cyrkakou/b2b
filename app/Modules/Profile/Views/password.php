<form  name="updateProfile" action="<?=base_url($module_base . 'do_user_update/') ?>" class="validate" method="post" autocomplete="off">
    <div class="card card-custom card-stretch">
        <div class="card-body">
            <div class="row justify-content-center px-8 px-md-0 px-lg-0 px-xl-40 py-0 py-lg-1 py-xl-20">
                <div class="col-md-9">
                    <h3 class="text-dark font-weight-bold mb-6">Changement de mot de passe</h3>
                    <div class="form-group " data-attr="passwordstrength">
                        <label class="form-label">Mot de passe:<span class="text-danger ml-2">(*)</span>
                            <a href="javascript:;" class="text-success" data-action="password"
                               data-field="user_pwd" title="générer un mot de passe">
                                <i class="fa fa-cogs"></i></a></label>
                        <div class="">
                            <div class="input-icon">
                                <input id="user_pwd" name="user_pwd"
                                       data-progressbar="progressbar"
                                       class="form-control password_strength" type="password"
                                       data-validate="required,,minlength[8]"/>

                                <a href="javascript:;" data-toggle="password" data-field="user_pwd"
                                   class="kt-input-icon__icon kt-input-icon__icon--left">
                                    <span><i class="fa fa-eye-slash"></i></span>
                                </a>
                            </div>
                            <div class="progress mt-1">
                                <div id="progressbar" class="progress-bar progress-bar-animated"></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label class="form-label">Confirmer:<span class="text-danger ml-2">(*)</span></label>
                        <div class="">
                            <input id="user_cpassword" name="user_cpassword" class="form-control" type="password"
                                   data-validate="equalTo[#user_pwd]" placeholder="Confirmation"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-md-flex align-items-center justify-content-center d-none">
                    <span style="border-radius: 50%;width:10rem;height: 10rem" class="bg-light p-2 text-center">
                        <img src="<?= base_url('assets/media/icons/security.png') ?>" alt="" class="img-fluid"
                             style="width:8rem;height: 8rem">
                    </span>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light d-flex justify-content-between">
            <div></div>
            <button type="submit"
                    class="btn btn-primary font-weight-bold"><?= lang('btn_save_caption'); ?></button>
        </div>
    </div>
</form>
