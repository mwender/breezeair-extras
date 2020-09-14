/* Service Areas */
(function($){
  // Tallahassee 35.63330240125537%2C-83.93705968127438&z=14
  const mapCenter = {lat: 35.628803, lng: -83.933948};
  const serviceAreasMap = new google.maps.Map(document.getElementById('map'), {
    center: mapCenter,
    zoom: 11
  });
  console.log('Applying KML layer...');
  const serviceAreasLayer = new google.maps.KmlLayer({
    url: `${wpvars.pluginUrl}lib/kml/serviceareas.kmz?rand=${wpvars.timeStamp}`,
    map: serviceAreasMap,
    preserveViewport: true
  });
  console.log('serviceAreasLayer.status = ', serviceAreasLayer);
})(jQuery);