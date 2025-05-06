let GeoJsonMap = function (element, options) {
    // Main object
    let the = this
    // Default options
    let defaultOptions = {
        center:new google.maps.LatLng(parseFloat(LATITUDE), parseFloat(LONGITUDE)),
        providerUrl:`${BASE_URL}medias/geojson/1.json?timestamp=` + (new Date().getTime())
    }
    ////////////////////////////
    // ** Private Methods  ** //
    ////////////////////////////
    let Plugin = {
        /**
         * Construct
         */
        construct: function(options) {
            Plugin.init(options);
            Plugin.build();
            return the;
        },
        init: function(options) {
            the.options = Object.assign({}, defaultOptions, options);
            the.element = document.getElementById(element)
            the.center = the.options.center
            the.mapID = the.options.mapID || 1
            the.providerUrl = the.options.providerUrl + `?timestamp=` + (new Date().getTime())
        },
        build: function() {
            the.map = new google.maps.Map(the.element, {
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
            the.map.data.setStyle(function(feature) {
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
                    icon:icon,
                    //label: feature.getProperty('label'),
                    title: feature.getProperty('label'),
                    fillColor: fillColor,
                    fillOpacity:.08,
                    strokeColor: strokeColor,
                    strokeWeight: 1,
                    zIndex: 1
                });
            });
            the.map.data.addListener('click', function(event) {
                if(event.feature.getGeometry().getType() == 'Polygon'){

                }else{
                    the.map.setZoom(15);
                    the.map.panTo(new google.maps.LatLng(
                        event.feature.getGeometry().get().lat(),
                        event.feature.getGeometry().get().lng()
                    ));
                    //infoBox(event.feature)
                }
            });
            the.map.data.addListener('mouseover', function(event) {
                the.map.data.revertStyle();
                the.map.data.overrideStyle(event.feature, {
                    fillOpacity:.3,
                    strokeWeight: 2,
                    fillColor: 'blue'
                });
            });
            the.map.data.addListener('mouseout', function(event) {
                the.map.data.revertStyle();
            });
            the.map.data.loadGeoJson(the.providerUrl,{},
                function(features){
                    var _markers = features.map(function (feature) {
                        const g = feature.getGeometry();
                        switch (g.getType().toLowerCase()) {
                            case 'polygon':
                                console.log('Oranges are $0.59 a pound.');
                                break;
                            case 'point':
                                var marker = new google.maps.Marker({
                                    'position': g.get(0),
                                    'icon': feature.getProperty('icon'),
                                });
                                marker.set("myZIndex", marker.getZIndex());
                                marker.addListener("mouseover", (e) => {
                                    this.setOptions({zIndex:10});
                                });
                                marker.addListener("click", (e) => {
                                    return
                                    console.log(feature.getGeometry().getType())
                                    map.panTo(e.latLng);
                                    infoBox(feature)
                                });

                                return marker;
                                break;
                            default:
                                console.log(`Sorry, we are out of ${expr}.`);
                        }
                    });
                }
            );
        }
    }
    //////////////////////////
    // ** Public Methods ** //
    //////////////////////////
    /**
     * Set default options
     */

    the.setDefaults = function(options) {
        defaultOptions = options;
    };

    the.run = function() {

    };
    // Construct plugin
    Plugin.construct.apply(the, [options]);
    //
    return the;
}
