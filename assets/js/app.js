'use strict';
var modalHeightOffset = 91
/* PHONE FORMATER */
let phone_mask = {
    SN:"99-999-99-99",
    CI:"99-99-99-99-99",
    GN:"999-99-99-99"
}

var dateIso = function(date){
    var pattern = /^(\d{1,2})\/(\d{1,2})\/(\d{4})$/;
    var arrayDate = date. match(pattern);
    return (new Date(arrayDate[3], arrayDate[2]-1, arrayDate[1]))
}

Date.prototype.compare = function(b) {
    if (b.constructor !== Date) {
        throw "invalid_date";
    }
    return (isFinite(this.valueOf()) && isFinite(b.valueOf()) ?
            (this>b)-(this<b) : NaN
    );
};

const if_exist = (element) => {

    return $(element).length
}

var getElement = function(field)
{
    if($('input[name="' + field + '"]').length ){
        return $('input[name="' + field + '"]')
    }else if($('#' + field).length){
        return  $('#' + field)
    }else if($('.' + field).length){
        return  $('.' + field)
    }else {
        return $(field)
    }
}
const phone_format = (country_code) => {
    const n = String(country_code).toUpperCase()
    return phone_mask[n];
}
const thousand = num => {
    const n = String(num),
        p = n.indexOf('.')
    return n.replace(
        /\d(?=(?:\d{3})+(?:\.|$))/g,
        (m, i) => p < 0 || i < p ? `${m} ` : m
    )
}
/* is a variable set */
const isset = (ref) => {
    return (!!ref)
}
var trim = function(str)
{
    return (typeof str !== 'undefined')?String(str).replace(/\s+/g, ''):'';
}
function random_email(length)
{
    var chars = 'abcdefghijklmnopqrstuvwxyz1234567890';
    var string = '';
    for(var ii=0; ii<length; ii++){
        string += chars[Math.floor(Math.random() * chars.length)];
    }
    return string
}
function random_password(length)
{
    var password = '', character;
    while (length > password.length) {
        if (password.indexOf(character = String.fromCharCode(Math.floor(Math.random() * 94) + 33), Math.floor(password.length / 94) * 94) < 0) {
            password += character;
        }
    }
    return password;
}

function password_strength(element){
    var el = getElement(element)
    var progressbar = getElement(el.data('progressbar'))
    var strength = [
        'trés mauvais',
        'Mauvais',
        'Faible',
        'Bon',
        'Trés bon'
    ]
    var color = {
        0: "bg-danger",
        1: "bg-pink",
        2: "kt-bg-warning",
        3: "kt-bg-primary",
        4: "kt-bg-success"
    }
    progressbar.html('');
    $(el).on('keyup',function(){
        var result = zxcvbn($(this).val());
        progressbar.css({width:(Math.round(100/strength.length)*(1 + result.score)) + '%'});
        progressbar.removeClass('bg-danger bg-pink kt-bg-warning  kt-bg-primary kt-bg-success').addClass(color[result.score])
        progressbar.html(strength[result.score]);
    })
}


var repaint_modal = function(){
    $('.right .modal-body').height($( window ).height() - 120 - modalHeightOffset)
}





