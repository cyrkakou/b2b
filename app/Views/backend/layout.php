<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<?php include_once ('header.php');?>
<?php include_once ('aside.php');?>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="<?=get_body_class()?>">
<!--begin::Main-->
<!--begin::Header Mobile-->
<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
    <a href="javascript:;" class="logo-mobile">
        <img alt="Logo" src="<?=base_url();?>/assets/media/logos/logo-dark.png"/>
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Header Menu Mobile Toggle-->
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
            <span class="svg-icon svg-icon-xl">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>
        </button>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <?php if(!empty(@$aside)):?>
        <!--begin::Aside-->
        <div id="kt_aside" class="aside aside-left aside-fixed d-flex flex-column flex-row-auto">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <a href="javascript:;" class="brand-logo">
                    <img alt="Logo" src="<?=base_url('');?>/assets/media/logos/logo.png" class="h-65px w-150px" />
                </a>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button id="kt_aside_toggle" class="brand-toggle btn btn-sm px-0">
                    <span><i class="flaticon2-fast-back" style="font-size: 1.5rem"></i></span>
                    <img alt="Logo" src="<?=base_url('assets/media/logos/favicon.png')?>"/>
                </button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->
            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <!--begin::Menu Container-->
                <?=@$aside?>
                <!--end::Menu Container-->
            </div>
        </div>
        <!--end::Aside-->
        <?php endif;?>
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <?php include_once ('nav.php');?>
            <!--end::Header-->
            <!--begin::Content-->
            <div id="kt_content" class="content d-flex flex-column flex-column-fluid">
                <!--begin::Subheader-->
                <?php include_once ('subheader.php');?>
                <!--end::Subheader-->
                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div role="on-ready" class="container-fluid d-none">
                        <?php include_once ('content.php');?>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->


<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
    <span class="svg-icon">
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
<!--begin::Modal-->
<div class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-dialog-centered modal-fullscreen" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-print mr-3"></i>Imprimer</h5>
                <button class="btn btn-default btn-icon btn-sm btn-light btn-hover-primary" data-toggle="tooltip" title="" data-original-title="Fermer"  data-dismiss="modal">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </button>
            </div>
            <div class="modal-body bg-light p-0 pb-6">
                <iframe name="pdf_iframe_preview" src="about:blank" style="width: 100%; height: 500px;" class="border-0 bg-light"></iframe>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
<?php include_once ('footer.php')?>
</body>
<!--end::Body-->
</html>
