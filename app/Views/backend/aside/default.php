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
        <li class="menu-item <?= menu()::active('ressources/participants') ?>" aria-haspopup="true">
            <a href="<?= url('ressources/participants') ?>" class="menu-link">
                <i class="menu-icon fad fa-users"></i>
                <span class="menu-text">Participants</span>
            </a>
        </li>


    </ul>
    <!--end::Menu Nav-->
</div>
