<style>
    .td-warning{
        background-color: rgba(255,184,34,.1) !important;
    }
    .dataTables_wrapper .dataTable tfoot th, .dataTables_wrapper .dataTable thead th {
        font-weight: bold !important;
        color: #181C32 !important;
    }
</style>

<div class="card card-custom bordered">
    <div class="card-header">
        <div class="card-title">
                <span class="card-icon">
                    <i class="fas fa-database"></i>
                </span>
            <h3 class="card-label">
                Liste des objectifs - (<?= count(@$dataset) ?>)
            </h3>
        </div>
        
        <div class="card-toolbar">
            <a href="javascript:;" data-toggle="modal" data-target="#modal_goal_create" class="btn btn-light-primary font-weight-bolder">
                <i class="far fa-plus"></i>
                Nouveau
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <!--begin: Datatable -->
        <table class="table table-sm table-head-custom table-head-bg table-vertical-center rounded-0 datagrid">
            <thead>
            <tr class="">
                <th class="no-sort" style="width: 1%;">
                    <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x checkbox-danger">
                        <input type="checkbox" value="" class="group-checkable">
                        <span></span>
                    </label>
                </th>
                <th> Id</th>
                <th> Libellé</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dataset as $row): ?>
                <tr>
                    <td class="no-sort" style="widtd: 1%;">
                        <label class="checkbox checkbox-lg checkbox-outline checkbox-outline-2x">
                            <input type="checkbox" value="" class="group-checkable">
                            <span></span>
                        </label>
                    </td>
                    <td style="widtd: 1%;"> <?=$row->id?></td>
                    <td><?=$row->name?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>