<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle text-danger fa-5x mb-3"></i>
                    <h2 class="card-title"><?= $title ?></h2>
                    <p class="card-text"><?= $message ?></p>
                    <div class="mt-4">
                        <a href="<?= base_url('ressources/participants/retryPayment') ?>?transaction_id=<?= $transaction_id ?>" class="btn btn-primary">Payer</a>

                        <a href="<?= base_url('ressources/participants/cancelRegistration') ?>?transaction_id=<?= $transaction_id ?>" class="btn btn-danger">
                            Annuler
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
