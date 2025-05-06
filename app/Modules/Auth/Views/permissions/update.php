<!-- Modal-->
<div id="form_permission_update" class="modal right fade" data-backdrop="static" tabindex="-1" permission="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog" permission="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form action="<?=base_url('auth/permissions/do_update'); ?>" class="validate" role="form"
                  enctype="multipart/form-data" method="POST">
                <input name="permission_id" type="hidden" />
                <div class="modal-header">
                    <h5 class="modal-title mr-3"><?= lang('Layout.form_update_caption'); ?></h5>
                    <button type="button" class="btn btn-xs btn-icon btn-light btn-hover-primary" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close icon-xs text-muted"></i>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div class="">
                        <div class="form-group">
                            <label class="control-label kt-font-bold">Code<span class="text-danger ml-2">*</span></label>
                            <input name="permission_code" class="form-control form-control-solid alpha-code text-lowercase" type="text"
                                   data-validate="required" readonly/>
                            <span class="form-text text-muted">Code d'identification</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label kt-font-bold">Libellé<span
                                    class="text-danger ml-2">*</span></label>
                            <input name="permission_name" class="form-control" type="text"
                                   data-validate="required"/>
                            <span class="form-text text-muted">Libellé unique</span>
                        </div>
                        <div class="form-group">
                            <label class="control-label kt-font-bold">Description</label>
                            <textarea name="permission_desc" class="form-control" rows="4"></textarea>
                            <span class="form-text text-muted">description</span>
                        </div>
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
