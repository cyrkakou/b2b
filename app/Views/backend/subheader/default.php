<div id="kt_subheader" class="subheader py-2 py-lg-6 subheader-solid">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline flex-wrap mr-5">
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold my-1 mr-5 d-none d-xl-block"><?= @$page_title ?></h5>
                <!--end::Page Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard'); ?>" class="text-muted"><i class="flaticon2-shelter"></i></a>
                    </li>
                    <?php if (is_array(@$breadcrumb)): ?>
                        <?php for ($i = 0; $i < count($breadcrumb) - 1; $i++):
                            $url = (!empty($breadcrumb[$i]['url'])) ? $breadcrumb[$i]['url'] : 'javascript:;';
                            $icon = (!empty($breadcrumb[$i]['icon'])) ? '<i class="' . $breadcrumb[$i]['icon'] . ' mr-1"></i>' : '';
                            ?>
                            <li class="breadcrumb-item">
                                <a href="<?=$url;?>" class="text-muted"><?php echo ($icon) . ($breadcrumb[$i]['text']); ?></a>
                            </li>
                        <?php endfor; ?>
                        <li class="breadcrumb-item">
                            <a href="javascript:;" class="text-muted"><?php echo($breadcrumb[$i]['text']); ?></a>
                        </li>
                    <?php endif; ?>
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <?php if(!empty($subheader__toolbar)):?>
                <?= @$subheader__toolbar ?>
            <?php endif; ?>
        </div>
        <!--end::Toolbar-->
    </div>
</div>
