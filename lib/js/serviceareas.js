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
    url: 'https://breezeair.net/wp-content/plugins/breezeair-extras/lib/kml/serviceareas.kmz?rand=3426226',
    map: serviceAreasMap,
    preserveViewport: true
  });
  console.log('serviceAreasLayer.status = ', serviceAreasLayer);
})(jQuery);