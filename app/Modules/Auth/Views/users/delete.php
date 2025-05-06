<!-- Modal-->
<div id="form_user_delete" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form name="form" action="<?=base_url('auth/users/delete'); ?>"
                  method="POST"
                  role="form">
                <input name="primary_key" value="" type="hidden"/>
                <div class="modal-header">
                    <h5 class="modal-title">
					<span class="card-icon">
						<i class="fa fa-trash mr-2"></i>
					</span>
                        <?= lang('Layout.form_delete_caption'); ?></h5>
                    <button type="button" class="btn btn-xs btn-icon btn-light btn-hover-primary" data-dismiss="modal" aria-label="Close">
                        <i class="ki ki-close icon-xs text-muted"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="media">
                        <div class="mr-3">
                            <i class="fad fa-trash fa-4x  border-danger text-danger border-3 rounded-round p-3"></i>
                        </div>
                        <div class="media-body">
                            <div class="mt-4">
                                <p class=" text-dark">Attention ! &ecirc;tes vous sur de vouloir supprimer l'enregistrement
                                    <strong></strong>
                                    la proc&eacute;dure est irr&eacute;versible, les donn&eacute;es seront perdues d&eacute;finitivement.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-light-danger font-weight-bold"><?= lang('Layout.btn_delete_caption'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
