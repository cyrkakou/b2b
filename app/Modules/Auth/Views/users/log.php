<?php include_once('help.php');?>
<form action="<?=base_url($module_base.'deleteForm')?>" method="POST">
    <div class="card card-custom gutter-b">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-history"></i>
                </span>
                <h3 class="card-label">
                    Historique des connexions - <span><?=count(@$datagrid)?></span>
                </h3>
            </div>
            <div class="card-toolbar">
                <a href="javascript:;" data-toggle="modal"
                   data-target="#form_history_empty"
                   data-user_id="<?=$user_id?>"
                   class="btn btn-danger font-weight-bolder font-size-sm">
                    <i class="fad fa-trash mr-2"></i>Vider
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <!--begin: Datatable -->
            <table id="DT_log"
                   class="table table-head-custom table-head-bg  table-vertical-center rounded-0 datagrid">
                <thead>
                <tr>
                    <th class="w1">#</th>
                    <th class="w1"> Connexion </th>
                    <th class="w1 no-sort"> Adresse IP </th>
                    <th class="w1 no-sort"> Device </th>
                    <th class="no-sort"> Navigateur </th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array(@$datagrid)):?>
                    <?php foreach($datagrid as $rows):?>
                        <tr>
                            <td nowrap=""><?=$rows->history_id?></td>
                            <td nowrap="" data-order="<?=$rows->history_id?>"><?=gmdate('d/m/Y h:i',$rows->timestamp)?></td>
                            <td nowrap=""><?=$rows->ip_adress?></td>
                            <td nowrap=""><?=$rows->device?></td>
                            <td><?=$rows->user_agent?></td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</form>