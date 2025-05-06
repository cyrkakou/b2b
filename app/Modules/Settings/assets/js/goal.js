$(document).ready(function () {
    Apps.modal('#modal_goal_create',{
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