<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pending Requests</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Demandeur</th>
                                    <th>Date & Heure</th>
                                    <th>Notes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pending_requests as $request): ?>
                                    <tr>
                                        <td><?= esc($request->firstname) ?> <?= esc($request->lastname) ?></td>
                                        <td><?= date('Y-m-d H:i', strtotime($request->start_time)) ?></td>
                                        <td><?= esc($request->notes) ?></td>
                                        <td>
                                            <form action="<?= base_url('ressources/participants/update-appointment/' . $request->id) ?>" 
                                                  method="post" class="d-inline">
                                                <input type="hidden" name="status" value="approved">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="<?= base_url('ressources/participants/update-appointment/' . $request->id) ?>" 
                                                  method="post" class="d-inline">
                                                <input type="hidden" name="status" value="rejected">
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mes RDV</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Avec</th>
                                    <th>Date & Heure</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $appointment): ?>
                                    <tr>
                                        <td>
                                            <?php if ($appointment->requester_id == session()->get('user')['id']): ?>
                                                <?= esc($appointment->participant_firstname) ?> <?= esc($appointment->participant_lastname) ?>
                                            <?php else: ?>
                                                <?= esc($appointment->requester_firstname) ?> <?= esc($appointment->requester_lastname) ?>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= date('Y-m-d H:i', strtotime($appointment->start_time)) ?></td>
                                        <td>
                                            <span class="badge badge-<?= $appointment->status == 'approved' ? 'success' : 
                                                                     ($appointment->status == 'rejected' ? 'danger' : 'warning') ?>">
                                                <?= ucfirst($appointment->status) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($appointment->notes) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

