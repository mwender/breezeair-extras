(function($){
  const serviceAreas = wpvars.serviceAreas;

  /**
   * Draws service area maps using the Google Maps API.
   */
  function drawServiceAreaMaps(){
    if( typeof serviceAreas != 'undefined' ){
      for( const [map,data] of Object.entries(serviceAreas) ){
        let mapEl = document.getElementById( map );

        if( typeof mapEl == 'undefined' || mapEl == null || data.kml == null )
          continue;

        let mapConfig = {
          center: {lat: data.lat, lng: data.lng},
          zoom: data.zoom,
          streetViewControl: false
        };

        if( typeof mapEl.dataset.maptype != 'undefined' && mapEl.dataset.maptype != null )
          mapConfig.mapTypeId = mapEl.dataset.maptype;

        let serviceAreasMap = new google.maps.Map( mapEl, mapConfig );

        let serviceAreasLayer = new google.maps.KmlLayer({
          url: data.kml,
          map: serviceAreasMap,
          preserveViewport: true
        });
      }
    } else {
      console.warn('serviceAreas is undefined. Unable to initialize service area maps.');
    }
  }
  drawServiceAreaMaps();

  // Initialize maps when a popup is opened.
  $(document).on('elementor/popup/show', () => {
    drawServiceAreaMaps();
  });
})(jQuery);