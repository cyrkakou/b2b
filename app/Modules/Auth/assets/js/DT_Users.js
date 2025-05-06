jQuery(document).ready(function(){
    var column = 0;
    new Datagrid('#DT_users',{
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        scrollY: "350px",
        //paging: false,
        order: [],
        ajax: {
            url:$('#DT_users').data('url'),
            type:'POST'
        },
        columnDefs: [{
            targets:'no-sort',
            orderable: false,
        },{
            targets: -1,
            responsivePriority: -1,
            orderable: false,
            bSortable: false,
            className:'text-center',
            data: 'user_id',
            render: function(data, type, row, meta) {
                html = `<div class="dropdown">\
                    <a href="javascript:;" class="btn btn-sm btn-light-primary btn-icon btn-icon-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                    <i class="ki ki-bold-more-hor"></i>\
                    </a>\
                    <div class="dropdown-menu dropdown-menu-right">\
                    <ul class="navi navi-hover">
                    <li class="navi-item">
                    <a class="navi-link" href="${BASE_URL}security/users/ShowLog/${row.user_id}">
                    <i class="navi-icon fad fa-user-secret"></i> <span class="navi-text">Audit</span></a>\
                    </li>
                    <li class="navi-item">
                    <a href="javascript:;" data-toggle="modal"
                           data-target="#form_user_update"
                           data-user_id="${row.user_id}" 
                           class="navi-link" >
                    <i class="navi-icon fad fa-pencil"></i> <span class="navi-text text-nowrap">Mettre à jour</span></a>\
                    </li>
                    <li class="navi-item">
                        <a href="javascript:;" data-toggle="modal"
                           data-target="#form_user_delete"
                           data-user_id="${row.user_id}" 
                           class="navi-link">
                        <span class="navi-icon">
                            <i class="fad fa-trash text-danger"></i>
                        </span>
                            <span class="navi-text text-danger">Supprimer</span>
                        </a>                    
                    </li>
                    </ul>                    
                    </div>
                    </div>`
                return html;
                //<a class="dropdown-item" href="' + BASE_URL + 'security/users/showInfo/' + row.user_id + '"><i class="far fa-eye"></i> Aperçu</a>\
            },
        },{
            responsivePriority: -1,
            targets: column++,
            data: 'user_id',
            orderable: false,
            bSortable: false,
            searchable: false,
            render: function(data, type, row, meta) {
                return `<label class="checkbox checkbox-outline checkbox-outline-2x checkbox-primary checkbox-single">
                    <input name="selected[]" value="${ row.user_id }" type="checkbox" value="" class="checkable">
                    <span></span>
                    </label>`;
            }
        },{
            responsivePriority: 1,
            targets: column++,
            data: 'user_login',
            render: function(data, type, row, meta) {
                return row.user_login
            }
        },{
            responsivePriority: -1,
            targets: column++,
            data: 'user_nicename',
            render: function(data, type, row, meta) {
                return `<div class="d-flex align-items-center mb-2">
                    <div class="symbol symbol-40 symbol-light-success mr-2">
                    <div class="symbol-label">
                    <img src="${ BASE_URL }assets/media/svg/avatars/004-boy-1.svg" class="h-75 align-self-end" alt="">
                    </div>
                    </div>
                    <div class="d-flex flex-column font-weight-bold">
                    <a href="#" class="text-dark text-hover-primary mb-1 font-size-lg">${ row.user_nicename }</a>
                <span class="text-muted">${ row.user_email }</span>
                </div>
                </div>`
            }
        },{
            responsivePriority: 6,
            targets: column++,
            data: 'user_phone',
            render: function(data, type, row, meta) {
                return phone(row.user_phone,COUNTRY_CODE )
            }
        },{
            targets: column++,
            data: 'user_registered',
            render: function(data, type, row, meta) {
                moment.locale('fr')
                var heure = moment.unix(row.user_registered).format('DD/MM/YY');
                return '<a href="javascript:;" class="text-nowrap"'
                    + 'data-toggle="kt-tooltip" data-placement="right" title="'
                    + moment.unix(row.user_registered).format('LLL')
                    + '"><i class="fad fa-calendar-day mr-1"></i>' + heure + '</a>'
            }
        },{
            responsivePriority: -1,
            targets: column++,
            className:'text-center',
            data: 'user_status',
            render: function(data, type, row, meta) {
                return `<span class="label label-lg label-light-${ row.status_css } label-inline">${ row.status_name }</span>`
            }
        },{
            responsivePriority: 5,
            targets: column++,
            className:'text-left',
            data: 'role_name',
            render: function(data, type, row, meta) {
                return row.role_name
            }
        }]
    });
})
