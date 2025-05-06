<style>
    .titre1{
        color: #E94E1B;
        font-size: 25px;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 1.2em;
        letter-spacing: 0.4px;
    }
    .titre2{
        color: #088C09;
        font-size: 18px;
        font-weight: 500;
    }
    .sara_bg_green{
        background-color: #2E7F35;
    }
    .big .select2-container .select2-selection--single{
        height: 48px;
        border-width: 3px;
    }
    .big .select2-container .select2-selection--multiple{
        min-height: 48px;
        border-width: 3px;
    }
    .big .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 48px;
        font-size: 1.175rem !important;
    }

    .big .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px;
    }
    .big input[type="text"].form-control,
    .big input[type="text"].is-valid.form-control {
        height: 48px;
        font-size: 1.175rem !important;
        border-width: 3px !important;
    }
    .big input[type="email"].form-control,
    .big input[type="email"].is-valid.form-control {
        height: 48px;
        font-size: 1.175rem !important;
        border-width: 3px !important;
    }
    

</style>
<div class="separator separator-dashed  separator-warning my-5"></div>
<div class="card card-custom gutter-b shadow-none">
    <div class="d-flex justify-content-center">
        <span class="titre1 ">
            FORMULAIRE DE DEMANDE DE VISA
        </span>
    </div>
    <div class="card-body p-0">
        <form action="<?php _get_uri('');?>/ressources/participants/do_create" class="validate" role="form" method="POST" autocomplete="off">
            <div class="card-body big">

                <h3 class="font-size-lg font-weight-bold mb-6 titre2">1. LA SOCIÉTÉ</h3>
                <div class="mb-15">
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>Raison sociale / Institution :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Raison sociale / Institution " name="societe_raison_sociale" data-validate="required"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Secteur d’activité :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Secteur d’activité " name="societe_secteur_activité" data-validate="required"/>
                        </div>
                        <div class="col-lg-6">
                            <label>Pays :<span class="text-danger ml-2">*</span></label>
                            <div>
                                <?php dropDown("SELECT iso2,short_name FROM settings_pays", [
                                    'id' => 'societe_pays',
                                    'name' => 'societe_pays',
                                    'class' => 'form-control select2-with-search',
                                    'attr' => 'data-placeholder="Choisir un pays" data-validate="required" ',
                                    'selected' => ''
                                ]); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <h3 class="font-size-lg titre2 font-weight-bold mb-6">2. LE REPRÉSENTANT</h3>
                <div class="mb-15">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Nom :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Votre Nom" name="nom" data-validate="required"/>
                        </div>
                        <div class="col-lg-6">
                            <label>Prénoms :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Vos Prénoms" name="prenom" data-validate="required"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Numéro de Téléphone :<span class="text-danger ml-2">*</span></label>
                            <input type="tel" class="form-control" placeholder="Numéro de Téléphone" id="phone" name="phone" data-validate="required"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Fonction :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Fonction" name="fonction" data-validate="required"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Nationalité  :<span class="text-danger ml-2">*</span></label>
                            <div class="form-group-feedback form-group-feedback-right">
                                <div class="form-control-feedback"><i></i></div>
                                <div>
                                    <?php dropDown("SELECT iso2,short_name FROM settings_pays", [
                                        'id' => 'nationalite',
                                        'name' => 'nationalite',
                                        'class' => 'form-control select2-with-search',
                                        'attr' => 'data-placeholder="Choisir un pays" data-validate="required" ',
                                        'selected' => ''
                                    ]); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-lg-12">
                            <label>E-mail :<span class="text-danger ml-2">*</span></label>
                            <input type="email" class="form-control" placeholder="Adresse email" name="email" data-validate="required"/>
                        </div>
                    </div>
                </div>

                <h3 class="font-size-lg titre2 font-weight-bold mb-6">3. LE PASSEPORT</h3>
                <div class="mb-15">
                    <div class="form-group row">
                        <div class="col-lg-4">
                            <label>Numéro :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control text-uppercase" placeholder="Numéro de Passeport" name="passport_num" data-validate="required"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Date de délivrance :<span class="text-danger ml-2">*</span></label>
                            <input class="form-control" type="text" placeholder="Date de délivrance du passeport" id="passport_delivery" name="passport_delivery" data-validate="required"/>
                        </div>
                        <div class="col-lg-4">
                            <label>Date d'expiration :<span class="text-danger ml-2">*</span></label>
                            <input type="text" class="form-control" placeholder="Date d'expiration du passeport" id="passport_expire" name="passport_expire" data-validate="required"/>
                        </div>
                    </div>
                </div>

                <h3 class="font-size-lg titre2 font-weight-bold mb-6">4. AUTRES</h3>
                <div class="mb-15">
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Type de participant :<span class="text-danger ml-2">*</span></label>
                                <div class="radio-inline">
                                    <label class="radio radio-lg radio-info">
                                        <input type="radio" name="type_participant" value="Exposant" checked="checked">
                                        <span></span> Exposant
                                    </label>
                                    <label class="radio radio-lg radio-info">
                                        <input type="radio" name="type_participant" value="Sponsor">
                                        <span></span> Sponsor
                                    </label>
                                    <label class="radio radio-lg radio-info">
                                        <input type="radio" name="type_participant" value="Professionnel non exposant">
                                        <span></span> Professionnel non exposant
                                    </label>
                                </div>
                                <span class="form-text text-muted">Veuillez choisir un type</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class=" control-label">Membre d'une délégation ?<span class="text-danger ml-2">*</span></label>
                                <div class="radio-inline">
                                    <label class="radio radio-lg radio-success">
                                        <input type="radio" name="is_membre" value="1">
                                        <span></span> Oui
                                    </label>
                                    <label class="radio radio-lg radio-warning">
                                        <input type="radio" name="is_membre" value="0" checked="checked">
                                        <span></span> Non
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer border-0">
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg sara_bg_green text-white font-weight-bolder">Envoyer</button>
                </div>
            </div>
        </form>
    </div>
</div>