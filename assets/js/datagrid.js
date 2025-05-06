"use strict";
var phone = function(str, code){
    let phone_mask = {
        CI:/^(\d{2})(\d{2})(\d{2})(\d{2})$/,
        SN:/^(\d{2})(\d{3})(\d{2})(\d{2})$/,
        GN:/^(\d{3})(\d{2})(\d{2})(\d{2})$/
    }
    let cleaned = ('' + str)
        .replace(/\s/g, '')
        .replace(/\D/g, '')
        .replace('-', '');
    let match = cleaned.match(phone_mask[isset(code)?code.toUpperCase():'GN']);
    if (match) {
        match.shift()
        return match.join('-')
    };
    return cleaned;
}
var call_to = function (item){
    if(!item.value) return ''
    return ('<a href="tel:' + item.value + '"' + 'class="text-nowrap" ' + 'title="Appeler">' + item.text + '</a>');
}
var email_to = function (item){
    if(!item.value) return ''
    return ('<a href="mailto:' + item.value + '"' + 'class="text-nowrap" ' + 'title="Ecrire à">' + item.text + '</a>');
}
var badge = function (item, inline){
    return '<div class="text-center "><span class="text-nowrap kt-badge kt-badge--rounded kt-badge--'
        + item.class + ' kt-badge--inline kt-badge--pill">'
        + item.text + '</span></div>';
}
//
var Datagrid = function (element, options) {
// Main object
    var the = this
    // Default options
    var defaultOptions =
        {
            "bStateSave": true,
            colReorder: true,
            container:'.datagrid',
            responsive: {
                details: {
                    type: 'detail'
                }
            },
            serverFiltering: false,
            serverSorting: false,
            // DOM Layout settings
            dom: `<"row datatable-header pt-2 px-3"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>><"datatable-scroll"t>
                    <"row datatable-footer px-3 pb-3"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7 dataTables_pager"p>>`,
            orderCellsTop: true,
            autoWidth: true,
            aaSorting: [],
            order: [[1, 'desc']],
            "columnDefs": [
                {"bSortable": false, "targets": [0]},
                {"orderable": false, "targets": [0]},
                {"visible":   false, "targets": 'detail'},
                {"orderable": false, "targets": 'no-sort'},
                {"searchable":false, "targets": [0]}
            ],
            lengthMenu: [[100, 200, 300, 500, -1], [100, 200, 300, 500, "All"]],
            pageLength: 100,
            pagingType: "full_numbers",
            language: {
                search: `<div class="input-icon input-icon-right">_INPUT_<span><i class="flaticon2-search-1 icon-md"></i></span></div>`,
                zeroRecords: "Aucun enregistrement correspondant",
                searchPlaceholder: 'Mot clef...',
                lengthMenu: '<span>Afficher:</span> _MENU_',
                info: " _START_ - _END_ / _TOTAL_ ",
                infoFiltered: "...",
                infoEmpty: "aucun enregistrement correspondant",
                paginate: {
                    'first': '<i class="fas fa-chevron-double-left"></i>',
                    'last': '<i class="fas fa-chevron-double-right"><i>',
                    'previous': '<i class="fas fa-chevron-left"></i>',
                    'next': '<i class="fas fa-chevron-right"></i>',

                },
                'loadingRecords': '&nbsp;Chargement...',
                processing: '<i class="fa fa-refresh fa-spin"></i>'
            },
            buttons: {
                dom: {
                    button: {
                        tag: 'button',
                        className: 'btn btn-icon btn-sm btn-light'
                    }
                },
                buttons: [
                    {
                        extend: 'colvis',
                        columns: ':not(.noVis)'
                    },
                    {
                        extend: 'copy',
                        text: '<i class="far fa-copy"></i>',
                        className: '',
                        titleAttr: 'copier dans le presse papier'
                    },
                    {
                        extend: 'pdf',
                        text: '<i class="far fa-file-pdf"></i>',
                        className: '',
                        titleAttr: 'exporter vers pdf'
                    },
                    {
                        extend: 'excel',
                        text: '<i class="far fa-file-excel"></i>',
                        className: '',
                        titleAttr: 'exporter vers excel'
                    },
                ]
            },
            fnInitComplete:function(){
                //masquer les boutons liés aux checkbox
                $('[if-checked]').addClass('d-none')
            },
            createdRow: function ( row, data, index ) {
                /*if ( data[5].replace(/[\$,]/g, '') * 1 > 150000 ) {
                    $('td', row).eq(5).addClass('highlight');
                }*/
            },
            drawCallback: function( settings, start, end, max, total, pre ) {
            },
            fnServerParams: function(data) {
                data['order'].forEach(function(items, index) {
                    data['order'][index]['column'] = data['columns'][items.column]['data'];
                });
            },
        }
    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////
    var Plugin = {
        /**
         * Construct
         */
        construct: function(options) {
            Plugin.init(options);
            Plugin.build();
            return the;
        },
        init: function(options) {
            the.options = Object.assign({}, defaultOptions, options);
            the.options.drawCallback = function( settings, start, end, max, total, pre ) {
                var api = this.api();
                var fnRecordsTotal = this.fnSettings().fnRecordsTotal()
                if(!isset(the.options.record_count_class))
                {
                    the.options.record_count_class = element.replace('#', '.')+ '_count'
                }
                $(the.options.record_count_class).html(fnRecordsTotal)
            },
            the.trActiveClass = 'bg-light-success';
            the.trHiddenClass = 'd-none';
            the.table = $(element)
            the.url = $(element).data('url')

            if(the.url){
                the.options.ajax = {
                    url:the.url,
                    type:'POST'
                }
            }

            the.dataTable = the.table.DataTable(the.options);
            the.tableWrapper = the.table.parents('.dataTables_wrapper');
        },
        build: function() {
            if ($.fn.select2) {
                the.tableWrapper.find('select').select2({
                    minimumResultsForSearch: Infinity,
                    dropdownAutoWidth: false,
                    width: '60'
                });
            }
            $('.form-control-sm').removeClass('form-control-sm');
            $('.group-checkable', the.tableWrapper).on('change', function() {
                var checked = $(this).is(':checked');
                the.tableWrapper.find('.checkable').each(function() {
                    if (checked) {
                        $(this).prop('checked', true);
                        $(this).closest('tr').addClass(the.trActiveClass);
                    }
                    else {
                        $(this).prop('checked', false);
                        $(this).closest('tr').removeClass(the.trActiveClass);
                    }
                });
                $('[if-checked]').toggleClass(the.trHiddenClass, !checked )
            })
            the.table.on('change', 'tbody tr td input[type="checkbox"].checkable', function() {
                $(this).parents('tr').toggleClass(the.trActiveClass);
                var set = $(this).closest('table').find('tr td input[type="checkbox"].checkable');
                let checked = $(this).closest('table').find('tr > td input[type="checkbox"].checkable:checked');
                $('[if-checked]').toggleClass(the.trHiddenClass, checked.length <= 0)
                $('.group-checkable', the.table).prop("checked",(set.length == checked.length))
            });
            //

        },
    }
    //////////////////////////
    // ** Public Methods ** //
    //////////////////////////
    /**
     * Set default options
     */

    the.setDefaults = function(options) {
        defaultOptions = options;
    };
    /**
     * Go to the next step
     */
    the.fetchFormules = function(eventHandle) {
        if(Plugin.getFormuleId() > 0){
            return false
        }
        var birthdates = [];
        $(".devis_assure_date").each(function(){
            birthdates.push(this.value);
        });
        return Plugin.fetchFormules(
            Plugin.getPaysDestination(),
            Plugin.getDuree(),
            birthdates,
            eventHandle);
    };
    the.run = function() {

    };
    // Construct plugin
    Plugin.construct.apply(the, [options]);
    //
    return the;
};
jQuery(document).ready(function () {
    new Datagrid('.datagrid',{
        scrollY:        '50vh',
        scrollCollapse: true,
        paging:         false,
        responsive: true
    });
});
