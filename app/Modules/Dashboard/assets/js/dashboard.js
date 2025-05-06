let
    markers = [],
    bounds,
    geocoder,
    curPosition,
    map_save = {}
;
const infowindow = new google.maps.InfoWindow();
let load_map = function (url){
    map.data.forEach(function(feature) {
        map.data.remove(feature);
    });
    map.data.loadGeoJson(
        url,{},
        function(features){
            var _markers = features.map(function (feature) {
                var g = feature.getGeometry();
                if(g.getType().toLowerCase() == 'point'){
                    var marker = new google.maps.Marker({
                        'position': g.get(0),
                        'title': "Hello World!",
                        'icon': feature.getProperty('icon')
                    });

                    marker.addListener("click", (e) => {
                        alert(12)
                        console.log(e.latLng)
                        map.panTo(e.latLng);
                        infoBox(feature)
                    });
                    return marker;
                }
            });
            //console.log(markers[0].i)
            $('#kt_subheader .subtitle').html(`${_markers.length} supports trouvés`)
            if(_markers.length <= 0){
                Swal.fire({
                    title: "Attention",
                    text: "Cette campagne ne contient aucune affiche",
                    icon: "warning",
                    confirmButtonText: "OK"
                })
            }
        }
    );
}
let save_map = function(){
    map.data.toGeoJson(function (json) {
        map_save = JSON.stringify(json)
    });
}
let clear_map = function (map){
    map.data.forEach(function (f) {
        map.data.remove(f);
    });
}
let infoBox = function(options){
    $('#infoWindow').remove()
    let html = ''
    let comments = ''
    let gallery = ''
    let screen = ''
    const images = options.getProperty("images");
    const label = options.getProperty("label");
    const promotionID = options.getProperty("promotionID");
    const promoteurID = options.getProperty("promoteurID");
    const promoteur = options.getProperty("promoteur");
    const promotion = options.getProperty("promotion");
    const ville = options.getProperty("ville");
    const date_deb = options.getProperty("date_deb");
    const superficie = options.getProperty("superficie");
    const nombre_logement = options.getProperty("nombre_logement");
    const standing = options.getProperty("standing");
    const avancement = options.getProperty("avancement");
    const prix = options.getProperty("prix");

    if(images){
        screen = `<img src=" ${ BASE_URL }${images[0].imageSrc}" alt="" class="img-fluid">`
        gallery+=`<div class="separator separator-dashed"></div>`
        gallery+=`<div class="card-body">`
        gallery+=`<div class="row spotlight-group" data-animation="scale">`
        $.each(images, function(index, item) {
            gallery+=`
                <div class="col-6">
                    <div class="card card-custom overlay shadow-sm gutter-b card-border">
                        <div class="card-body p-0">
                            <div class="overlay-wrapper">
                                <img id="${ item.imageID }" src="${ BASE_URL }${ item.imageSrc }" alt="${ item.imageSrc }" class="w-100 rounded">  
                            </div>
                            <div class="overlay-layer align-items-end justify-content-end pb-5 pr-5">
                                <a data-src="${ BASE_URL }${ item.imageSrc }" data-media="image" data-description="${localisation}" class="btn btn-sm btn-white btn-icon spotlight">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <polygon points="0 0 24 0 24 24 0 24"/>
                                                <path d="M10.5857864,12 L5.46446609,6.87867966 C5.0739418,6.48815536 5.0739418,5.85499039 5.46446609,5.46446609 C5.85499039,5.0739418 6.48815536,5.0739418 6.87867966,5.46446609 L12,10.5857864 L18.1923882,4.39339828 C18.5829124,4.00287399 19.2160774,4.00287399 19.6066017,4.39339828 C19.997126,4.78392257 19.997126,5.41708755 19.6066017,5.80761184 L13.4142136,12 L19.6066017,18.1923882 C19.997126,18.5829124 19.997126,19.2160774 19.6066017,19.6066017 C19.2160774,19.997126 18.5829124,19.997126 18.1923882,19.6066017 L12,13.4142136 L6.87867966,18.5355339 C6.48815536,18.9260582 5.85499039,18.9260582 5.46446609,18.5355339 C5.0739418,18.1450096 5.0739418,17.5118446 5.46446609,17.1213203 L10.5857864,12 Z" fill="#000000" opacity="0.3" transform="translate(12.535534, 12.000000) rotate(-360.000000) translate(-12.535534, -12.000000) "/>
                                                <path d="M6,18 L9,18 C9.66666667,18.1143819 10,18.4477153 10,19 C10,19.5522847 9.66666667,19.8856181 9,20 L4,20 L4,15 C4,14.3333333 4.33333333,14 5,14 C5.66666667,14 6,14.3333333 6,15 L6,18 Z M18,18 L18,15 C18.1143819,14.3333333 18.4477153,14 19,14 C19.5522847,14 19.8856181,14.3333333 20,15 L20,20 L15,20 C14.3333333,20 14,19.6666667 14,19 C14,18.3333333 14.3333333,18 15,18 L18,18 Z M18,6 L15,6 C14.3333333,5.88561808 14,5.55228475 14,5 C14,4.44771525 14.3333333,4.11438192 15,4 L20,4 L20,9 C20,9.66666667 19.6666667,10 19,10 C18.3333333,10 18,9.66666667 18,9 L18,6 Z M6,6 L6,9 C5.88561808,9.66666667 5.55228475,10 5,10 C4.44771525,10 4.11438192,9.66666667 4,9 L4,4 L9,4 C9.66666667,4 10,4.33333333 10,5 C10,5.66666667 9.66666667,6 9,6 L6,6 Z" fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg>
                                    </span>                                
                                </a>                              
                            </div>
                        </div>
                    </div>                
                </div>`
        });
        gallery+=`</div>`
        gallery+=`</div>`
    }
    html+=`<ul class="navi navi-hover navi-active">`
    if(promotion){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;">
                    <span class="navi-icon"><i class="flaticon2-analytics"></i></span>
                    <span class="navi-text font-weight-bolder">Nom</span>
                    <span class="navi-label">
                        ${ promotion }
                    </span>
                </a>
            </li>`
    }
    if(ville){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;" >
                    <span class="navi-icon"><i class="fad fa-tasks"></i></span>
                    <span class="navi-text font-weight-bolder">VILLE</span>
                    <span class="navi-label">
                        ${ ville }
                    </span>
                </a>
            </li>`
    }
    if(superficie){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;" >
                    <span class="navi-icon"><i class="fad fa-tasks"></i></span>
                    <span class="navi-text font-weight-bolder">Superficie</span>
                    <span class="navi-label">
                        ${ superficie }
                    </span>
                </a>
            </li>`
    }
    if(nombre_logement){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;" >
                    <span class="navi-icon"><i class="fad fa-tasks"></i></span>
                    <span class="navi-text font-weight-bolder">Nombre de logements</span>
                    <span class="navi-label">
                        ${ nombre_logement }
                    </span>
                </a>
            </li>`
    }
    if(standing){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;" >
                    <span class="navi-icon"><i class="fad fa-tasks"></i></span>
                    <span class="navi-text font-weight-bolder">Standing</span>
                    <span class="navi-label">
                        ${ standing }
                    </span>
                </a>
            </li>`
    }
    if(label){
        html+=`
            <li class="navi-item">
                <a class="navi-link py-2" href="javascript:;">
                    <span class="navi-icon"><i class="fa fa-shapes"></i></span>
                    <span class="navi-text font-weight-bolder">LIBELLE</span>
                    <span class="navi-label">
                        ${ label }
                    </span>
                </a>
            </li>`
    }


    html+=`</ul>`

    $(`<div id="infoWindow" class="modal right fade" tabindex="-1" role="dialog" data-keyboard="false" >
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><i class="fa fa-eye mr-3"></i>Aperçu</h5>
                            <button class="btn btn-icon btn-xs btn-light btn-hover-primary" data-toggle="tooltip" title="" data-original-title="Fermer"  data-dismiss="modal">
                                <i class="ki ki-close icon-xs text-muted"></i>
                            </button>
                        </div>
                        <div class="modal-body p-0 min-w-350px min-w-xl-500px">
                            <div class="max-h-200px overflow-hidden">
                            ${screen}
                            </div>
                            <div class="py-4">${html}</div>                      
                        ${gallery}
                        ${comments}
                    </div>
                </div>
            </div>`).appendTo('body')
    $('#infoWindow').modal('show')
}
let initialize = function(){
    let the = {}
    the.element = document.getElementById("map")
    the.center = new google.maps.LatLng(parseFloat(LATITUDE), parseFloat(LONGITUDE));
    map = new google.maps.Map(the.element, {
        center: the.center,
        zoom: 9,
        //disableDefaultUI: true,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //disableDoubleClickZoom: true,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
        },
        //scrollwheel: false,
        styles: [
            {
                featureType: 'all',
                stylers: [
                    { saturation: -80 }
                ]
            },{
                featureType: 'road.arterial',
                elementType: 'geometry',
                stylers: [
                    { hue: '#00ffee' },
                    { saturation: 50 }
                ]
            },{
                featureType: 'poi.business',
                elementType: 'labels',
                stylers: [
                    { visibility: 'off' }
                ]
            }
        ]
    });
    map.data.addListener('click', function(event) {
        if(event.feature.getGeometry().getType() == 'Polygon'){

        }else{
            map.setZoom(17);
            map.panTo(new google.maps.LatLng(
                event.feature.getGeometry().get().lat(),
                event.feature.getGeometry().get().lng()
            ));
        }
        infoBox(event.feature)
    });
    map.data.setStyle(function(feature) {
        var icon =  {};
        var fillColor = 'green'
        var strokeColor = 'blue'
        if (feature.getProperty('icon')) {
            icon = feature.getProperty('icon');
        }
        if (feature.getProperty('fillColor')) {
            fillColor = feature.getProperty('fillColor');
        }
        if (feature.getProperty('fillColor')) {
            fillColor = feature.getProperty('fillColor');
        }
        return({
            //icon:icon,
            label: feature.getProperty('label'),
            title: feature.getProperty('title'),
            fillColor: fillColor,
            fillOpacity:.08,
            strokeColor: strokeColor,
            strokeWeight: 1,
            zIndex: 1
        });
    });
    map.data.addListener('mouseover', function(event) {
        map.data.revertStyle();
        map.data.overrideStyle(event.feature, {strokeWeight: 2});
    });
    map.data.addListener('mouseout', function(event) {
        map.data.revertStyle();
    });
    load_map(`${BASE_URL}/dashboard/geopoint?timestamp=` + (new Date()).getTime())
    save_map()
}
google.maps.event.addDomListener(window, 'load', initialize);
$(document).ready(function (){





    $('body').removeClass('subheader-enabled')
})
