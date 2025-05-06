<!-- Modal-->
<div id="form_user_update" class="modal right fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form action="<?=base_url('auth/users/update'); ?>" class="validate" role="form"
                  enctype="multipart/form-data" method="POST">
                <input name="primary_key" value="" type="hidden"/>
                <div class="modal-header">
                    <a href="javascript:;" class="modal-title h5"  data-dismiss="modal" >
                        <i class="ki ki-bold-arrow-back text-dark mr-3"></i>
                        <?= lang('Layout.form_update_caption'); ?></a>
                    <button type="submit" class="btn btn-sm btn-light-primary font-weight-bold ml-3"><?= lang('Layout.btn_save_caption'); ?></button>
                </div>
                <div class="modal-body pb-0">
                    <div class="">
                        <div class="form-group">
                            <label class=" control-label">Rôle<span class="text-danger ml-2">*</span></label>
                            <div>
                                <?php
                                if(get_user_info('role_code')!='root'):
                                    $SQL = "SELECT role_id,role_name FROM users_roles WHERE role_code NOT IN ('root')";
                                else:
                                    $SQL = "SELECT role_id,role_name FROM users_roles";
                                endif;
                                dropDown($SQL,[
                                    'name'=>'role_id',
                                    'id'=>"role_id",
                                    'class'=>'form-control select2-simple',
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
                                <span class="far fa-user"></span>
                                <input id="user_login" name="user_login" class="form-control alphanum" type="text"
                                       data-validate="required,minlength[6]" readonly/>
                            </div>
                            <span class="form-text text-muted">Identifiant de connexion</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Nom à afficher publiquement<span class="text-danger ml-2">*</span></label>
                            <input name="user_nicename" minlength="8"
                                   class="form-control" type="text" data-validate="required"/>
                        </div>
                        <div class="form-group" data-attr="passwordstrength">
                            <label class="control-label">Mot de passe<span
                                        class="text-danger ml-2">*</span>
                                <a href="javascript:;" class="text-success" data-action="password"
                                   data-field="user_password" title="générer un mot de passe">
                                    <i class="fa fa-cogs"></i></a>
                            </label>
                            <div class="input-icon">
                                <input id="user_password" name="user_password"
                                       data-progressbar="progressbar"
                                       class="form-control password_strength" type="password"
                                       data-validate="minlength[8]"/>
                                <span>
                                            <a href="javascript:;" data-toggle="password" data-field="user_password">
                                                <i class="fa fa-eye-slash"></i>
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
                            <input id="user_cpassword" name="user_cpassword" class="form-control" type="password"
                                   data-validate="equalTo[#user_password]" placeholder="Confirmation"/>
                            <span class="form-text text-muted">Confirmation du mot de passe</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Adresse électronique<span
                                        class="text-danger ml-2">*</span></label>
                            <div class="input-icon">
                                <input name="user_email" id="user_email" type="email" class="form-control"
                                       data-validate="required,email">
                                <span>
                        <a href="javascript:;" data-action="email" data-field="user_email"
                           title="générer une adresse fictive">
                            <i class="far fa-envelope"></i>
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
