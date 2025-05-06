<?php
$picture = (empty(@$personne->photo))?base_url('assets/media/users/blank.png'):base_url($personne->photo);
?>
<form name="updateProfile" action="<?=base_url($module_base . 'do_personne_update') ?>" class="validate"
      method="post" autocomplete="off" enctype="multipart/form-data">
    <input name="personne_id" value="<?= @$personne->personne_id ?>" type="hidden"/>
    <div class="card card-custom card-stretch">
        <div class="card-body">
            <div class="row justify-content-center px-8 px-md-0 px-lg-0 px-xl-40 py-0 py-lg-1 py-xl-20">
                    <div class="col-md-9">
                        <h3 class="text-dark font-weight-bold mb-6">Profil</h3>
                        <div>
                            <div class="image-input image-input-empty image-input-outline mb-4" id="kt_image_5" style="background-image: url(<?=@$picture?>)">
                                <div class="image-input-wrapper"></div>
                                <label class="btn btn-xs btn-icon btn-primary " data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                    <i class="fad fa-pen icon-sm"></i>
                                    <input type="file" name="photo" accept="image/*"/>
                                    <input type="hidden" name="profile_avatar_remove"/>
                                </label>
                                <span class="btn btn-xs btn-icon btn-danger" data-action="cancel" data-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki ki-bold-close icon-xs"></i>
                                </span>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Genre:<span
                                            class="text-danger ml-2">(*)</span></label>
                                <div class="">
                                    <?php
                                    dropDown('SELECT genre_code, genre_libelle FROM settings_genre', [
                                        'name' => 'genre',
                                        'class' => 'form-control select2-simple',
                                        'attr' => 'data-placeholder ="Civilité" data-validate="required"',
                                        'selected' => @$personne->genre
                                    ]); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nom:<span class="text-danger ml-2">(*)</span></label>
                                <div class="">
                                    <input name="nom" value="<?= @$personne->nom ?>" type="text"
                                           class="form-control"
                                           data-validate="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Prénoms:<span class="text-danger ml-2">(*)</span></label>
                                <div class="">
                                    <input name="prenoms" value="<?= @$personne->prenoms ?>" type="text"
                                           class="form-control"
                                           data-validate="required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Anniversaire:</label>
                                <div class="">
                                    <input name="naissance_date" value="<?= mysql_to_date(@$personne->naissance_date) ?>"
                                           type="text" class="form-control mask-date"
                                    />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Profession:</label>
                                <div class="">
                                    <input name="profession" value="<?= (@$personne->profession) ?>"
                                           type="text" class="form-control"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 d-md-flex align-items-center justify-content-center d-none">
                    <span style="border-radius: 50%;width:10rem;height: 10rem" class="bg-light p-2 text-center ">
                        <img src="<?= base_url('assets/media/icons/id-card.png') ?>" alt="" class="img-fluid"
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
