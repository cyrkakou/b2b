<form name="updateProfile" action="<?=base_url($module_base . 'do_personne_update') ?>" class="validate"
      method="post" autocomplete="off" enctype="multipart/form-data">
    <input name="personne_id" value="<?= @$personne->personne_id ?>" type="hidden"/>
    <div class="card card-custom card-stretch">
        <div class="card-body">
            <div class="row justify-content-center px-8 px-md-0 px-lg-0 px-xl-40 py-0 py-lg-1 py-xl-20">
                <div class="col-md-9">
                    <h3 class="text-dark font-weight-bold mb-6">Localisation</h3>
                    <div class="form-group">
                        <label class="form-label font-weight-bold">Ville:<span
                                    class="text-danger ml-2">(*)</span></label>
                        <div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Quartier<span
                                    class="text-danger ml-2">(*)</span>:</label>
                        <input value="<?= @$personne->quartier ?>" name="quartier"
                               class="form-control alphanum" type="text"
                               data-validate="required"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Rue:</label>
                        <input value="<?= @$personne->rue ?>" name="rue"
                               class="form-control alphanum" type="text"
                        />
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Adresse<span
                                    class="text-danger ml-2">(*)</span>:</label>
                        <input value="<?= @$personne->adresse ?>" name="adresse"
                               class="form-control alphanum" type="text"
                               data-validate="required"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Boite postale:</label>
                        <input value="<?= @$personne->boite_postale ?>" name="boite_postale"
                               class="form-control alphanum" type="text"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label font-weight-bold">Code postal:</label>
                        <input value="<?= @$personne->code_postal ?>" name="code_postal"
                               class="form-control alphanum" type="text"
                        />
                    </div>
                </div>
                <div class="col-md-3 d-md-flex align-items-center justify-content-center d-none">
                    <span style="border-radius: 50%;width:10rem;height: 10rem" class="bg-light p-2 text-center">
                        <img src="<?= base_url('assets/media/icons/signs.png') ?>" alt="" class="img-fluid"
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
