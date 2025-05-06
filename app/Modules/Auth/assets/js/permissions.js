Apps.modal('#form_permission_create',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
Apps.modal('#form_permission_update',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var permission_id = button.data('permission_id')
        modal.find('[name="primary_key"]').val(permission_id)
        axios.post(BASE_URL + '/auth/permissions/do_find/' + permission_id)
            .then(function (response) {
                // handle success
                $.each(response.data, function(name, value) {
                    modal.find('[name="' + name +'"]').val(value).change()
                });
            })
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
Apps.modal('#form_permission_delete',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="primary_key"]').val(button.data('permission_id'))
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
