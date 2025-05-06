<div class="card card-custom gutter-b bordered">
    <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="far fa-database"></i>
                </span>
            <h3 class="card-label">
                Liste des composants - (<?= count($datagrid) ?>)
            </h3>
        </div>
        <div class="card-toolbar">
            <a href="javascript:;" data-toggle="modal" data-target="#form_component_create"
               class="btn btn-light-primary font-weight-bolder">
                <i class="far fa-plus"></i>
                Nouveau
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <!--begin: Datatable -->
            <table class="table table-sm table-head-custom table-head-bg table-vertical-center rounded-0 datagrid">
                <thead>
                <tr>
                    <th class="no-sort" style="width: 1%;">
                        <label class="checkbox checkbox-outline checkbox-outline-2x checkbox-danger checkbox-single">
                            <input type="checkbox" value="" class="group-checkable">
                            <span></span>
                        </label>
                    </th>
                    <th style="width: 1%"> Id</th>
                    <th> Code</th>
                    <th> Libell&eacute;</th>
                    <th> Déclencheur</th>
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
                                    <input name="selected[]" value="<?= $rows->component_id ?>" type="checkbox" value="" class="checkable">
                                    <span></span>
                                </label>
                            </td>
                            <td><?= $rows->component_id ?></td>
                            <td><?= $rows->component_code ?></td>
                            <td><?= $rows->component_name ?></td>
                            <td><?= $rows->component_trigger ?></td>
                            <td><?= $rows->component_desc ?></td>
                            <td nowrap>
                                <a href="javascript:;" data-toggle="modal" data-target="#form_component_update"
                                   data-component_id="<?=@$rows->component_id?>"
                                   class="btn btn-icon btn-sm btn-light-warning"><i class="far fa-pencil"></i>
                                </a>
                                <a href="javascript:;" data-toggle="modal" data-target="#form_component_delete"
                                   data-component_id="<?=@$rows->component_id?>"
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
</div>
