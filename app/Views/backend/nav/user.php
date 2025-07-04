<?php
$user_login = get_user_info('user_login');
$user_nicename = get_user_info('user_nicename');
$user_email = get_user_info('user_email');
$user_role = get_user_info('role_code');
$photo = get_user_info('photo');
?>
<div class="topbar-item">
    <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
         id="kt_quick_user_toggle" title="Bonjour <?=$user_login?>">
        <span class="d-none d-xl-block">
        <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Bonjour,</span>
        <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3"><?=$user_login?></span>
        </span>
        <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
            <?php if(empty($photo)):?>
                <span class="symbol-label font-size-h5 font-weight-bold"><?=@$user_login[0];?></span>
            <?php else:?>
                    <img src="<?=base_url($photo);?>" class=" align-self-end" alt="">
            <?php endif;?>
        </span>
    </div>
</div>
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">Mon profil</h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5 symbol-light-success">
                <?php if(empty($photo)):?>
                    <span class="symbol-label">
                    <img src="<?=base_url('assets/media/svg/avatars/007-boy-2.svg');?>" class="h-100 align-self-end" alt="">
                </span>
                <?php else:?>
                    <div class="symbol-label" style="background-image:url('<?=base_url($photo);?>')"></div>
                <?php endif;?>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="javascript:;" class="font-weight-bold  text-dark-75 text-hover-primary"><?=(!empty($user_nicename)?$user_nicename:$user_login);?></a>
                <div class="text-muted mt-1"><?=get_user_info('role_name')?></div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                                <span class="navi-link p-0 pb-2">
                                    <span class="navi-icon mr-1">
                                        <span class="svg-icon svg-icon-lg svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                    <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text text-muted text-hover-primary"><?=@$user_email?></span>
                                </span>
                    </a>
                    <a href="<?=base_url('/auth/logout')?>" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5">Déconnexion</a>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="<?=base_url("/profile/")?>" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">Mon profil</div>
                        <div class="text-muted">Paramétres du compte utilisateur</div>
                    </div>
                </div>
            </a>
            <!--end:Item-->

        </div>
        <!--end::Nav-->

    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
