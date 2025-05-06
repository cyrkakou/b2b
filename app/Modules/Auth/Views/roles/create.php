<!-- begin:Modal-->
<div id="form_role_create" class="modal right fade" data-backdrop="static" tabindex="-1" role="dialog"
     aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <!--begin::Form-->
            <form action="<?=base_url('auth/roles/do_create'); ?>" class="validate" role="form"
                  enctype="multipart/form-data" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title mr-2"><?= lang('Layout.form_add_caption'); ?></h5>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-light btn-hover-primary" data-dismiss="modal">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </a>
                </div>
                <div class="modal-body pb-0 min-w-350px">
                    <div class="form-group">
                        <label class="control-label kt-font-bold">Code<span
                                    class="text-danger ml-2">*</span></label>
                        <input name="role_code" class="form-control alpha-code text-lowercase" type="text"
                               data-validate="required"/>
                        <span class="form-text text-muted">Code d'identification</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label kt-font-bold">Libellé<span
                                    class="text-danger ml-2">*</span></label>
                        <input name="role_name" class="form-control" type="text"
                               data-validate="required"/>
                        <span class="form-text text-muted">Libellé unique</span>
                    </div>
                    <div class="form-group">
                        <label class="control-label kt-font-bold">Description</label>
                        <textarea name="role_desc" class="form-control" rows="4"></textarea>
                        <span class="form-text text-muted">description du rôle</span>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Fermer
                    </button>
                    <button type="submit"
                            class="btn btn-light-primary font-weight-bold"><?= lang('Layout.btn_save_caption'); ?></button>
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!-- end:Modal-->
