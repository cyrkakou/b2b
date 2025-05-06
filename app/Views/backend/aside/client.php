<?= $this->renderSection('aside'); ?>
<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
     data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav">
        <li class="menu-item <?=menu()::active('dashboard')?>" aria-haspopup="true">
            <a href="<?=url('dashboard/')?>" class="menu-link">
                <i class="menu-icon far fa-tachometer"></i>
                <span class="menu-text">Tableau de bord</span>
            </a>
        </li>
        <li class="menu-item menu-item-submenu <?=menu()::open(['ressources'],null);?>" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon far fa-puzzle-piece"></i>
                <span class="menu-text">Ressources</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">Ressources</span>
                        </span>
                    </li>
                    <li class="menu-item <?=menu()::active('ressources/promoteurs/');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('ressources/promoteurs/')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Promoteurs</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('ressources/promotions/');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('ressources/promotions/')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Promotions immobiliéres</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="menu-item menu-item-submenu <?=menu()::open(['settings'],null);?> d-none" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon far fa-sliders-h"></i>
                <span class="menu-text">Configuration</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">Configuration</span>
                        </span>
                    </li>
                    <li class="menu-item <?=menu()::active('settings/control_panel/');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('settings/control_panel/')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">générale</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <!--end::Menu Nav-->
</div>
