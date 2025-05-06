<div class="card card-custom card-stretch">
    <div class="card-body">
        <div class="row justify-content-center px-8 px-md-0 px-lg-0 px-xl-40 py-0 py-lg-1 py-xl-20">
            <div class="col-md-9">
                <h3 class="text-dark font-weight-bold mb-6">Compte utilisateur</h3>
                <div class="form-group">
                    <label class="control-label font-weight-bold">Nom d'utilisateur:<span
                                class="text-danger ml-2">(*)</span></label>
                    <div class="">
                        <input name="user_login" value="<?= get_user_info('user_login') ?>" type="text"
                               disabled="disabled"
                               class="form-control"
                               data-validate="required">
                        <span class="form-text text-muted">Identifiant de connexion</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label font-weight-bold">Identifier:<span class="text-danger ml-2">(*)</span></label>
                    <div class="">
                        <input name="identifier" value="<?= get_user_info('identifier'); ?>" type="text"
                               disabled="disabled"
                               class="form-control"
                               data-validate="required">
                        <span class="form-text text-muted">Code transactionel</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label font-weight-bold">Téléphone OTP:<span
                                class="text-danger ml-2">(*)</span></label>
                    <div class="">
                        <div class="input-group">
                                        <span class="input-group-prepend">
                                            <span class="input-group-text">+<?= @$config->country_phone_code ?></span>
                                        </span>
                            <input name="user_phone"
                                   class="form-control field mask-phone-<?= strtolower(@$config->country_code) ?>"
                                   type="text" readonly
                                   value="<?= @$user->user_phone; ?>"/>
                        </div>
                        <span class="form-text text-muted">N° de téléphone de récupération</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label font-weight-bold">Email OTP:<span
                                class="text-danger ml-2">(*)</span></label>
                    <div class="">
                        <input name="user_email" value="<?= @$user->user_email; ?>" type="text"
                               class="form-control" readonly
                               data-validate="required">
                        <span class="form-text text-muted">email de récupération du compte</span>
                    </div>
                </div>
                <?php if (!empty($api_key)): ?>
                    <legend class="font-weight-semibold">Api</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Api Key:</label>
                                    <input value="<?= $api_key; ?>" type="text" placeholder="Api Key"
                                           class="form-control"
                                           readonly>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-3 d-md-flex align-items-center justify-content-center d-none">
                <span style="border-radius: 50%;width:10rem;height: 10rem" class="bg-light p-2 text-center">
                    <img src="<?= base_url('assets/media/icons/computer.png') ?>" alt="" class="img-fluid"
                         style="width:8rem;height: 8rem">
                </span>
            </div>
        </div>
    </div>
    <div class="card-footer bg-light d-flex justify-content-between hidden">
        <div></div>
        <button type="submit"
                class="btn btn-primary font-weight-bold"><?= lang('btn_save_caption'); ?></button>
    </div>
</div>
