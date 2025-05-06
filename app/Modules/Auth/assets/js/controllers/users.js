Apps.modal('#form_user_create',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('input[type="text"]').val('')
        modal.find('input[type="password"]').val('')
        modal.find('input[type="email"]').val('')
    },
    onSubmit:function (response, event) {
        location.reload()
    }
})
Apps.modal('#form_user_update',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        modal.find('[name="primary_key"]').val(user_id)
        axios.post(BASE_URL + '/auth/users/find/' + user_id)
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
Apps.modal('#form_user_delete',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var user_id = button.data('user_id')
        modal.find('[name="primary_key"]').val(user_id)
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
Apps.modal('#form_history_empty',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="primary_key"]').val(button.data('user_id'))
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
