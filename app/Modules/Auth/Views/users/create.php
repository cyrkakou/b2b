<!-- Modal-->
<div id="form_user_create" class="modal right fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form action="<?=base_url('auth/users/create'); ?>" class="validate" role="form"
                  enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                    <a href="javascript:;" class="modal-title h5"  data-dismiss="modal" aria-label="Close" title="Fermer">
                        <i class="ki ki-bold-arrow-back text-dark mr-3"></i><?= lang('Layout.form_add_caption'); ?>
                    </a>
                    <button type="submit" class="btn btn-sm btn-light-primary font-weight-bold ml-3"><?= lang('Layout.btn_save_caption'); ?></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="">
                        <div class="form-group">
                            <label class=" control-label">Rôle<span class="text-danger ml-2">*</span></label>
                            <div>
                                <?php
                                dropDown("SELECT role_id,role_name FROM users_roles WHERE role_code NOT IN ('root')",[
                                    'name'=>'role_id',
                                    'class'=>'form-control  select2-simple',
                                    'attr'=>'data-placeholder="choisir un role" data-rule-required="true"',
                                    'selected'=>@$record->role_id
                                ]);
                                ?>
                            </div>
                            <span class="form-text text-muted">Rôle de l'utilisateur</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Identifiant<span
                                        class="text-danger ml-2">*</span></label>
                            <div class="input-icon">
                                <span class="fad fa-user"></span>
                                <input name="user_login" class="form-control alphanum" type="text"
                                       data-validate="required,minlength[6]"/>
                            </div>
                            <span class="form-text text-muted">Identifiant de connexion</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nom à afficher publiquement<span class="text-danger ml-2">*</span></label>
                            <input name="user_nicename" minlength="8"
                                   class="form-control" type="text" data-validate="required"/>
                        </div>
                        <div>
                            <div class="form-group" data-attr="passwordstrength">
                                <label class="control-label">Mot de passe<span
                                            class="text-danger ml-2">*</span>
                                    <a href="javascript:;" class="text-success" data-action="password"
                                       data-field="user_password" title="générer un mot de passe">
                                        <i class="fad fa-cogs"></i></a>
                                </label>
                                <div class="input-icon">
                                    <input id="user_password1" name="user_password"
                                           data-progressbar="progressbar"
                                           class="form-control password_strength" type="password"
                                           data-validate="required,minlength[8]"/>
                                    <span>
                                            <a href="javascript:;" data-toggle="password" data-field="user_password">
                                                <i class="fad fa-eye-slash"></i>
                                            </a>
                                        </span>
                                </div>
                                <div class="progress mt-1">
                                    <div id="progressbar" class="progress-bar progress-bar-animated"  role="progressbar"></div>
                                </div>
                                <span class="form-text text-muted">Votre mot de passe</span>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Vérifier le mot de passe<span
                                            class="text-danger ml-2">*</span></label>
                                <input name="user_cpassword" class="form-control" type="password"
                                       data-validate="equalTo[#user_password1]" placeholder="Confirmation"/>
                                <span class="form-text text-muted">Confirmation du mot de passe</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Adresse électronique<span
                                        class="text-danger ml-2">*</span></label>
                            <div class="input-icon">
                                <input name="user_email" id="user_email_1" type="email" class="form-control"
                                       data-validate="required,email">
                                <span>
                        <a href="javascript:;" data-action="email" data-field="user_email_1"
                           title="générer une adresse fictive">
                            <i class="fad fa-envelope"></i>
                        </a>
                        </span>
                            </div>
                            <span class="form-text text-muted">Adresse électronique</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Téléphone OTP<span
                                        class="text-danger ml-2">*</span>
                            </label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">+<?= @$config->country_phone_code ?></span>
                                </div>
                                <input name="user_phone"
                                       class="form-control mask-phone-<?= strtolower(@$config->country_code) ?>"
                                       data-validate="required"
                                       type="text"/>
                            </div>
                            <span class="form-text text-muted">Numéro OTP</span>
                        </div>


                    </div>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