class Yesha {
    constructor() {
        console.log('yesha is loaded')
        //
        autosize($('[autosize]'));
        //
        $('[data-href]').on('click',function () {
            location.href = $(this).data('href')
        })
        $('[data-model="formula"]').alphanum({
            allow: '(+-.*/_)',
            allowSpace: false,
            allowUpper: false,
            allowOtherCharSets:false
        });
        $(document).on('click','[data-document_pdf]',function(){
            $('#printing_frame').remove()
            $(`<div id="printing_frame" class="modal fade " tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
                    <div class="modal-content rounded">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-print mr-3"></i>Imprimer <span class="document-title"></span></h5>
                            <button class="btn btn-default btn-icon btn-sm btn-light btn-hover-primary" data-toggle="tooltip" title="" data-original-title="Fermer"  data-dismiss="modal">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </button>
                        </div>
                        <div class="modal-body bg-light p-0 pb-6">
                            <iframe src="about:blank" style="width: 100%; height: 500px;" class="border-0  bg-dark"></iframe>
                        </div>
                    </div>
                </div>
            </div>`).appendTo('body')
            KTApp.blockPage({
                overlayCSS:  {
                    backgroundColor: '#000',
                    opacity:         1,
                    cursor:          'wait',
                    zIndex:9999,
                },
                overlayColor: '#000000',
                state: 'danger',
                message: 'Please wait...'
            });
            $('#printing_frame').find('iframe').on('load', function() {
                $('#printing_frame').modal('show')
                KTApp.unblockPage();
            });
            if($(this).data('document_pdf') != BASE_URL){
                $('#printing_frame').find('iframe').attr('src', $(this).data('document_pdf')).removeClass('d-none');
            }
        });
        $('#modal_print_iframe').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var href = button.data('src') // Extract info from data-* attributes
            var modal = $(this)
            modal.find('iframe').attr('src', href).removeClass('d-none');
        })
        //
        $(document).on({
            'show.bs.modal': function() {
                if($(this).find('.modal-footer').length <=0 ){
                    modalHeightOffset = 0;
                }
                repaint_modal()
                var zIndex = 1040 + (10 * $('.modal:visible').length);
                $(this).css('z-index', zIndex);
                setTimeout(function() {
                    $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
                }, 0);
            },
            'hidden.bs.modal': function() {
                if ($('.modal:visible').length > 0) {
                    // restore the modal-open class to the body element, so that scrolling works
                    // properly after de-stacking a modal.
                    setTimeout(function() {
                        $(document.body).addClass('modal-open');
                    }, 0);
                }
            }
        }, '.modal');
        //
        $( window ).resize(function() {
            repaint_modal()
        });
    }
    show_pdf(src){
        $('#printing_frame_x1').remove()
        $(`<div id="printing_frame_x1" class="modal fade " tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false" >
                <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
                    <div class="modal-content rounded">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-print mr-3"></i>Imprimer <span class="document-title"></span></h5>
                            <button class="btn btn-default btn-icon btn-sm btn-light btn-hover-primary" data-toggle="tooltip" title="" data-original-title="Fermer"  data-dismiss="modal">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </button>
                        </div>
                        <div class="modal-body bg-light p-0 pb-6">
                            <iframe src="about:blank" style="width: 100%; height: 500px;" class="border-0  bg-dark"></iframe>
                        </div>
                    </div>
                </div>
            </div>`).appendTo('body')
        $('#printing_frame_x1').find('iframe').on('load', function() {
            $('#printing_frame_x1').modal('show')
        });
        $('#printing_frame_x1').find('iframe').attr('src', src)
    }



    pdf_iframe(){
        $('iframe[name="pdf_iframe_preview"]').on('load', function() {
            $(this).parents('.modal').modal('show')
        });
    }
    use(url, callback){
        var ext = url.slice((url.lastIndexOf(".") - 1 >>> 0) + 2)
        if(ext!='css'){
            var script = document.createElement("script")
            script.type = "text/javascript";

        }else{
            var script = document.createElement("link")
            script.rel = "stylesheet";
            script.type = "text/css";
        }
        if (script.readyState){  //IE
            script.onreadystatechange = function(){
                if (script.readyState == "loaded" ||
                    script.readyState == "complete"){
                    script.onreadystatechange = null;
                    if(typeof callback == 'function'){
                        callback();
                    }
                }
            };
        } else {  //Others
            script.onload = function(){
                if(typeof callback == 'function'){
                    callback();
                }
            };
        }
        if(ext!='css'){
            script.src = url;
        }else {
            script.href = url;
        }
        document.getElementsByTagName("head")[0].appendChild(script);
    }
    search(element){
        $(element).on('keyup blur',function (event) {
            var keyword = new RegExp( $(this).val(),'gi')
            var item = $(this).data('criteria')
            if($(this).val().length > 0)
            {
                $('[data-' + item +']').each(function()
                {
                    if(keyword.test($(this).data(item))!==false)
                    {
                        $(this).removeClass('d-none');
                    }else{
                        $(this).addClass('d-none');
                    }
                })
            } else {
                $('[data-' + item +']').removeClass('d-none');
            }
            event.preventDefault();
        })
    }
    reorder(element,callback) {
        $(element).sortable({
            placeholder: "ui-state-highlight",
            handle:'.handle',
            cursor: "move",
            containment: "parent",
            opacity: 0.5,
            update:function(event, ui){
                if(typeof callback == 'function'){
                    callback(event, ui)
                }
            }
        });
        $(element).disableSelection();
    }
    form(element, options){
        $(element).ajaxForm({
            beforeSubmit:function (args, $form, options){
                $form.find('[data-action="submit"]')
                    .addClass('spinner spinner-white spinner-right')
                    .attr('disabled',true)
            },
            error:function(msg){
                console.log(msg.responseText)
            },
            success:function (response, statusText, xhr, $form) {
                console.log(response)
                if(response.statut == 'success' || response.statut == 'error'){
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon:  (response.statut!='success')?'error':'success',
                        buttonsStyling: false,
                        //showCancelButton: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-default"
                        }
                    }).then(function(result) {
                        $form.find('[data-action="submit"]')
                            .removeClass('spinner spinner-white spinner-right')
                            .attr('disabled',false)
                        console.log(result.value)
                        if (result.value) {
                            if(typeof options.onSubmit == 'function')
                            {

                                options.onSubmit.apply(this,[response, statusText, xhr, $form, event])
                            }
                        }
                    });
                }
            }
        });
    }
    modal(element, options){
        var _default = {
            closeAfterSubmit:true
        };
        var modal = $(element)
        var button = {}
        var options = Object.assign({},_default,options);
        modal.on('show.bs.modal', function (event) {
            button = $(event.relatedTarget)
            if(typeof options.onLoad == 'function')
            {
                //options.onLoad.apply(modal,[modal.find('form'),event])
                options.onLoad.apply(modal,[modal,event])
            }
        })
        modal.on('hide.bs.modal', function (event) {
            if(typeof options.onClose == 'function')
            {
                //options.onLoad.apply(modal,[modal.find('form'),event])
                options.onClose.apply(modal,[modal,event])
            }
        })
        modal.on('hidden.bs.modal', function (event) {
            if(typeof options.afterClose == 'function')
            {
                //options.onLoad.apply(modal,[modal.find('form'),event])
                options.afterClose.apply(modal,[modal,event])
            }
        })
        modal.find('form').ajaxForm({
            error:function(msg){
            console.log(msg.responseText)
        },
            success:function (response, statusText, xhr, $form) {
                console.log(response)
                if(response.statut == 'success' || response.statut == 'error'){
                    Swal.fire({
                        title: response.title,
                        text: response.message,
                        icon:  (response.statut!='success')?'error':'success',
                        buttonsStyling: false,
                        //showCancelButton: false,
                        confirmButtonText: "OK",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-default"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            if(typeof options.onSubmit == 'function')
                            {
                                let fields = {}
                                $.each($form.serializeArray(), function( i, field ) {
                                    fields[field.name] = field.value
                                });
                                options.onSubmit.apply(modal,[response, {
                                    statusText:statusText,
                                    xhr:xhr,
                                    $form:$form,
                                    button:button,
                                    fields:fields
                                }])
                            }
                        }
                    });
                }
                if(options.closeAfterSubmit){
                    $($form).parents('.modal').modal('hide')
                }
            }
        });
    }
    gmap(options){
        var map,
            marker,
            bounds,
            geocoder,
            curPosition;
        var _default = {
            latitude_field:'#latitude',
            longitude_field:'#longitude',
        }
        var options = Object.assign({},options, _default)
        function get_current_position()
        {
            var options = {
                enableHighAccuracy: true,
                timeout: 5000,
                //maximumAge: 0
            };
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    handleLocationSuccess,
                    handleLocationError,
                    options
                );
            }
        }
        function handleLocationSuccess(position) {
            var lat = position.coords.latitude
            var lng = position.coords.longitude

            var infoWindow = new google.maps.InfoWindow({map: map});
            var pos = {lat: lat, lng: lng};
            /*if (Object.keys(curPosition).length > 0){
                curPosition.setMap(null)
            }*/
            infoWindow.setContent('Vous etes ici !.');
            curPosition = new google.maps.Marker({
                position: pos,
                map: map
            });
            infoWindow.open(map, curPosition);
            center = bounds.getCenter();
            //map.fitBounds(bounds);
            map.panTo(curPosition.getPosition());
            updateLatLng(curPosition)
        }
        function handleLocationError(err) {
            console.warn("ERROR" + err.code + ":" + err.message);
        }
        function updateLatLng(pnt)
        {
            $(options.latitude_field).val(pnt.getPosition().lat());
            $(options.longitude_field).val(pnt.getPosition().lng());
        }
        function geocodeAddress(ev, geocoder, map)
        {
            if(!geocoder) return;
            var $inp = getElement(ev.data('field')),
                address = $inp.val();
            if (address.length != 0)
            {
                $inp.prev().find('i').addClass('fa-spinner fa-spin');
                geocoder.geocode( { 'address': address}, function(results, status)
                {
                    $inp.prev().find('i').removeClass('fa-spinner fa-spin');
                    if(status == google.maps.GeocoderStatus.OK)
                    {
                        var lat = results[0].geometry.location.lat()
                        var lng= results[0].geometry.location.lng()

                        marker.setPosition(results[0].geometry.location)
                        marker.setAnimation(google.maps.Animation.BOUNCE);
                        bounds.extend(new google.maps.LatLng(lat, lng));
                        map.setZoom(parseInt($('[name="zoom"]').val())||8);
                        //map.fitBounds(bounds);//auto-zoom
                        map.panToBounds(bounds);//auto-center
                        map.setCenter(results[0].geometry.location);
                        updateLatLng(marker)
                        console.log('location found')
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        }
        function constructor() {
            if (!options.hasOwnProperty('latitude')) {
                options.latitude = LATITUDE

            }
            if (!options.hasOwnProperty('longitude')) {
                options.longitude = LONGITUDE
            }
            if (!options.hasOwnProperty('zoom')) {
                options.zoom = 12
            }
            console.log(options.longitude,options.latitude)
            var mapDiv = document.getElementById('map');
            bounds  = new google.maps.LatLngBounds();
            map = new google.maps.Map(mapDiv, {
                center: new google.maps.LatLng(
                    parseFloat(options.latitude),
                    parseFloat(options.longitude)
                ),
                zoom: options.zoom,
                streetViewControl: false,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                //disableDefaultUI: true,
                disableDoubleClickZoom: true,
                scrollwheel: false,
            });
            geocoder = new google.maps.Geocoder();
            marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(
                    options.latitude,
                    options.longitude
                ),
                draggable: true,
                animation: google.maps.Animation.BOUNCE
            });
            google.maps.event.addListener(marker, 'drag', function (event) {
                updateLatLng(this)
            });
            $('#address-search').on('click', function() {
                if(!map)return;
                geocodeAddress($(this),geocoder, map);
            });
            $("#map-unzoom").on('click', function(ev)
            {
                if(!map)return;
                ev.preventDefault();
                map.setZoom(map.getZoom() - 1);
                $('#zoom').val(map.getZoom())
            });
            $("#map-resetzoom").on('click', function(ev)
            {
                if(!map)return;
                ev.preventDefault();
                map.setZoom(12);
                $('#zoom').val(map.getZoom())
            });
            $("#map-zoom").on('click', function(ev)
            {
                if(!map)return;
                ev.preventDefault();
                map.setZoom(map.getZoom() + 1);
                $('#zoom').val(map.getZoom())
            });
            $('a[data-action="get_location"]').on('click', function(ev)
            {
                get_current_position();
            });
        }
        if(google && google.maps){
            google.maps.event.addDomListener(window, 'load', constructor);
        }
    }
}



