<div class="container">
    <h1 class="font-weight-semibold mb-3">
        Bienvenue dans l'espace d'administration des demandes, <?=get_user_info('user_login')?>.
    </h1>
    <div class="d-flex align-items-start flex-column flex-md-row">
        <div class="order-2 order-md-1">
            <div class="row">
                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body d-flex justify-content-between flex-column" style="background-color: #0d8ddc">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="font-weight-semibold mb-0"><?=$all?></h3>
                                <span class="text-uppercase font-size-sm text-muted">Demandes totales</span>
                            </div>
                            <div class="ml-3 align-self-center">
                                <i class="icon-coins icon-3x text-orange-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body" style="background-color: #0abb87">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="font-weight-semibold mb-0"><?=$valid?></h3>
                                <span class="text-uppercase font-size-sm text-muted">Demandes validées</span>
                            </div>
                            <div class="ml-3 align-self-center">
                                <i class="icon-price-tags icon-3x text-pink-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body" style="background-color: #cfe7ff">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="font-weight-semibold mb-0"><?=$pending?></h3>
                                <span class="text-uppercase font-size-sm text-muted">Demandes en cours</span>
                            </div>
                            <div class="ml-3 align-self-center">
                                <i class="icon-store2 icon-3x text-indigo-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="card card-body" style="background-color: #f0eb96">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="font-weight-semibold mb-0"><?=$rejected?></h3>
                                <span class="text-uppercase font-size-sm text-muted">Demandes rejetées</span>
                            </div>
                            <div class="ml-3 align-self-center">
                                <i class="icon-store2 icon-3x text-indigo-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="alert alert-info bg-white alert-styled-left alert-arrow-left alert-dismissible invisible">
                <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                <h6 class="alert-heading font-weight-semibold mb-1">Content sidebar</h6>
                Fot the right content sidebar, inner container classes need to be used without breakpoints, because since
                sidebar markup comes after content, we need to change content ordering. <code>.flex-column</code> and <code>.flex-[breakpoint]-row</code>
                classes are also required.
            </div>
        </div>
        <div class="sidebar sidebar-light sidebar-component sidebar-component-right bg-transparent border-0 shadow-0 order-1 order-md-2 sidebar-expand-md">
            <!-- Sidebar content -->
            <div class="sidebar-content">
                <?= @$to_right ?>
            </div>
            <!-- /sidebar content -->
        </div>
    </div>
</div>