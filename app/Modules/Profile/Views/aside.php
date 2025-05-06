<style>
    .kt-widget__item.active {
        -webkit-transition: color 0.3s ease;
        transition: color 0.3s ease;
        background: #f2f3f7;
        border-radius: 4px;
    }
</style>

<div class="kt-portlet">
    <div class="kt-portlet__body pb-0">
        <div class="kt-widget kt-widget--user-profile-1">
            <div class="kt-widget__head">
                <div class="kt-widget__media">

                </div>
                <div class="kt-widget__content">
                    <div class="kt-widget__section">
                        <a href="#" class="kt-widget__username">
                            <?= strtoupper(@$personne->nom) ?>&nbsp;<?= @$personne->prenoms ?>
                            <i class="flaticon2-correct kt-font-success"></i>
                        </a>
                        <span class="kt-widget__subtitle">
                            <?= @$personne->profession ?>
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="kt-portlet__separator"></div>
    <div class="kt-portlet__body pb-0 pt-0">
        <!--begin::Widget -->
        <div class="kt-widget kt-widget--user-profile-1">
            <div class="kt-widget__body">
                <div class="kt-widget__content">
                    <div class="kt-widget__info">
                        <span class="kt-widget__label">Téléphone Mobile:</span>
                        <a href="#" class="kt-widget__data"><?= @$personne->telephone_1 ?></a>
                    </div>
                    <div class="kt-widget__info">
                        <span class="kt-widget__label">Téléphone Fixe:</span>
                        <a href="#" class="kt-widget__data"><?= @$personne->telephone_2 ?></a>
                    </div>
                    <div class="kt-widget__info">
                        <span class="kt-widget__label">Email:</span>
                        <a href="#" class="kt-widget__data"><?= @$personne->email ?></a>
                    </div>
                    <div class="kt-widget__info">
                        <span class="kt-widget__label">Adresse:</span>
                        <span class="kt-widget__data"><?= @$personne->adresse ?></span>
                    </div>
                </div>

                <div class="kt-widget__items nav flex-column" role="tablist">
                    <a href="#overview" data-toggle="tab" class="kt-widget__item active" role="tab">
                        <span class="kt-widget__section">
                            <span class="kt-widget__icon">
                                <i class="fa fa-eye"></i>
                            </span>
                            <span class="kt-widget__desc">
                                Aperçu
                            </span>
                        </span>
                    </a>

                    <a href="#personnal" data-toggle="tab" class="kt-widget__item" role="tab">
                        <span class="kt-widget__section">
                            <span class="kt-widget__icon">
                                <i class="fa fa-id-card"></i>
                            </span>
                            <span class="kt-widget__desc">
                                Informations personnelles
                            </span>
                        </span>
                    </a>
                    <a href="#account" data-toggle="tab" class="kt-widget__item" role="tab">
                        <span class="kt-widget__section">
                            <span class="kt-widget__icon"><i class="fa fa-user-alt"></i></span>
                            <span class="kt-widget__desc">
                                Compte utilisateur
                            </span>

                    </span></a>
                    <a href="#password" data-toggle="tab" class="kt-widget__item" role="tab">
                        <span class="kt-widget__section">
                            <span class="kt-widget__icon">
                                <i class="fa fa-shield-check"></i>
                            </span>
                            <span class="kt-widget__desc">
                                Mot de passe
                            </span>
                        </span>
                    </a>
                    <a href="#preference" data-toggle="tab" class="kt-widget__item" role="tab">
                        <span class="kt-widget__section">
                            <span class="kt-widget__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
        <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z"
              id="Combined-Shape" fill="#000000" opacity="0.3"></path>
        <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z"
              id="Combined-Shape" fill="#000000"></path>
    </g>
</svg>                            </span>
                            <span class="kt-widget__desc">
                                Préférences
                            </span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <!--end::Widget -->
    </div>
    <div class="kt-portlet__separator"></div>
    <?php if(has_role(['root'])):?>
    <div class="kt-portlet__body pb-0">
        <div class="kt-widget kt-widget--user-profile-2">

            <div class="kt-widget__body">

                <div class="kt-widget__content">
                    <div class="kt-widget__stats kt-margin-r-20">
                        <div class="kt-widget__icon">
                            <i class="flaticon-piggy-bank"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Gains</span>
                            <span class="kt-widget__value"><span>$</span>249,500</span>
                        </div>
                    </div>

                    <div class="kt-widget__stats">
                        <div class="kt-widget__icon">
                            <i class="flaticon-pie-chart"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Solde</span>
                            <span class="kt-widget__value"><span>$</span>84,060</span>
                        </div>
                    </div>
                </div>


            </div>


        </div>
    </div>
    <?php endif;?>
</div>