var Apps = new Yesha();
Apps.search('[data-action="search"]')





KTUtil.ready(function() {






    $('[role="on-ready"]').removeClass('d-none').removeClass('kt-hidden')
    /* DATA TOGGLE */
    $('[data-toggle="password"]').on('click',function () {
        let field = $(this).data('field')
        let icon_on = $(this).data('icon-on')?$(this).data('icon-on'):'fa fa-eye-slash';
        let icon_off = $(this).data('icon-off')?$(this).data('icon-off'):'fa fa-eye';
        var element = $(field);
        if($('input[name="' + field + '"]').length ){
            element = $('input[name="' + field + '"]')
        }else if($(field).length){
            element = $(field)
        }
        $(this).find('i').removeClass().addClass((element.attr('type')!=='password')?icon_on:icon_off)
        element.attr('type',(element.attr('type')!=='password')?'password':'text')
    })
    /* EMAIL */
    $(document).on('click','[data-action="email"]',function ()
    {
        getElement($(this).data('field'))
            .val(random_email(6) + '@ibemscreative.io')
            .change()
    })
    $('[data-action="password"]').on('click',function () {
        getElement($(this).data('field')).val(random_password(10))
    })
    //
    if(typeof ClipboardJS !='undefined'){
        new ClipboardJS('[data-clipboard=true]').on('success', function(e) {
            e.clearSelection();
            alert('Copied!');
        });
    }
    var arrows;
    if (KTUtil.isRTL()) {
        arrows = {
            leftArrow: '<i class="la la-angle-right"></i>',
            rightArrow: '<i class="la la-angle-left"></i>'
        }
    } else {
        arrows = {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    }
    $('[data-action="date"]').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        language: "fr",
        autoclose: true,
        templates: arrows
    });
    $('[data-action="daterange"]').datepicker({
        rtl: KTUtil.isRTL(),
        todayHighlight: true,
        orientation: "bottom left",
        language: "fr",
        autoclose: true,
        templates: arrows
    });
/*
    $('[data-action="daterange"]').daterangepicker({
        drops:'up',
        buttonClasses: ' btn',
        applyClass: 'btn-primary',
        cancelClass: 'btn-secondary',
        "locale": {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Appliquer",
            "cancelLabel": "Annuler",
        }
    }, function(start, end, label) {
        $('#kt_daterangepicker_1 .form-control').val( start.format('DD/MM/YYYY') + '-' + end.format('DD/MM/YYYY'));
    });
*/


    /* INPUT MASK*/
    $('.mask-immatriculation').inputmask({
        "mask":"a{2}9{4}a{2,4}",
        "clearIncomplete": true
    })
    /* ALPHANUM  CHECK*/
    $.fn.alphanum.setNumericSeparators({
        thousandsSeparator: " ",
        decimalSeparator: "."
    });
    $('.double').numeric({
        allowMinus:true
    });
    $('.telephone').numeric({
        allowSpace: false,
        allowMinus:false,
        allowPlus:true
    });
    $(".number").numeric({
        allowPlus:    false,
        allowMinus:   false,
        allowThouSep: false,
        allowDecSep:  false
    });
    $('.integer').numeric('integer');
    $('.letter').alpha({
        allowSpace: false,
        allowOtherCharSets : false
    });
    $('.alpha-code').alphanum({
        allowSpace: false,
        allowOtherCharSets : false
    });
    $('.alpha-label').alphanum({
        allowSpace: true,
        disallow:''
    });

    $("input.mask-date").inputmask({
        alias: "datetime",
        "clearIncomplete": true ,
        inputFormat:"dd/mm/yyyy",
        placeholder:"jj/mm/aaaa"
    });
    $("input.mask-pin").inputmask({"mask":"999999","clearIncomplete": true })
    $("input.mask-phone").inputmask({"mask":"99-999-99-99","clearIncomplete": true})
    $("input.mask-phone-sn").inputmask({"mask":"99-999-99-99","clearIncomplete": true})
    $("input.mask-phone-ci").inputmask({"mask":"99-99-99-99-99","clearIncomplete": true})
    $("input.mask-phone-gn").inputmask({"mask":"999-99-99-99","clearIncomplete": true})
    /* SELECT2 JS*/
    $('.select2-simple').select2({
        "language": LANGUAGE,
        minimumResultsForSearch: -1
    })
    $('.select2-with-search').select2({
        "language": LANGUAGE
    })
    $('.select2-with-clear').select2({
        "language": LANGUAGE,
        minimumResultsForSearch: Infinity
    })
    $('.select2-with-search-clear').select2({
        allowClear: true,
        "language": LANGUAGE
    });
    $('[data-switch="true"]').not('[data-switch-no-init]').bootstrapSwitch().change()
    password_strength('user_pwd');
});
