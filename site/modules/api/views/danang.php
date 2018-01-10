<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false&language=vi" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[
function SetResizeMap() {
   var min_popupHeight=525;
   var min_popupWidth=990;
   var _popupWindowSize = 80;
   var _tmpHeight;
   var _tmpWidth;
   var _mapHeight;
   var _mapWidth;
   var x=$(window.parent).width();
   var y=$(window.parent).height();
   if(_popupWindowSize>0){
       _tmpHeight = (y * _popupWindowSize) / 100;
       _tmpWidth = (x * _popupWindowSize) / 100;
       if (_tmpHeight >= min_popupHeight || _tmpWidth >= min_popupWidth) {
           if (_tmpWidth < min_popupWidth) {
               _tmpWidth = min_popupWidth;
           }
           if (_tmpHeight < min_popupHeight) {
               _tmpHeight = min_popupHeight;
           }
           _mapHeight = _tmpHeight - 105;
           _mapWidth = (_tmpWidth + 15) - 40 - 215;
       } else {
           _tmpHeight = min_popupHeight;   //defaults to minimum height 990px
           _tmpWidth = min_popupWidth;     //defaults to minimum width 525px
           _mapHeight = _tmpHeight - 105;
       var ifrmWidth = window.parent.document.getElementById('MP_iframeContent').style.width;
           ifrmWidth = ifrmWidth.replace('px', '');
           _mapWidth = parseFloat(ifrmWidth) - 215;
       }
   }else{
       _tmpWidth = (990 * 1) + 25 || defaultPopUpWidth; //defaults to 630 if no paramaters were added to URL
       _tmpHeight = (525 * 1) || defaultPopUpHeight; //defaults to 440 if no paramaters were added to URL
       _mapWidth = _tmpWidth - 40;
       _mapHeight = _tmpHeight - 80;
   }
   if( navigator.userAgent.match(/Android/i)
       || navigator.userAgent.match(/webOS/i)
       || navigator.userAgent.match(/iPhone/i)
       || navigator.userAgent.match(/iPad/i)
       || navigator.userAgent.match(/iPod/i)
       || navigator.userAgent.match(/BlackBerry/i)
     )
  {
       var ifrmWidth = window.parent.document.getElementById('MP_iframeContent').style.width;
           ifrmWidth = ifrmWidth.replace('px', '');
           _mapWidth = parseFloat(ifrmWidth) - 215;
   }
   if(document.getElementById('map_canvas')) {
       document.getElementById('map_canvas').style.width = _mapWidth+'px'; 
       document.getElementById('map_canvas').style.height = parseFloat(_mapHeight-5)+'px'; 
   }
}
   var modalCity = window.parent.document.getElementById('MP_window');
   window.onresize = function() {  
   if (modalCity) {
           SetResizeMap();
   }
}
   if (modalCity) { SetResizeMap(); }
