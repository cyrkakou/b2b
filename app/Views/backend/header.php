<head>
    <base href="../../../../">
    <meta charset="utf-8" />
    <title><?= config('app')->site['title']; ?></title>
    <meta name="description" content="<?= config('app')->site['description']; ?>"/>
    <meta name="author" content="<?= config('app')->site['author']; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendors Styles(used by this page)-->
    <?php if (in_array(uri_string(), ['participants/', 'participants/agenda', 'participants/manage-appointments', 'participants/manage-availability'])): ?>
    <link href="<?=base_url('');?>/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/css/appointments.css" rel="stylesheet" type="text/css" />
    <?php endif; ?>
    <link href="<?=base_url('');?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>/assets/plugins/custom/bootstrap-duallistbox/bootstrap-duallistbox.min.css"
          rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?=base_url('');?>/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/plugins/global/fonts/fontawesome-pro/css/all.min.css"
          rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>/assets/css/custom.css" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?=base_url('');?>/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/css/themes/layout/brand/yesha.css" rel="stylesheet" type="text/css" />
    <link href="<?=base_url('');?>/assets/css/themes/layout/aside/apps.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <!--begin::Page Custom Styles(used by this page)-->

    <!--end::Page Custom Styles-->
    <!--begin::Runtime Skins -->
    <?php echo load_css(); ?>
    <!--end::Runtime Skins -->
    <link rel="shortcut icon" href="<?=base_url('');?>/assets/media/logos/favicon.png" />

    <script>
        var LANGUAGE = 'fr';
        var COUNTRY_CODE = '<?= strtolower(@$config->country_code) ?>';
        var COUNTRY_PHONE_CODE = '<?= strtolower(@$config->country_phone_code) ?>';
        var DEVISE = '<?= (@$config->devise) ?>';
        var BASE_URL = '<?=base_url();?>';
        var LONGITUDE = parseFloat('<?=LONGITUDE?>')||0;
        var LATITUDE = parseFloat('<?=LATITUDE?>')||0;
    </script>
    <!--<script src="<?= base_url(); ?>_/assets/js/jquery.min.js" type="text/javascript"></script> -->
    <script src="<?=base_url('');?>/assets/plugins/global/plugins.bundle.js"></script>
    <?php if (in_array(uri_string(), ['participants/', 'participants/agenda', 'participants/manage-appointments', 'participants/manage-availability'])): ?>
    <script src="<?=base_url('');?>/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script>
        // Register required FullCalendar plugins
        FullCalendar.globalPlugins.push(
            FullCalendarDayGrid,
            FullCalendarTimeGrid,
            FullCalendarInteraction
        );
    </script>
    <?php endif; ?>
    <!--begin::Runtime Top JS -->
    <?php echo load_js(); ?>
    <?php if (in_array(uri_string(), ['participants/', 'participants/agenda', 'participants/manage-appointments', 'participants/manage-availability'])): ?>
    <script src="<?=base_url('');?>/assets/js/appointments.js"></script>
    <?php endif; ?>
    <!--end::Runtime Top JS -->
</head>