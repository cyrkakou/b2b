Apps.modal('#form_medecin_create',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
    },
    onSubmit:function (response,event) {
        console.log(response)
        location.reload()
    }
})
Apps.modal('#form_medecin_update',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        var medecin_id = button.data('medecin_id')
        modal.find('[name="primary_key"]').val(medecin_id)
        axios.post(BASE_URL + '/medecin/medecin/do_find/' + medecin_id)
            .then(function (response) {
                console.log(response)
                // handle success
                $.each(response.data, function(name, value) {
                    modal.find('[name="' + name +'"]').val(value).change()
                });
            })
    },
    onSubmit:function (response,event) {
        console.log(response)
        location.reload()
    }
})
Apps.modal('#form_medecin_delete',{
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="primary_key"]').val(button.data('medecin_id'))
    },
    onSubmit:function (response,event) {
        location.reload()
    }
})
