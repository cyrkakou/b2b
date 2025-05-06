<?php #include_once('help.php');?>
<form name="frmStrategie"  method="POST" action="<?=base_url('auth/strategies');?>">
    <div class="card card-custom gutter-b card-custom card-shadowless">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-shield-check"></i>
                </span>
                <h3 class="card-label">
                    Strategies de sécurité
                </h3>
            </div>
            <div class="card-toolbar">
                <button type="submit" class="btn btn-light-primary font-weight-bold"><i class="far fa-save mr-1"></i>Enregister</button>
            </div>
        </div>
        <div class="card-body">
            <!--begin::Accordion-->
            <div id="tblStrategie" class="accordion accordion-solid accordion-toggle-plus">
                <?php foreach($roles as $r):?>
                    <div class="card">
                        <div class="card-header" id="heading_<?=$r->role_id?>">
                            <div class="card-title collapsed text-uppercase" data-toggle="collapse" data-target="#collapse_<?=$r->role_id?>">
                                <i class="fad fa-user-cog"></i> <?=$r->role_name?>
                            </div>
                        </div>
                        <div id="collapse_<?=$r->role_id?>" class="collapse" aria-labelledby="heading_<?=$r->role_id?>" data-parent="#tblStrategie" style="">
                            <div class="card-body p-0">
                                <table class="table table-head-custom table-vertical-center mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 20px">
                                            <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-primary checkbox-single">
                                                <input type="checkbox" class="checkbox" disabled />
                                                <span></span>
                                            </label>
                                        </th>
                                        <th class="text-left text-uppercase"> Composants </th>
                                        <?php foreach($permissions as $p):?>
                                            <th class="text-center text-uppercase" style="width: 1%"> <?=$p->permission_name?> </th>
                                        <?php endforeach;?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($components as $c):?>
                                        <tr>
                                            <td title="cocher la ligne" class="text-center">
                                                <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-danger checkbox-single">
                                                    <input type="checkbox" value="" class="checkRow">
                                                    <span></span>
                                                </label>
                                            </td>
                                            <td class="text-left text-uppercase text-dark-75 font-weight-bolder text-hover-primary mb-1"><?=$c->component_name?></td>
                                            <?php foreach($permissions as $p):?>
                                                <td class="text-center">
                                                    <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-primary checkbox-single">
                                                        <input name="selected[<?=$r->role_id?>][<?=$c->component_id?>][<?=$p->permission_id?>]"
                                                               type="checkbox" class="checkbox"
                                                               <?php if(@$strategies[$c->component_id][$r->role_id][$p->permission_id]==1):?>checked="checked"<?php endif;?>
                                                               value="1"/>
                                                        <span></span>
                                                    </label>
                                                </td>
                                            <?php endforeach;?>
                                        </tr>
                                    <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <!--end::Accordion-->
        </div>
    </div>

</form>
