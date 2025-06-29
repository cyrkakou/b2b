<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<?php include_once ('header.php'); ?>
<?php include_once ('aside.php'); ?>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"  style="background-color: #ffffff">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <div class="container py-4">
        <div class="d-flex justify-content-center">
            <img  height="128" src="<?=base_url('');?>/assets/media/logos/logo.png" class="attachment-large size-large wp-image-27" alt="" loading="lazy">
<!--            <img  height="128" src="https://sietta.net/wp-content/uploads/2023/02/cropped-conseil-du-coton-et-de-lanacarde-1.png" class="attachment-full size-full wp-image-24" alt="" loading="lazy" srcset="https://sietta.net/wp-content/uploads/2023/02/cropped-conseil-du-coton-et-de-lanacarde-1.png 350w, https://sietta.net/wp-content/uploads/2023/02/cropped-conseil-du-coton-et-de-lanacarde-1-300x105.png 300w" sizes="(max-width: 350px) 100vw, 350px">-->
        </div>
    </div>
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid ">
        <!--begin::Content-->
        <div class="container py-4">
            <?php include_once ('content.php'); ?>
        </div>
        <!--end::Content-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
            <span class="svg-icon">
                <!--begin::Svg Icon | path:<?= base_url(''); ?>assets/media/svg/icons/Navigation/Up-2.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <polygon points="0 0 24 0 24 24 0 24" />
                <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
</div>
<!--end::Scrolltop-->
<?php include_once ('footer.php') ?>
</body>
<!--end::Body-->
</html>