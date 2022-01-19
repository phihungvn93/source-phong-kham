function initialize() {
  var latlng = new google.maps.LatLng(10.806386, 106.635806);
  var myOptions = {
    zoom: 18,
    center: latlng, 
    mapTypeControlOptions: { mapTypeIds: ['noText', google.maps.MapTypeId.ROADMAP] }
  };
  var map = new google.maps.Map(document.getElementById('map'), myOptions);
 
 var styledMapOptions = { name: '川上歯科医院' }
  var sampleType = new google.maps.StyledMapType(styleOptions, styledMapOptions);
  map.mapTypes.set('sample', sampleType);
  map.setMapTypeId('sample');

  var styleOptions =
[
{
    "featureType": "landscape",
  },
]; 

var icon = new google.maps.MarkerImage('images/map-icon.png',
  new google.maps.Size(90,100),
  new google.maps.Point(0,0)
);
 
var markerOptions = {
  position: latlng,
  map: map,
  icon: icon,
  title: '川上歯科医院'
};
var marker = new google.maps.Marker(markerOptions);
 
}