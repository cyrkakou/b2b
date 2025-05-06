$(document).ready(function () {
    Apps.reorder("#garanties__sortable",function(event, ui){
        var target = $(event.target)
        $.ajax({
            method: "POST",
            url: BASE_URL + 'settings/garanties/do_sort',
            data:target.sortable( "serialize", { key: "items[]" } ),
            success:function(data){
                $.notify({
                    icon: 'icon fa fa-exclamation-circle',
                    title: 'Information !',
                    message: 'vos données ont étés mises à jour'
                },{
                    // settings
                    type: 'success',
                    allow_dismiss: true,
                    newest_on_top: true,
                    showProgressbar: true,
                });
            }
        })
    })
})