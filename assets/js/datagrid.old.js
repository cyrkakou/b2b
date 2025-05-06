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
    let match = cleaned.match(phone_mask[isset(code)?code:'GN']);
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
var KT_Datagrid = function () {
    var get = function(field)
    {
        if($('input[name="' + field + '"]').length ){
            return $('input[name="' + field + '"]')
        }else if($('#' + field).length){
            return  $('#' + field)
        }else if($('.' + field).length){
            return  $('.' + field)
        }else {
            return $(field)
        }
    }
    var initTable = function (options) {
    var html = '<div class="kt-input-icon kt-input-icon--left">\
            _INPUT_\
            <span class="kt-input-icon__icon kt-input-icon__icon--left">\
            <span><i class="la la-search"></i></span>\
        </span>\
        </div>'
        var fnRecordsTotal = 0
        var cfg =
            {
                "bStateSave": true,
                colReorder: true,
                container:'.datagrid',
                record_count_class:'datagrid-record-count',
                responsive: {
                    details: {
                        type: 'detail'
                    }
                },
                serverFiltering: false,
                serverSorting: false,
                // DOM Layout settings
                dom: '<"row datatable-header p-2"<"col-sm-12 col-md-6"f><"col-sm-12 col-md-6"Bl>><t>' +
                    '<"row datatable-footer p-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6 text-right dataTables_pager"p>>',
                orderCellsTop: true,
                autoWidth: false,
                aaSorting: [],
                //order: [],
                order: [[1, 'desc']],
                //"order": [[0, "desc"]],
                "columnDefs": [
                    {"bSortable": false, "targets": [0]},
                    {"orderable": false, "targets": [0]},
                    {"visible": false, "targets": 'detail'},
                    {"orderable": false, "targets": 'no-sort'},
                    {"searchable": false, "targets": [0]}
                ],
                lengthMenu: [[100, 200, 300, 500, -1], [100, 200, 300, 500, "All"]],
                pageLength: 100,
                pagingType: "full_numbers",
                language: {
                    search: html,
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
                            className: 'btn btn-icon btn-sm btn-label-brand'
                        }
                    },
                    buttons: [
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
                    $('[if-multiple]').addClass('kt-hidden')
                },
                createdRow: function ( row, data, index ) {
                    /*if ( data[5].replace(/[\$,]/g, '') * 1 > 150000 ) {
                        $('td', row).eq(5).addClass('highlight');
                    }*/
                },
                drawCallback: function( settings, start, end, max, total, pre ) {
                    var api = this.api();
                    fnRecordsTotal = this.fnSettings().fnRecordsTotal()
                    get(options.record_count_class).html(fnRecordsTotal)
                },
                fnServerParams: function(data) {
                    data['order'].forEach(function(items, index) {
                        data['order'][index]['column'] = data['columns'][items.column]['data'];
                    });
                },
            }
        var options = $.extend({}, cfg, options);
        var table = $(options.container)

        // begin first table
        var oTable = table.DataTable(options);
        var record_count_class = table.data('recordcount')
        var tableWrapper = table.parents('.dataTables_wrapper');
        table.on('change', '.kt-group-checkable', function(event) {
            event.preventDefault();
            var set = $(this).closest('table').find('.kt-checkable');
            var checked = $(this).is(':checked');
            $(set).each(function() {
                if (checked) {
                    $(this).prop('checked', true);
                    $(this).closest('tr').addClass('active');
                }
                else {
                    $(this).prop('checked', false);
                    $(this).closest('tr').removeClass('active');
                }
            });
            $('[if-multiple]').toggleClass('kt-hidden', !checked )
        });
        table.on('change', 'input[type="checkbox"].kt-checkable', function() {
            $(this).parents('tr').toggleClass('active');
            var set = $(this).closest('table').find('input[type="checkbox"].kt-checkable');
            let checked = $(this).closest('table').find('input[type="checkbox"].kt-checkable:checked');
            $('[if-multiple]').toggleClass('kt-hidden', checked.length <= 0)
            $('.kt-group-checkable', table).prop("checked",(set.length == checked.length))
        });
        table.on( 'mouseenter', 'td', function () {
            return
            var tr = $(this).parent('tr').addClass( 'highlight bg-orange' );
            var colIdx = oTable.cell(this).index().column;
            $( oTable.cells().nodes() ).removeClass( 'highlight bg-orange' );
            $( oTable.column( colIdx ).nodes() ).addClass( 'highlight bg-orange' );
        } );
        if ($.fn.select2) {

            //tableWrapper.find('select').addClass('custom-select custom-select-sm')
            /*
            tableWrapper.find('select').select2({
                minimumResultsForSearch: Infinity,
                dropdownAutoWidth: true,
                width: '60'
            });*/
        }
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

    };
    return {
        //main function to initiate the module
        init: function (option) {
            initTable(option);
        },
    };
}();

$(document).ready(function () {
    KT_Datagrid.init()
})