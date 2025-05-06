<script>
jQuery(document).ready(function() {
    function createParticipantFields(count) {
        const container = document.getElementById('participantsContainer');
        container.innerHTML = ''; // Clear existing fields

        for (let i = 1; i <= count; i++) {
            const participantHtml = `
                <div class="card mb-4">
                    <div class="card-header">
                        <h4>Informations du participant ${i}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email_${i}" class="form-label">Email *</label>
                                <input type="email" class="form-control" placeholder="adresse email" id="email_${i}" name="participants[${i}][email]" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="confirm_email_${i}" class="form-label">Confirmer Email *</label>
                                <input type="email" class="form-control" placeholder="confirmer l'adresse email" id="confirm_email_${i}" name="participants[${i}][confirm_email]" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="firstname_${i}" class="form-label">Prénom *</label>
                                <input type="text" class="form-control" placeholder="Prénom" id="firstname_${i}" name="participants[${i}][firstname]" minlength="2" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lastname_${i}" class="form-label">Nom *</label>
                                <input type="text" class="form-control" placeholder="Nom" id="lastname_${i}" name="participants[${i}][lastname]" minlength="2" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="function_${i}" class="form-label">Fonction *</label>
                                <input type="text" class="form-control" placeholder="Fonction" id="function_${i}" name="participants[${i}][function]" data-validate="required">

                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile_${i}" class="form-label">Téléphone Mobile *</label>
                                <input type="tel" class="form-control" placeholder="Numéro de téléphone mobile" id="mobile_${i}" name="participants[${i}][mobile]" pattern="[0-9+\s-]{8,}" required>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', participantHtml);
        }
    }

    // Show initial participant field on page load
    createParticipantFields(1);

    document.getElementById('badges').addEventListener('change', function() {
        const count = Math.max(parseInt(this.value) || 1, 1); // Ensure minimum of 1
        this.value = count; // Update input value if it was invalid
        createParticipantFields(count);
    });
});
</script>

<style>
    .titre1{
        color: #E94E1B;
        font-size: 25px;
        font-weight: 600;
        text-transform: uppercase;
        line-height: 1.2em;
        letter-spacing: 0.4px;
    }
    .titre2{
        color: #088C09;
        font-size: 18px;
        font-weight: 500;
    }
    .sara_bg_green{
        background-color: #2E7F35;
    }
    .big .select2-container .select2-selection--single{
        height: 48px;
        border-width: 3px;
    }
    .big .select2-container .select2-selection--multiple{
        min-height: 48px;
        border-width: 3px;
    }
    .big .select2-container--default .select2-selection--single .select2-selection__rendered{
        line-height: 48px;
        font-size: 1.175rem !important;
    }

    .big .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 48px;
    }
    .big input[type="text"].form-control,
    .big input[type="text"].is-valid.form-control {
        height: 48px;
        font-size: 1.175rem !important;
        border-width: 3px !important;
    }
    .big input[type="email"].form-control,
    .big input[type="email"].is-valid.form-control {
        height: 48px;
        font-size: 1.175rem !important;
        border-width: 3px !important;
    }
</style>

<div class="separator separator-dashed separator-warning my-5"></div>
<div class="card card-custom gutter-b shadow-none">
    <div class="d-flex justify-content-center">
        <span class="titre1">
            FORMULAIRE D'INSCRIPTION B2B
        </span>
    </div>
    <div class="card-body p-0">
        <form action="<?= base_url('ressources/participants/do_create') ?>" method="post" class="needs-validation" novalidate>
            <!-- Step 1: Number of Badges -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Nombre de Badges</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="badges" class="form-label">Nombre de Badges Pro</label>
                        <input type="number" class="form-control" id="badges" name="badges" min="1" value="1" required>
                    </div>
                </div>
            </div>

            <!-- Step 2: Dynamic Participant Information -->
            <div id="participantsContainer">
                <!-- Participant fields will be dynamically inserted here -->
            </div>

            <!-- Step 3: Company Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Informations de l'entreprise</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Raison sociale *</label>
                        <input type="text" class="form-control" placeholder="Raison sociale" id="company_name" name="company_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="company_address" class="form-label">Adresse de l'entreprise *</label>
                        <input type="text" class="form-control"placeholder="Adresse de l'entreprise" id="company_address" name="company_address" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="city" class="form-label">Ville *</label>
                            <input type="text" class="form-control" placeholder="Ville" id="city" name="city" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="country" class="form-label">Pays *</label>
                            <?php dropDown("SELECT iso2,short_name FROM settings_pays", [
                                'id' => 'country',
                                'name' => 'country',
                                'class' => 'form-control select2-with-search',
                                'attr' => 'data-placeholder="Choisir un pays" data-validate="required" ',
                                'selected' => ''
                            ]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="company_phone" class="form-label">Téléphone de l'entreprise *</label>
                            <input type="tel" class="form-control" placeholder="Numéro de téléphone de l'entreprise" id="company_phone" name="company_phone" pattern="[0-9+\s-]{8,}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="website" class="form-label">Site Web</label>
                            <input type="url" class="form-control" placeholder="Site web" id="website" name="website" pattern="https?://.+" placeholder="https://...">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Filiére *</label>
                        <div class="row">
                            <?php foreach ($business_lines as $line): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="sector" value="<?= $line->id ?>" required>
                                        <label class="form-check-label"><?= $line->name ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Secteur d'activité  *</label>
                        <div class="row">
                            <?php foreach ($sectors as $sector): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input activities-checkbox" type="checkbox" name="activities[]" value="<?= $sector->id ?>">
                                        <label class="form-check-label"><?= $sector->name ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Step 4: Participation Objectives -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Objectifs de participation</h4>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Quels sont vos objectifs de participation au SARA ? *</label>
                        <div class="row">
                            <?php foreach ($objectives as $objective): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input objectives-checkbox" type="checkbox" name="goals[]" value="<?= $objective->id ?>">
                                        <label class="form-check-label"><?= $objective->name ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quels profils souhaitez-vous rencontrer au SARA ? *</label>
                        <div class="row">
                            <?php foreach ($profiles as $profile): ?>
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input profiles-checkbox" type="checkbox" name="profiles[]" value="<?= $profile->id ?>">
                                        <label class="form-check-label"><?= $profile->name ?></label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-primary">S'inscription</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add validation for checkbox groups
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Check activities
        const activities = document.querySelectorAll('.activities-checkbox:checked');
        if (activities.length === 0) {
            e.preventDefault();
            alert("Veuillez sélectionnerau moins un secteur d'activité");
            return;
        }

        // Check objectives
        const objectives = document.querySelectorAll('.objectives-checkbox:checked');
        if (objectives.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un objectif de participation');
            return;
        }

        // Check profiles
        const profiles = document.querySelectorAll('.profiles-checkbox:checked');
        if (profiles.length === 0) {
            e.preventDefault();
            alert('Veuillez sélectionner au moins un profil à rencontrer');
            return;
        }
    });

    // Email confirmation validation
    const emailInputs = document.querySelectorAll('input[type="email"]');
    emailInputs.forEach(function(input) {
        if (input.name.includes('confirm_email')) {
            input.addEventListener('input', function() {
                const emailId = this.id.replace('confirm_', '');
                const emailInput = document.getElementById(emailId);
                if (this.value !== emailInput.value) {
                    this.setCustomValidity('Les adresses email ne correspondent pas');
                } else {
                    this.setCustomValidity('');
                }
            });
        }
    });
});
</script>
