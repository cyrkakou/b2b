<div class="card card-custom gutter-b bordered">
    <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-database"></i>
                </span>
            <h3 class="card-label">
                Liste des permissions - (<?= count($datagrid) ?>)
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" data-toggle="modal" data-target="#form_permission_create"
               class="btn btn-light-primary font-weight-bolder">
                <i class="far fa-plus"></i>
                Nouveau
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <!--begin: Datatable -->
        <table class="table table-head-custom table-head-bg table-vertical-center rounded-0 datagrid">
            <thead>
            <tr>
                <th class="no-sort" style="width: 1%;">
                    <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-danger checkbox-single">
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
                </th>
                <th style="width: 1%;" > Code</th>
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
                            <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary checkbox-single">
                                <input name="selected[]" value="<?= $rows->permission_id ?>" type="checkbox" value="" class="checkable">
                                <span></span>
                            </label>
                        </td>
                        <td><?= $rows->permission_code ?></td>
                        <td><?= $rows->permission_name ?></td>
                        <td><?= $rows->permission_desc ?></td>
                        <td nowrap class="text-center">
                            <a href="javascript:;" data-toggle="modal" data-target="#form_permission_update"
                               data-permission_id="<?=@$rows->permission_id?>"
                               class="btn btn-icon btn-sm btn-light-warning"><i class="far fa-pencil"></i>
                            </a>
                            <a href="javascript:;" data-toggle="modal" data-target="#form_permission_delete"
                               data-permission_id="<?=@$rows->permission_id?>"
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
