<!-- begin:Modal-->
<div id="modal_activity_create" class="modal right fade" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form action="<?=base_url('settings/activities/create'); ?>" class="validate" role="form"
                  enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title mr-2"><?= lang('Layout.form_add_caption'); ?></h5>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-light btn-hover-primary" data-dismiss="modal">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
                <div class="modal-body pb-0 min-w-350px">
                    <div class="form-group">
                        <label class="control-label kt-font-bold">Libellé:<span
                                    class="text-danger ml-2">*</span></label>
                        <input name="name" class="form-control" type="text"
                               data-validate="required"/>
                        <span class="form-text text-muted">Nom du secteur d'activité</span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-light-primary font-weight-bold"><?= lang('Layout.btn_save_caption'); ?></button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!-- end:Modal-->