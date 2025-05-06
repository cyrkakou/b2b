Apps.modal('#form_role_create',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
Apps.modal('#form_role_update',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var role_id = button.data('role_id')
        modal.find('[name="primary_key"]').val(role_id)
        axios.post(BASE_URL + '/auth/roles/do_find/' + role_id)
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
Apps.modal('#form_role_delete',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="primary_key"]').val(button.data('role_id'))
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