if(window.parent.document.getElementById('MP_titleText')){window.parent.document.getElementById('MP_titleText').innerHTML = "<span class='black'>Bản đồ</span><span class='citylink'>Đà Nẵng</span>";}try{
if(modalCity){
   SetResizeMap();
}
var map;
function fillMap() {
var myLatlng = new google.maps.LatLng(16.069237 ,108.237991);
var myStylesVisible = 'on';
var myStyles =[
   {
       featureType: 'poi.business',
       elementType: 'labels',
       stylers: [
               { visibility: myStylesVisible}
               ]
   }
];
var myOptions =
{
   zoom:   13,
   center:       myLatlng,
   mapTypeId:    google.maps.MapTypeId.ROADMAP,
   styles: myStyles,
   scaleControl:   true,
   streetViewControl: false
}
map = new google.maps.Map(document.getElementById('map_canvas'), myOptions);
var polyPaths;
try{
 polyPaths = [
new google.maps.LatLng(16.047401,108.238613)
,
new google.maps.LatLng(16.046184,108.239064)
,
new google.maps.LatLng(16.044638,108.239772)
,
new google.maps.LatLng(16.040482,108.241907)
,
new google.maps.LatLng(16.038224,108.243173)
,
new google.maps.LatLng(16.033357,108.24563)
,
new google.maps.LatLng(16.026407,108.249181)
,
new google.maps.LatLng(16.024128,108.250297)
,
new google.maps.LatLng(16.026469,108.255769)
,
new google.maps.LatLng(16.025386,108.256337)
,
new google.maps.LatLng(16.026541,108.259052)
,
new google.maps.LatLng(16.02683,108.260006)
,
new google.maps.LatLng(16.039008,108.254814)
,
new google.maps.LatLng(16.050845,108.250297)
,
new google.maps.LatLng(16.050257,108.24873)
,
new google.maps.LatLng(16.049406,108.245737)
,
new google.maps.LatLng(16.04772,108.239509)
,
new google.maps.LatLng(16.047401,108.238613)
];
var polygon94167 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94167.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.047504,108.23857)
,
new google.maps.LatLng(16.050288,108.24872)
,
new google.maps.LatLng(16.050844,108.250179)
,
new google.maps.LatLng(16.057856,108.248976)
,
new google.maps.LatLng(16.065774,108.248033)
,
new google.maps.LatLng(16.075175,108.247603)
,
new google.maps.LatLng(16.091753,108.251895)
,
new google.maps.LatLng(16.091675,108.251064)
,
new google.maps.LatLng(16.09185,108.250376)
,
new google.maps.LatLng(16.091989,108.250072)
,
new google.maps.LatLng(16.092062,108.249952)
,
new google.maps.LatLng(16.092241,108.249813)
,
new google.maps.LatLng(16.092365,108.249642)
,
new google.maps.LatLng(16.092449,108.249421)
,
new google.maps.LatLng(16.092509,108.249218)
,
new google.maps.LatLng(16.09271,108.248906)
,
new google.maps.LatLng(16.092896,108.24843)
,
new google.maps.LatLng(16.093093,108.247769)
,
new google.maps.LatLng(16.093201,108.247341)
,
new google.maps.LatLng(16.09336,108.247045)
,
new google.maps.LatLng(16.093655,108.246809)
,
new google.maps.LatLng(16.093995,108.24659)
,
new google.maps.LatLng(16.094428,108.246375)
,
new google.maps.LatLng(16.094866,108.246117)
,
new google.maps.LatLng(16.095222,108.245902)
,
new google.maps.LatLng(16.095448,108.245689)
,
new google.maps.LatLng(16.095684,108.245302)
,
new google.maps.LatLng(16.095866,108.245114)
,
new google.maps.LatLng(16.095959,108.244899)
,
new google.maps.LatLng(16.088506,108.241766)
,
new google.maps.LatLng(16.086733,108.24079)
,
new google.maps.LatLng(16.08534,108.239461)
,
new google.maps.LatLng(16.078661,108.23283)
,
new google.maps.LatLng(16.077011,108.23137)
,
new google.maps.LatLng(16.07565,108.230802)
,
new google.maps.LatLng(16.074248,108.230545)
,
new google.maps.LatLng(16.071814,108.23093)
,
new google.maps.LatLng(16.067733,108.232582)
,
new google.maps.LatLng(16.062123,108.2343)
,
new google.maps.LatLng(16.051195,108.23754)
,
new google.maps.LatLng(16.047504,108.23857)
];
var polygon94163 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94163.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.025292,108.256251)
,
new google.maps.LatLng(16.002883,108.266927)
,
new google.maps.LatLng(16.001347,108.26727)
,
new google.maps.LatLng(15.998356,108.267549)
,
new google.maps.LatLng(15.996561,108.26756)
,
new google.maps.LatLng(15.994427,108.268289)
,
new google.maps.LatLng(15.990528,108.270478)
,
new google.maps.LatLng(15.977955,108.277623)
,
new google.maps.LatLng(15.957408,108.29127)
,
new google.maps.LatLng(15.959884,108.296206)
,
new google.maps.LatLng(15.989713,108.279082)
,
new google.maps.LatLng(16.002584,108.272988)
,
new google.maps.LatLng(16.012237,108.268053)
,
new google.maps.LatLng(16.026808,108.260017)
,
new google.maps.LatLng(16.026514,108.259111)
,
new google.maps.LatLng(16.025292,108.256251)
];
var polygon94165 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94165.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.09266,108.303394)
,
new google.maps.LatLng(16.095381,108.310774)
,
new google.maps.LatLng(16.101979,108.313608)
,
new google.maps.LatLng(16.107751,108.313865)
,
new google.maps.LatLng(16.116078,108.314595)
,
new google.maps.LatLng(16.129271,108.311677)
,
new google.maps.LatLng(16.128694,108.309102)
,
new google.maps.LatLng(16.126468,108.308415)
,
new google.maps.LatLng(16.125396,108.306183)
,
new google.maps.LatLng(16.125478,108.304295)
,
new google.maps.LatLng(16.126963,108.299231)
,
new google.maps.LatLng(16.124819,108.298802)
,
new google.maps.LatLng(16.1235,108.298716)
,
new google.maps.LatLng(16.120449,108.302235)
,
new google.maps.LatLng(16.117563,108.304209)
,
new google.maps.LatLng(16.114677,108.306441)
,
new google.maps.LatLng(16.112615,108.307471)
,
new google.maps.LatLng(16.112203,108.307814)
,
new google.maps.LatLng(16.118882,108.285927)
,
new google.maps.LatLng(16.112203,108.263783)
,
new google.maps.LatLng(16.108492,108.26344)
,
new google.maps.LatLng(16.102308,108.264641)
,
new google.maps.LatLng(16.095545,108.265929)
,
new google.maps.LatLng(16.093649,108.267045)
,
new google.maps.LatLng(16.093484,108.269448)
,
new google.maps.LatLng(16.094308,108.270735)
,
new google.maps.LatLng(16.096205,108.273482)
,
new google.maps.LatLng(16.095962,108.275532)
,
new google.maps.LatLng(16.095958,108.278803)
,
new google.maps.LatLng(16.096288,108.281378)
,
new google.maps.LatLng(16.097937,108.284125)
,
new google.maps.LatLng(16.100164,108.288417)
,
new google.maps.LatLng(16.101648,108.292365)
,
new google.maps.LatLng(16.101648,108.296313)
,
new google.maps.LatLng(16.101071,108.298459)
,
new google.maps.LatLng(16.098762,108.30009)
,
new google.maps.LatLng(16.097195,108.300004)
,
new google.maps.LatLng(16.094061,108.301377)
,
new google.maps.LatLng(16.09266,108.303394)
];
var polygon94164 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94164.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.091684,108.251068)
,
new google.maps.LatLng(16.091775,108.251896)
,
new google.maps.LatLng(16.091822,108.252164)
,
new google.maps.LatLng(16.092519,108.252749)
,
new google.maps.LatLng(16.09542,108.25453)
,
new google.maps.LatLng(16.097399,108.256761)
,
new google.maps.LatLng(16.098883,108.259122)
,
new google.maps.LatLng(16.099295,108.261911)
,
new google.maps.LatLng(16.098348,108.263714)
,
new google.maps.LatLng(16.097235,108.265571)
,
new google.maps.LatLng(16.10849,108.263429)
,
new google.maps.LatLng(16.112201,108.263776)
,
new google.maps.LatLng(16.111926,108.257513)
,
new google.maps.LatLng(16.102154,108.247514)
,
new google.maps.LatLng(16.095964,108.244899)
,
new google.maps.LatLng(16.095871,108.245122)
,
new google.maps.LatLng(16.095687,108.245302)
,
new google.maps.LatLng(16.095451,108.245693)
,
new google.maps.LatLng(16.095226,108.245908)
,
new google.maps.LatLng(16.09444,108.246375)
,
new google.maps.LatLng(16.093998,108.246592)
,
new google.maps.LatLng(16.093673,108.246801)
,
new google.maps.LatLng(16.093359,108.247053)
,
new google.maps.LatLng(16.093206,108.247343)
,
new google.maps.LatLng(16.093102,108.247758)
,
new google.maps.LatLng(16.092912,108.248405)
,
new google.maps.LatLng(16.092716,108.248906)
,
new google.maps.LatLng(16.092509,108.249224)
,
new google.maps.LatLng(16.092457,108.249412)
,
new google.maps.LatLng(16.092372,108.249644)
,
new google.maps.LatLng(16.092248,108.249815)
,
new google.maps.LatLng(16.092069,108.24995)
,
new google.maps.LatLng(16.091996,108.250072)
,
new google.maps.LatLng(16.091853,108.25038)
,
new google.maps.LatLng(16.091684,108.251068)
];
var polygon484803 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon484803.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.035687,108.237025)
,
new google.maps.LatLng(16.033789,108.237455)
,
new google.maps.LatLng(16.032511,108.237154)
,
new google.maps.LatLng(16.031253,108.236618)
,
new google.maps.LatLng(16.030325,108.23636)
,
new google.maps.LatLng(16.030015,108.235652)
,
new google.maps.LatLng(16.02818,108.236017)
,
new google.maps.LatLng(16.027293,108.236296)
,
new google.maps.LatLng(16.026344,108.237304)
,
new google.maps.LatLng(16.025334,108.238248)
,
new google.maps.LatLng(16.024158,108.238978)
,
new google.maps.LatLng(16.023148,108.239643)
,
new google.maps.LatLng(16.021725,108.240137)
,
new google.maps.LatLng(16.020961,108.240008)
,
new google.maps.LatLng(16.01993,108.241424)
,
new google.maps.LatLng(16.019518,108.243613)
,
new google.maps.LatLng(16.018693,108.245973)
,
new google.maps.LatLng(16.017827,108.248076)
,
new google.maps.LatLng(16.016837,108.249149)
,
new google.maps.LatLng(16.011887,108.249406)
,
new google.maps.LatLng(16.009164,108.251424)
,
new google.maps.LatLng(16.004255,108.251767)
,
new google.maps.LatLng(15.999759,108.254342)
,
new google.maps.LatLng(15.998686,108.254599)
,
new google.maps.LatLng(15.98928,108.253526)
,
new google.maps.LatLng(15.98862,108.25387)
,
new google.maps.LatLng(15.987919,108.256101)
,
new google.maps.LatLng(15.987341,108.257088)
,
new google.maps.LatLng(15.986846,108.259062)
,
new google.maps.LatLng(15.986928,108.261809)
,
new google.maps.LatLng(15.990559,108.270392)
,
new google.maps.LatLng(15.994437,108.268182)
,
new google.maps.LatLng(15.996582,108.267474)
,
new google.maps.LatLng(15.998418,108.267452)
,
new google.maps.LatLng(16.001429,108.267173)
,
new google.maps.LatLng(16.002852,108.266809)
,
new google.maps.LatLng(16.011123,108.262839)
,
new google.maps.LatLng(16.025251,108.25623)
,
new google.maps.LatLng(16.026416,108.255747)
,
new google.maps.LatLng(16.024045,108.250276)
,
new google.maps.LatLng(16.029417,108.247572)
,
new google.maps.LatLng(16.038089,108.243194)
,
new google.maps.LatLng(16.037032,108.24143)
,
new google.maps.LatLng(16.035965,108.238388)
,
new google.maps.LatLng(16.035687,108.237025)
];
var polygon482641 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon482641.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.032944,108.222755)
,
new google.maps.LatLng(16.033067,108.224258)
,
new google.maps.LatLng(16.03377,108.226919)
,
new google.maps.LatLng(16.035088,108.232927)
,
new google.maps.LatLng(16.035996,108.238377)
,
new google.maps.LatLng(16.037069,108.241423)
,
new google.maps.LatLng(16.0381,108.243141)
,
new google.maps.LatLng(16.039008,108.242668)
,
new google.maps.LatLng(16.042818,108.240559)
,
new google.maps.LatLng(16.044638,108.239599)
,
new google.maps.LatLng(16.046214,108.238923)
,
new google.maps.LatLng(16.047761,108.238415)
,
new google.maps.LatLng(16.052788,108.236922)
,
new google.maps.LatLng(16.056617,108.235774)
,
new google.maps.LatLng(16.06136,108.234327)
,
new google.maps.LatLng(16.067928,108.23233)
,
new google.maps.LatLng(16.071109,108.231044)
,
new google.maps.LatLng(16.07201,108.230603)
,
new google.maps.LatLng(16.073083,108.230287)
,
new google.maps.LatLng(16.073929,108.230411)
,
new google.maps.LatLng(16.074433,108.230442)
,
new google.maps.LatLng(16.075882,108.230727)
,
new google.maps.LatLng(16.077247,108.231333)
,
new google.maps.LatLng(16.077752,108.231784)
,
new google.maps.LatLng(16.078742,108.232733)
,
new google.maps.LatLng(16.078939,108.232507)
,
new google.maps.LatLng(16.079299,108.232133)
,
new google.maps.LatLng(16.079654,108.231848)
,
new google.maps.LatLng(16.080166,108.231633)
,
new google.maps.LatLng(16.08063,108.231252)
,
new google.maps.LatLng(16.081041,108.230888)
,
new google.maps.LatLng(16.082366,108.229735)
,
new google.maps.LatLng(16.082929,108.229375)
,
new google.maps.LatLng(16.08335,108.229342)
,
new google.maps.LatLng(16.083805,108.229472)
,
new google.maps.LatLng(16.084886,108.229514)
,
new google.maps.LatLng(16.088475,108.229687)
,
new google.maps.LatLng(16.088454,108.232969)
,
new google.maps.LatLng(16.090432,108.23284)
,
new google.maps.LatLng(16.091917,108.228292)
,
new google.maps.LatLng(16.094143,108.225889)
,
new google.maps.LatLng(16.096782,108.224171)
,
new google.maps.LatLng(16.094205,108.216812)
,
new google.maps.LatLng(16.092969,108.215266)
,
new google.maps.LatLng(16.092494,108.215106)
,
new google.maps.LatLng(16.090587,108.214999)
,
new google.maps.LatLng(16.087949,108.215288)
,
new google.maps.LatLng(16.087216,108.216018)
,
new google.maps.LatLng(16.086216,108.218067)
,
new google.maps.LatLng(16.084752,108.220952)
,
new google.maps.LatLng(16.083938,108.221628)
,
new google.maps.LatLng(16.08266,108.222498)
,
new google.maps.LatLng(16.082206,108.220277)
,
new google.maps.LatLng(16.081784,108.219527)
,
new google.maps.LatLng(16.081248,108.219049)
,
new google.maps.LatLng(16.080057,108.219215)
,
new google.maps.LatLng(16.08014,108.219934)
,
new google.maps.LatLng(16.076737,108.220401)
,
new google.maps.LatLng(16.073948,108.220809)
,
new google.maps.LatLng(16.071496,108.221125)
,
new google.maps.LatLng(16.07167,108.222728)
,
new google.maps.LatLng(16.070335,108.22291)
,
new google.maps.LatLng(16.06902,108.222792)
,
new google.maps.LatLng(16.068166,108.222686)
,
new google.maps.LatLng(16.063999,108.222267)
,
new google.maps.LatLng(16.063779,108.22231)
,
new google.maps.LatLng(16.063247,108.222138)
,
new google.maps.LatLng(16.062841,108.222052)
,
new google.maps.LatLng(16.062655,108.221919)
,
new google.maps.LatLng(16.061804,108.221667)
,
new google.maps.LatLng(16.061052,108.221489)
,
new google.maps.LatLng(16.060948,108.222134)
,
new google.maps.LatLng(16.061052,108.223507)
,
new google.maps.LatLng(16.060541,108.223147)
,
new google.maps.LatLng(16.059082,108.221344)
,
new google.maps.LatLng(16.058128,108.220889)
,
new google.maps.LatLng(16.057184,108.220406)
,
new google.maps.LatLng(16.056432,108.220228)
,
new google.maps.LatLng(16.055679,108.220176)
,
new google.maps.LatLng(16.054473,108.220191)
,
new google.maps.LatLng(16.051792,108.220513)
,
new google.maps.LatLng(16.049133,108.220798)
,
new google.maps.LatLng(16.046499,108.221109)
,
new google.maps.LatLng(16.040605,108.221828)
,
new google.maps.LatLng(16.038692,108.222047)
,
new google.maps.LatLng(16.035543,108.222444)
,
new google.maps.LatLng(16.032944,108.222755)
];
var polygon94166 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94166.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.017558,108.212155)
,
new google.maps.LatLng(16.020363,108.218506)
,
new google.maps.LatLng(16.024963,108.222218)
,
new google.maps.LatLng(16.026592,108.221619)
,
new google.maps.LatLng(16.030861,108.222776)
,
new google.maps.LatLng(16.032862,108.22267)
,
new google.maps.LatLng(16.054391,108.220138)
,
new google.maps.LatLng(16.056267,108.220094)
,
new google.maps.LatLng(16.057277,108.220396)
,
new google.maps.LatLng(16.059155,108.221274)
,
new google.maps.LatLng(16.060948,108.22327)
,
new google.maps.LatLng(16.060824,108.222005)
,
new google.maps.LatLng(16.061031,108.221426)
,
new google.maps.LatLng(16.062907,108.221939)
,
new google.maps.LatLng(16.063836,108.222218)
,
new google.maps.LatLng(16.064042,108.222198)
,
new google.maps.LatLng(16.070392,108.222798)
,
new google.maps.LatLng(16.071527,108.222541)
,
new google.maps.LatLng(16.071381,108.221039)
,
new google.maps.LatLng(16.074743,108.220503)
,
new google.maps.LatLng(16.070989,108.20134)
,
new google.maps.LatLng(16.071155,108.188358)
,
new google.maps.LatLng(16.07167,108.18645)
,
new google.maps.LatLng(16.071608,108.186041)
,
new google.maps.LatLng(16.07002,108.184925)
,
new google.maps.LatLng(16.067422,108.182221)
,
new google.maps.LatLng(16.070661,108.17999)
,
new google.maps.LatLng(16.072929,108.177695)
,
new google.maps.LatLng(16.074536,108.176428)
,
new google.maps.LatLng(16.075011,108.175721)
,
new google.maps.LatLng(16.074288,108.17514)
,
new google.maps.LatLng(16.075752,108.173381)
,
new google.maps.LatLng(16.080289,108.165978)
,
new google.maps.LatLng(16.07798,108.164304)
,
new google.maps.LatLng(16.082681,108.157245)
,
new google.maps.LatLng(16.079753,108.155185)
,
new google.maps.LatLng(16.079732,108.155056)
,
new google.maps.LatLng(16.078908,108.152804)
,
new google.maps.LatLng(16.086867,108.148447)
,
new google.maps.LatLng(16.088783,108.146431)
,
new google.maps.LatLng(16.086887,108.144091)
,
new google.maps.LatLng(16.077609,108.148168)
,
new google.maps.LatLng(16.067506,108.152117)
,
new google.maps.LatLng(16.065485,108.155035)
,
new google.maps.LatLng(16.059834,108.163318)
,
new google.maps.LatLng(16.057401,108.166708)
,
new google.maps.LatLng(16.056205,108.16954)
,
new google.maps.LatLng(16.056453,108.170484)
,
new google.maps.LatLng(16.058638,108.173875)
,
new google.maps.LatLng(16.061938,108.178852)
,
new google.maps.LatLng(16.0454,108.184431)
,
new google.maps.LatLng(16.028613,108.189926)
,
new google.maps.LatLng(16.028736,108.19044)
,
new google.maps.LatLng(16.023663,108.192973)
,
new google.maps.LatLng(16.021849,108.195289)
,
new google.maps.LatLng(16.023168,108.197049)
,
new google.maps.LatLng(16.023292,108.199666)
,
new google.maps.LatLng(16.024034,108.201812)
,
new google.maps.LatLng(16.022592,108.202157)
,
new google.maps.LatLng(16.024405,108.208937)
,
new google.maps.LatLng(16.020239,108.211083)
,
new google.maps.LatLng(16.017558,108.212155)
];
var polygon94169 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94169.setMap(map); 
} catch(err) { alert(err);
}
try{
 polyPaths = [
new google.maps.LatLng(16.067583,108.182281)
,
new google.maps.LatLng(16.068609,108.183327)
,
new google.maps.LatLng(16.069649,108.184389)
,
new google.maps.LatLng(16.070104,108.184887)
,
new google.maps.LatLng(16.071763,108.185901)
,
new google.maps.LatLng(16.071831,108.186101)
,
new google.maps.LatLng(16.07182,108.186459)
,
new google.maps.LatLng(16.071562,108.18728)
,
new google.maps.LatLng(16.07132,108.188338)
,
new google.maps.LatLng(16.071247,108.1914)
,
new google.maps.LatLng(16.071212,108.194351)
,
new google.maps.LatLng(16.071104,108.201394)
,
new google.maps.LatLng(16.07113,108.201689)
,
new google.maps.LatLng(16.071268,108.20257)
,
new google.maps.LatLng(16.07217,108.206935)
,
new google.maps.LatLng(16.073238,108.21215)
,
new google.maps.LatLng(16.074943,108.220577)
,
new google.maps.LatLng(16.080082,108.219907)
,
new google.maps.LatLng(16.079996,108.219182)
,
new google.maps.LatLng(16.081047,108.219027)
,
new google.maps.LatLng(16.081295,108.219006)
,
new google.maps.LatLng(16.081922,108.219618)
,
new google.maps.LatLng(16.082181,108.219949)
,
new google.maps.LatLng(16.08231,108.220319)
,
new google.maps.LatLng(16.082712,108.222379)
,
new google.maps.LatLng(16.084722,108.220868)
,
new google.maps.LatLng(16.087155,108.215954)
,
new google.maps.LatLng(16.087588,108.215137)
,
new google.maps.LatLng(16.091547,108.214838)
,
new google.maps.LatLng(16.092288,108.214858)
,
new google.maps.LatLng(16.091669,108.213271)
,
new google.maps.LatLng(16.090103,108.205204)
,
new google.maps.LatLng(16.084742,108.203314)
,
new google.maps.LatLng(16.077814,108.201512)
,
new google.maps.LatLng(16.076,108.193615)
,
new google.maps.LatLng(16.076248,108.186491)
,
new google.maps.LatLng(16.083176,108.172072)
,
new google.maps.LatLng(16.093071,108.157739)
,
new google.maps.LatLng(16.104287,108.144006)
,
new google.maps.LatLng(16.113935,108.135594)
,
new google.maps.LatLng(16.123994,108.134564)
,
new google.maps.LatLng(16.125478,108.129414)
,
new google.maps.LatLng(16.121438,108.122548)
,
new google.maps.LatLng(16.119871,108.121004)
,
new google.maps.LatLng(16.111131,108.125982)
,
new google.maps.LatLng(16.102225,108.12993)
,
new google.maps.LatLng(16.097277,108.13302)
,
new google.maps.LatLng(16.092164,108.131647)
,
new google.maps.LatLng(16.086288,108.141539)
,
new google.maps.LatLng(16.086907,108.142376)
,
new google.maps.LatLng(16.087433,108.14318)
,
new google.maps.LatLng(16.087644,108.143878)
,
new google.maps.LatLng(16.086912,108.144103)
,
new google.maps.LatLng(16.088799,108.146431)
,
new google.maps.LatLng(16.086873,108.148462)
,
new google.maps.LatLng(16.078914,108.152809)
,
new google.maps.LatLng(16.079735,108.155055)
,
new google.maps.LatLng(16.079758,108.155183)
,
new google.maps.LatLng(16.082688,108.157243)
,
new google.maps.LatLng(16.078017,108.164309)
,
new google.maps.LatLng(16.080308,108.16597)
,
new google.maps.LatLng(16.075803,108.173354)
,
new google.maps.LatLng(16.074329,108.17514)
,
new google.maps.LatLng(16.075045,108.175719)
,
new google.maps.LatLng(16.074535,108.17646)
,
new google.maps.LatLng(16.072947,108.177715)
,
new google.maps.LatLng(16.070684,108.180016)
,
new google.maps.LatLng(16.069576,108.180773)
,
new google.maps.LatLng(16.06754,108.182173)
,
new google.maps.LatLng(16.067583,108.182281)
];
var polygon94168 = new google.maps.Polygon({
                                   paths: polyPaths,
                                   strokeColor: '#FF6600',
                                   strokeOpacity: 1,
                                   strokeWeight: 3,
                                   fillColor:    '#3C3C3C',
                                   fillOpacity: 0.20
                           });

polygon94168.setMap(map); 
} catch(err) { alert(err);
}
}
window.unload=function(){GUnload();}
window.onload=function(){window.onload;fillMap();} 
} catch(err) {
alert('Xin lỗi, không thể tìm thấy điểm đến của bạn.');
}
//]]>
</script>
<div class="map-content">
    <h3 class="map-content-title">Bản đồ| Đà Nẵng</h3>
    <div id="map_canvas" style="height: 400px; width: 100%;">
        Đang tải bản đồ..
    </div>
    
</div>