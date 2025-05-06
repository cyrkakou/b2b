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
        <li class="menu-item <?= menu()::active('ressources/participants/list/') ?>" aria-haspopup="true">
            <a href="<?= url('ressources/participants/do_list') ?>" class="menu-link">
                <i class="menu-icon fad fa-users"></i>
                <span class="menu-text">Participants</span>
            </a>
        </li>
        
        <li class="menu-item menu-item-submenu <?=menu()::open(['settings'],null);?>" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon ki ki-bold-more-hor icon-md"></i>

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
                    <li class="menu-item <?=menu()::active('settings/sectors');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('settings/sectors')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Filiére</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('settings/activities');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('settings/activities')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Secteur d'activité</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('settings/goals');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('settings/goals')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Objectif</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('settings/profiles');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('settings/profiles')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Profil</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="menu-item menu-item-submenu <?=menu()::open(['auth'],null);?>" aria-haspopup="true" data-menu-toggle="hover">
            <a href="javascript:;" class="menu-link menu-toggle">
                <i class="menu-icon far fa-shield"></i>
                <span class="menu-text">Sécurité</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="menu-submenu">
                <i class="menu-arrow"></i>
                <ul class="menu-subnav">
                    <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                            <span class="menu-text">Sécurité</span>
                        </span>
                    </li>
                    <li class="menu-item <?=menu()::active('auth/users');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('auth/users')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Utilisateurs</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <!--end::Menu Nav-->
</div>
