<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle text-success fa-5x mb-3"></i>
                    <h2 class="card-title"><?= $title ?></h2>
                    <p class="card-text"><?= $message ?></p>
                    <p>Un email a été envoyé à chaque participant avec ses identifiants de connexion.</p>
                    <a href="<?= base_url('/') ?>" class="btn btn-primary">Retour</a>
                </div>
            </div>
        </div>
    </div>
</div>
