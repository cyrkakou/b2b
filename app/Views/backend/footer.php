<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?=plugins_js()?>custom/prismjs/prismjs.bundle.js"></script>
<script src="<?=assets_js();?>/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="<?=plugins_js()?>custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="<?=plugins_js()?>custom/gmaps/gmaps.js"></script>
<script src="<?=plugins_js()?>custom/vue.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/axios.min.js"></script>
<script src="<?=plugins_js()?>custom/jquery-ui/jquery-ui.bundle.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/jquery-validation/dist/additional-methods.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/datatables/datatables.bundle.js"></script>
<script src="<?=plugins_js()?>custom/jquery-form/jquery.form.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/jquery.alphanum.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/jquery.chained.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/zxcvbn.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/cleave.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/enjoyhint/enjoyhint.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/pdfobject.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js" type="text/javascript"></script>
<script src="<?=plugins_js()?>custom/handlebar/helpers.js" type="text/javascript"></script>

<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="<?=assets_js('');?>pages/widgets.js"></script>
<script src="<?=assets_js('');?>validate.js" type="text/javascript"></script>
<script src="<?=assets_js('');?>datagrid.js" type="text/javascript"></script>
<script src="<?=assets_js('');?>geojson.js" type="text/javascript"></script>
<script src="<?=assets_js('');?>app.js" type="text/javascript"></script>

<!--end::Page Scripts-->
<!--begin::Runtime Bottom JS -->
<?php echo load_js(true); ?>
<!--end::Runtime Bottom JS -->
<script>
    jQuery(document).ready(function(){
        //silence reload ajax
        $('[data-action="reload"]').on('click',function () {
            $($.fn.dataTable.tables(true)).DataTable().ajax.reload();
        })
        $('[data-toggle="tab"]').on('shown.bs.tab', function(e){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust()
                .responsive.recalc()
            //.scroller.measure();
        });
        $(window).resize(function(){
            $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust().draw();
        })
    })
</script>
