/* Service Areas */
(function($){
  //console.log('wpvars.serviceAreas =', wpvars.serviceAreas);
  let mapCenter = {lat: 0.0, lng: 0.0};
  const serviceAreas = wpvars.serviceAreas;
  if( typeof serviceAreas != 'undefined' ){
    for( const [map,data] of Object.entries(serviceAreas) ){
      let mapEl = document.getElementById( map );
      if( typeof mapEl == 'undefined' || mapEl == null )
        continue;

      mapCenter.lat = data.lat;
      mapCenter.lng = data.lng;
      let zoom = data.zoom;
      let serviceAreasMap = new google.maps.Map( mapEl, {
        center: mapCenter,
        zoom: zoom
      });
      let kmlUrl = `${wpvars.hardCodedUrl}lib/kml/${map}.kmz?rand=${wpvars.timeStamp}`;
      let serviceAreasLayer = new google.maps.KmlLayer({
        url: kmlUrl,
        map: serviceAreasMap,
        preserveViewport: true
      });
      //console.log('serviceAreasLayer.status = ', serviceAreasLayer);
    }
  }
})(jQuery);