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
                Liste des participants B2B - (<?= count(@$dataset) ?>)
            </h3>
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
                <th> Nom</th>
                <th> Prénom </th>
                <th> Fonction</th>
                <th> Entreprise</th>
                <th> Secteur d'activité</th>
                <th style="width: 1%;" class="no-sort text-center"> Actions</th>
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
                    <td><?=$row->nom?></td>
                    <td> <?=$row->prenom?></td>
                    <td> <?=$row->fonction?></td>
                    <td> <?=$row->company_name?></td>
                    <td> <?=$row->sector_name?></td>
                    <td>
                        <a href="<?= base_url('ressources/participants/agenda/' . $row->id) ?>" 
                            class="btn btn-sm btn-info">
                            <i class="fas fa-calendar"></i> Agenda
                        </a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <!--end: Datatable -->
    </div>
</div>
