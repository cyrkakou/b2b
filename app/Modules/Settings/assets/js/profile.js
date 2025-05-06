$(document).ready(function () {
    Apps.modal('#modal_profile_create',{
        onLoad:function(modal, event){
            var button = $(event.relatedTarget)
        },
        onSubmit:function (response,event) {
            alert('ici');
            console.log(response)
            location.reload()
        }
    })
})