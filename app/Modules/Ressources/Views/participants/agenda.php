<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Agenda de <?= esc($participant->prenom) ?> <?= esc($participant->nom) ?>
                    </h3>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Demande de RDV</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('ressources/participants/request-appointment/' . $participant->id) ?>" method="post">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="form-group">
                            <label>Créneau</label>
                            <select name="time_slot" class="form-control" required>
                                <option value="">Choisir une heure Time</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea name="notes" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Faire la demande</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        slotMinTime: '08:00:00',
        slotMaxTime: '18:00:00',
        events: <?= json_encode($appointments) ?>,
        businessHours: <?= json_encode($availability) ?>
    });
    calendar.render();
    
    // Update available time slots when date changes
    document.querySelector('input[name="date"]').addEventListener('change', function(e) {
        fetch(`<?= base_url('ressources/participants/available-slots/' . $participant->code) ?>?date=${e.target.value}`)
            .then(response => response.json())
            .then(slots => {
                const select = document.querySelector('select[name="time_slot"]');
                select.innerHTML = '<option value="">Select Time</option>';
                slots.forEach(slot => {
                    select.innerHTML += `<option value="${slot.start_time}">${slot.start_time} - ${slot.end_time}</option>`;
                });
            });
    });
});
</script>
