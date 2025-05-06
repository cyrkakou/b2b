<style>
    .nav a.nav-link.active i{
        color: #ffffff !important;
    }
</style>

    <div class="card card-custom">
        <div class="card-header">
            <div class="card-toolbar">
                <ul class="nav nav-bold nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_personal_info">
                            <span class=""><i class="fad fa-id-badge"></i></span>
                            <span class="nav-text ml-2 d-none d-md-block">Identité</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_contact_info">
                            <span class=""><i class="fad fa-mobile"></i></span>
                            <span class="nav-text ml-2  d-none d-md-block">Contacts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_locate">
                            <span class=""><i class="fad fa-map-marker"></i></span>
                            <span class="nav-text ml-2  d-none d-md-block">Localisation</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_account">
                            <span class=""><i class="fad fa-user"></i></span>
                            <span class="nav-text ml-2  d-none d-md-block">Accés</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_password">
                            <span class=""><i class="fad fa-user-lock"></i></span>
                            <span class="nav-text ml-2  d-none d-md-block">Password</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="tab-content">

                    <div id="kt_tab_personal_info" class="tab-pane fade show active" role="tabpanel">
                        <?php include_once('personnal.php') ?>
                    </div>
                    <div id="kt_tab_contact_info" class="tab-pane fade" role="tabpanel">
                        <?php include_once('contact.php') ?>
                    </div>
                    <div id="kt_tab_locate" class="tab-pane fade" role="tabpanel">
                        <?php include_once('address.php') ?>
                    </div>
                    <div id="kt_tab_account" class="tab-pane fade" role="tabpanel">
                        <?php include_once('account.php') ?>
                    </div>
                    <div id="kt_tab_password" class="tab-pane fade" role="tabpanel">
                        <?php include_once('password.php') ?>
                    </div>

            </div>
        </div>
    </div>



<div class="container d-none">
    <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
            <div class="kt-widget kt-widget--user-profile-3">
                <div class="kt-widget__top">
                    <div class="kt-widget__media">

                    </div>
                    <div class="kt-widget__content">
                        <div class="kt-widget__head">
                            <a href="javascript:;" class="kt-widget__username">
                                <?=@$personne->nom?>&nbsp;<?=@$personne->prenoms?>
                                <i class="flaticon2-correct"></i>
                            </a>


                            <div class="kt-widget__action">

                            </div>
                        </div>
                        <span class="kt-widget__subtitle">
                            <?= @$personne->profession ?>
                        </span>
                        <div class="kt-widget__subhead">
                            <a href="javascript:;"><i class="far fa-envelope"></i><?=@$personne->email?></a>
                            <a href="javascript:;"><i class="far fa-mobile-alt"></i><?=@$personne->telephone_1?></a>
                            <a href="javascript:;"><i class="far fa-phone-rotary"></i><?=@$personne->telephone_2?></a>
                        </div>
                        <div class="list-icons list-icons-extended mt-3">
                            <?php if (!empty(@$personne->facebook)): ?>
                                <li class="list-icons-item">
                                    <a href="#<?= @$personne->facebook ?>" class="btn btn-icon rounded-round facebook"
                                       data-popup="tooltip" title="" data-container="body" data-original-title="Twitter"
                                       target="_blank"><i class="icon-facebook"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty(@$personne->twitter)): ?>
                                <li class="list-icons-item">
                                    <a href="#<?= @$personne->twitter ?>" class="btn btn-icon rounded-round twitter"
                                       data-popup="tooltip" title="" data-container="body" data-original-title="Twitter"
                                       target="_blank"><i class="icon-twitter"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty(@$personne->googleplus)): ?>
                                <li class="list-icons-item">
                                    <a href="#<?= @$personne->googleplus ?>"
                                       class="btn btn-icon rounded-round bg-danger " data-popup="tooltip" title=""
                                       data-container="body" data-original-title="Google Plus" target="_blank"><i
                                            class="icon-google-plus"></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty(@$personne->linkedin)): ?>
                                <li class="list-icons-item">
                                    <a href="#<?= @$personne->linkedin ?>" class="btn btn-icon rounded-round linkedIn"
                                       data-popup="tooltip" title="" data-container="body" data-original-title="LinkedIn"
                                       target="_blank"><i class="icon-linkedin2"></i></a>
                                </li>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
                <div class="kt-widget__bottom d-none">
                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-piggy-bank"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Gains</span>
                            <span class="kt-widget__value"><span>$</span>249,500</span>
                        </div>
                    </div>

                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-confetti"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Solde</span>
                            <span class="kt-widget__value"><span>$</span>164,700</span>
                        </div>
                    </div>

                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-pie-chart"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">Net</span>
                            <span class="kt-widget__value"><span>$</span>164,700</span>
                        </div>
                    </div>

                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-file-2"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">73 Tasks</span>
                            <a href="#" class="kt-widget__value kt-font-brand">View</a>
                        </div>
                    </div>

                    <div class="kt-widget__item">
                        <div class="kt-widget__icon">
                            <i class="flaticon-chat-1"></i>
                        </div>
                        <div class="kt-widget__details">
                            <span class="kt-widget__title">648 Comments</span>
                            <a href="#" class="kt-widget__value kt-font-brand">View</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>