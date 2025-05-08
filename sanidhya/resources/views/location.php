<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
<script>
$(document).ready(function () {      
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    }
});
function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;
  if(lat && lon){
  window.location.href = "/location/"+lat+"/"+lon;
  }
}
</script>



