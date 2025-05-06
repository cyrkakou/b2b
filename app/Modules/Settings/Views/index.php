<div class="container mt-10">
    <?php foreach ($menuitems as $rows): ?>
        <h4><?= @$rows['title'] ?></h4>
        <div class="row">
            <?php foreach ($rows['items'] as $row): ?>
                <!--begin::Item -->
                <div class="col-md-6 col-xl-4"">
                    <div class="item d-flex my-5 bg-white rounded p-3" data-href="<?= base_url(@$row['url']) ?>">
                        <!--begin::Symbol-->
                        <div class="symbol symbol-40 symbol-light-primary mr-5">
                                    <span class="symbol-label text-primary ">
                                        <span class="<?= @$row['icon'] ?>"></span>
                                    </span>
                        </div>
                        <!--end::Symbol-->
                        <!--begin::Text-->
                        <div class="d-flex flex-column font-weight-bold">
                            <a href="javascript:;"
                               class="text-dark text-hover-primary mb-1 font-size-lg"><?= @$row['text'] ?></a>
                            <span class="text-muted text-nowrap"><?= @$row['description'] ?></span>
                        </div>
                        <!--end::Text-->
                    </div>
                </div>
                <!--end::Item-->
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>
