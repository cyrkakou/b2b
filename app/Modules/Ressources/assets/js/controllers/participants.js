Apps.modal('#participant_preview', {
    onLoad: function (modal, event) {
        var button = $(event.relatedTarget)
        var participantCode = button.data('participantcode')
        modal.find('[name="code"]').val(participantCode)
        axios.post(`${BASE_URL}/ressources/participants/do_find/${participantCode}`)
            .then(function (response) {
                // handle success
                //console.log(response);
                $.each(response.data, function (name, value) {
                    if(name == 'is_membre') {
                        switch (value){
                            case '0':
                                value='non';
                            break;

                            case '1':
                                value='oui';
                            break;
                        }
                    }
                    modal.find('[name="' + name + '"]').val(value).change()
                });
            })
    },
    onSubmit: function (response, event) {
        location.reload()
    }
})

Apps.modal('#participant_update', {
    onLoad: function (modal, event) {
        var button = $(event.relatedTarget)
        var participantCode = button.data('participantcode')
        modal.find('[name="code"]').val(participantCode)
    },
    onSubmit: function (response, event) {
        location.reload()
    }
})


Apps.modal('#participant_cancel', {
    onLoad:function(modal, event){
        var button = $(event.relatedTarget)
        modal.find('[name="code"]').val(button.data('participantcode'))
    },
    onSubmit: function (response, event) {
        location.reload()
    }
})


jQuery(document).ready(function() {
    $('#passport_expire').inputmask({
        alias: "datetime",
        "clearIncomplete": true ,
        inputFormat:"dd/mm/yyyy",
        placeholder:"jj/mm/aaaa",
        min: moment("08/10/2023", 'DD/MM/YYYY',true).add(1, 'days').format('DD/MM/YYYY')
    })

    $('#passport_delivery').inputmask({
        alias: "datetime",
        "clearIncomplete": true ,
        inputFormat:"dd/mm/yyyy",
        placeholder:"jj/mm/aaaa",
        max: moment().format('DD/MM/YYYY')
    })
});

