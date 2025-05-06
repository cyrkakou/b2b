<form name="updateProfile" action="<?=base_url($module_base . 'do_personne_update') ?>" class="validate"
      method="post" autocomplete="off" enctype="multipart/form-data">
    <input name="personne_id" value="<?= @$personne->personne_id ?>" type="hidden"/>
    <div class="card card-custom card-stretch">
        <div class="card-body">
            <div class="row justify-content-center px-8 px-md-0 px-lg-0 px-xl-40 py-0 py-lg-1 py-xl-20">
                <div class="col-md-9">
                    <h3 class="text-dark font-weight-bold mb-6">Contact</h3>
                    <div class="kt-section">
                        <div class="form-group">
                            <label class=" form-label">Téléphone Mobile:<span
                                        class="text-danger ml-2">(*)</span></label>
                            <div class="">
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <span class="input-group-text">+<?= @$config->country_phone_code ?></span>
                                    </span>
                                    <input name="telephone_1"
                                           class="form-control field mask-phone-<?= strtolower(@$config->country_code) ?>"
                                           type="text" data-validate="required"
                                           value="<?= @$personne->telephone_1 ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Téléphone Fixe:<span
                                        class="text-danger ml-2">(*)</span></label>
                            <div class="">
                                <div class="input-group">
<span class="input-group-prepend">
<span class="input-group-text">+<?= @$config->country_phone_code ?></span>
</span>
                                    <input name="telephone_2"
                                           class="form-control field mask-phone-<?= strtolower(@$config->country_code) ?>"
                                           type="text" data-validate="required"
                                           value="<?= @$personne->telephone_2 ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Adresse électronique:<span
                                        class="text-danger ml-2">(*)</span></label>
                            <div class="input-icon">
                                <input name="email" id="email" type="email" class="form-control"
                                       value="<?= @$personne->email ?>"
                                       data-validate="required,email">
                                <a href="javascript:" data-action="email" data-field="email"
                                   title="générer une adresse fictive">
                                    <span><i class="fad fa-envelope icon-md"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-md-flex align-items-center justify-content-center d-none">
                    <span style="border-radius: 50%;width:10rem;height: 10rem" class="bg-light p-2 text-center">
                        <img src="<?= base_url('assets/media/icons/technology.png') ?>" alt="" class="img-fluid"
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
