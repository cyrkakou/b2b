Apps.modal('#form_component_create',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
Apps.modal('#form_component_update',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var component_id = button.data('component_id')
        modal.find('[name="primary_key"]').val(component_id)
        axios.post(BASE_URL + '/auth/components/do_find/' + component_id)
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
Apps.modal('#form_component_delete',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="primary_key"]').val(button.data('component_id'))
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
