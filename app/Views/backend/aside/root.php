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
            <a href="<?= url('ressources/participants/list') ?>" class="menu-link">
                <i class="menu-icon fad fa-users"></i>
                <span class="menu-text">Participants</span>
            </a>
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
                    <li class="menu-item <?=menu()::active('auth/roles');?>" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="<?=url('auth/roles')?>" class="menu-link menu-toggle">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Rôles</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('auth/permissions');?>" aria-haspopup="true">
                        <a href="<?=url('auth/permissions')?>" class="menu-link">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Permissions</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('auth/components');?>" aria-haspopup="true">
                        <a href="<?=url('auth/components')?>" class="menu-link">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Composants</span>
                        </a>
                    </li>
                    <li class="menu-item <?=menu()::active('auth/strategies');?>" aria-haspopup="true">
                        <a href="<?=url('auth/strategies')?>" class="menu-link">
                            <i class="menu-bullet menu-bullet-line">
                                <span></span>
                            </i>
                            <span class="menu-text">Stratégies</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
    <!--end::Menu Nav-->
</div>
