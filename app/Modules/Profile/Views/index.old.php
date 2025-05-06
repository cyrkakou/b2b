<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php include_once('aside.php'); ?>
        </div>
        <!--Begin:: App Content-->
        <div class="col-md-8">
            <div class="tab-content">
                <div id="overview" class="tab-pane active" role="tabpanel">
                    <?php include_once('overview.php') ?>
                </div>
                <div id="personnal" class="tab-pane fade" role="tabpanel">
                    <?php include_once('personnal.php') ?>
                </div>
                <div id="account" class="tab-pane fade" role="tabpanel">
                    <?php include_once ('account.php')?>
                </div>
                <div id="password" class="tab-pane fade" role="tabpanel">
                    <?php include_once ('password.php')?>
                </div>
                <div id="preference" class="tab-pane fade" role="tabpanel">
                    <?php include_once ('preference.php')?>
                </div>
            </div>
        </div>
        <!--End:: App Content-->
    </div>
</div>