<div class="card card-custom gutter-b bordered">
    <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-database"></i>
                </span>
            <h3 class="card-label">
                Liste des rôles - (<?= count($datagrid) ?>)
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" data-toggle="modal" data-target="#form_role_create"
               class="btn btn-light-primary font-weight-bolder">
                <i class="far fa-plus"></i>
                Nouveau
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <!--begin: Datatable -->
        <table class="table table-sm table-head-custom table-head-bg table-vertical-center rounded-0 datagrid">
            <thead>
            <tr>
                <th class="no-sort" style="width: 1%;">
                    <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-danger checkbox-single">
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
                </th>
                <th style="width: 1%"> Id</th>
                <th> Code</th>
                <th> Libell&eacute;</th>
                <th> Description</th>
                <th style="width: 1%;" class="no-sort text-center"> Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if (count(@$datagrid) > 0): ?>
                <?php foreach ($datagrid as $rows): ?>
                    <tr>
                        <td>
                            <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-primary checkbox-single">
                                <input name="selected[]" value="<?= $rows->role_id ?>" type="checkbox" value="" class="checkable">
                                <span></span>
                            </label>
                        </td>
                        <td><?= $rows->role_id ?></td>
                        <td><?= $rows->role_code ?></td>
                        <td><?= $rows->role_name ?></td>
                        <td><?= $rows->role_desc ?></td>
                        <td nowrap class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#form_role_update"
                               data-role_id="<?=@$rows->role_id?>"
                               class="btn btn-icon btn-sm btn-light-warning"><i class="far fa-pencil"></i>
                            </a>
                            <a href="javascript:;" data-toggle="modal" data-target="#form_role_delete"
                               data-role_id="<?=@$rows->role_id?>"
                               class="btn btn-icon btn-sm btn-light-danger">
                                <i class="far fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>
