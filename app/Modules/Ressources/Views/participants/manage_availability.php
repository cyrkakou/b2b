<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Manage Availability</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('ressources/participants/manage-availability') ?>" method="post">
                        <?php 
                        $days = ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
                        foreach ($days as $index => $day): 
                            $daySlots = array_filter($availability, function($slot) use ($index) {
                                return $slot->day_of_week == $index;
                            });
                        ?>
                            <div class="form-group">
                                <label><?= $day ?></label>
                                <div class="row">
                                    <div class="col-md-5">
                                        <input type="time" name="slots[<?= $index ?>][start_time]" 
                                               class="form-control" 
                                               value="<?= !empty($daySlots) ? reset($daySlots)->start_time : '' ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <input type="time" name="slots[<?= $index ?>][end_time]" 
                                               class="form-control"
                                               value="<?= !empty($daySlots) ? reset($daySlots)->end_time : '' ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" 
                                                   id="active_<?= $index ?>" 
                                                   name="slots[<?= $index ?>][is_active]" 
                                                   value="1"
                                                   <?= !empty($daySlots) ? 'checked' : '' ?>>
                                            <label class="custom-control-label" for="active_<?= $index ?>">Active</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
