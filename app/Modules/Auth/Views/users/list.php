<?php include_once('help.php');?>
<form action="<?=base_url('auth/users/deleteForm')?>" method="POST">
    <div class="card card-custom gutter-b bordered">
        <div class="card-header">
            <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-database"></i>
                </span>
                <h3 class="card-label">
                    Liste des utilisateurs - <span class="DT_users_count"></span>
                </h3>
            </div>
            <div class="card-toolbar">
                <?php if(user_can('create')):?>
                    <a href="javascript:;" data-toggle="modal" data-target="#form_user_create"
                       class="btn btn-light-primary font-weight-bolder font-size-sm mr-3 ">
                        <i class="far fa-plus"></i>
                        Nouveau
                    </a>
                <?php endif;?>
                <?php if(user_can('delete')):?>
                    <button name="CMB_DELETE" if-multiple="true" class="btn btn-light-danger btn-sm font-weight-bolder font-size-sm d-none">
                        <i class="far fa-trash"></i>
                        <?=lang('btn_delete_caption');?>
                    </button>
                <?php endif;?>
            </div>
        </div>
        <div class="card-body p-0">
            <!--begin: Datatable -->
            <table id="DT_users" data-url="<?=url('auth/users/fetch_users') ?>"
                   class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr>
                    <th class="no-sort" style="width: 1%;">
                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-danger checkbox-single ">
                            <input type="checkbox" value="" class="group-checkable" data-action="all">
                            <span></span>
                        </label>
                    </th>
                    <th> Login </th>
                    <th> Nom Complet </th>
                    <th> Telephone </th>
                    <th style="width: 1%"> Date </th>
                    <th style="width: 1%" class="text-center"> Status </th>
                    <th style="width: 1%" class="text-left"> Rôles </th>
                    <th style="width: 1%;" class="no-sort text-center"> <i class="fa fa-arrow-down"></i></th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
            <!--end: Datatable -->
        </div>
    </div>
</form>
