<div id="kt_header" class="header header-fixed">
    <!--begin::Container-->
    <div class="container-fluid d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div id="kt_header_menu_wrapper" class="header-menu-wrapper header-menu-wrapper-left">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                <!--begin::Header Nav-->
                <ul class="menu-nav">
                    <li class="menu-item menu-item-rel <?=service('menu')::active('dashboard')?>">
                        <a href="<?=base_url('/dashboard')?>" class="menu-link">
                            <span class="menu-text"><i class="far fa-tachometer-alt mr-1"></i>Tableau de bord</span>
                        </a>
                    </li>
                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->
        <!--begin::Topbar-->
        <div class="topbar">
            <!--begin::User-->
            <?php include_once 'user.php'?>
            <!--end::User-->
        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>
