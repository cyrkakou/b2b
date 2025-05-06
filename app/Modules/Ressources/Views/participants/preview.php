<!-- Modal-->
<div id="participant_preview" class="modal right fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <!--begin::Form-->
            <div class="modal-header">
                <h5 class="modal-title font-weight-bolder">Aperçu demande de participation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body min-w-350px">
                <div class="form-group">
                    <label class="control-label font-weight-bold">Code de la demande</label>
                    <input name="code"  disabled class="form-control" type="text"/>
                </div>
                <div class="form-group">
                    <label class="control-label font-weight-bold">Raison sociale</label>
                    <input name="societe_raison_sociale"  disabled class="form-control" type="text"/>
                </div>
                <div class="row">
                    <div class="form-group col-8">
                        <label class="control-label font-weight-bold">Secteur d'activité</label>
                        <input name="societe_secteur_activité"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="form-group col-4">
                        <label class="control-label font-weight-bold">Pays</label>
                        <input name="societe_pays"  disabled class="form-control" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="control-label font-weight-bold">Nom </label>
                        <input name="nom"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-6">
                        <label class="control-label font-weight-bold">Prénoms </label>
                        <input name="prenom"  disabled class="form-control" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-5">
                        <label class="control-label font-weight-bold">Téléphone</label>
                        <input name="phone"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4">
                        <label class="control-label font-weight-bold">Fonction</label>
                        <input name="fonction"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-3">
                        <label class="control-label font-weight-bold">Nationalité</label>
                        <input name="nationalite"  disabled class="form-control" type="text"/>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4">
                        <label class="control-label font-weight-bold">Numéro de passeport</label>
                        <input name="passport_num"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4">
                        <label class="control-label font-weight-bold">Date de délivrance du passeport</label>
                        <input name="passport_delivery"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4">
                        <label class="control-label font-weight-bold">Date d'expiration du passeport</label>
                        <input name="passport_expire"  disabled class="form-control" type="text"/>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label class="control-label font-weight-bold">Type de participant </label>
                        <input name="type_participant"  disabled class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-6">
                        <label class="control-label font-weight-bold">Membre d'une délégation ? </label>
                        <input name="is_membre"  disabled class="form-control" type="text"/>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-between border-0">
                <button type="button" class="btn btn-light font-weight-bolder" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>
