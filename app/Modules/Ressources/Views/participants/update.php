<!-- Modal-->
<div id="participant_update" class="modal fade" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form name="form" action="<?php base_url('')?>/ressources/participants/do_update"
                  method="POST"
                  role="form">
                <input name="code" type="hidden"/>
                <input name="status" value="1" type="hidden"/>

                <div class="modal-header">
                    <h5 class="modal-title">
					<span class="card-icon">
						<i class="fa fa-trash mr-2"></i>
					</span>
                        Valider la demande de participation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="media">
                        <div class="mr-3">
                            <i class="fad fa-check fa-4x  border-success text-success border-3 rounded-round p-3"></i>
                        </div>
                        <div class="media-body">
                            <div class="mt-4">
                                <p class=" text-dark">Vous &ecirc;tes sur le point de valider cette demande !
                                    <strong></strong>
                                    Est-ce r&eacute;ellement ce que vous souhaitez ?
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-light font-weight-bold" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary font-weight-bolder"><?= lang('Layout.btn_save_caption'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
