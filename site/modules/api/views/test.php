<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=vi"></script>
<script type="text/javascript">
        var mx    =    0;
        var my    =    0;
        var path_pic_hotel    =    'http://mytour.vn/pictures/hotels/';
        var path_pic_location    =    '/pictures/locations/';
        var mainMarkerPlace = new Array();
        var array_hotelMarker = new Array();
        var array_locationMarker = new Array();
        var type_location    = 'hotel';
        $(function(){
            $(document).bind('mousemove', function(e){
                mx = e.pageX;
                my = e.pageY;
            });
            var arrayListId = new Array();
            //main icon mark
            var iconmain = base_url+'templates/icon/hotel_active.png';
            //icon mark location
            var iconloc = base_url+'templates/icon/location.png';
            var iconhotel = base_url+'templates/icon/hotel.png';
            var markerNull = new google.maps.MarkerImage(null);
            var mainImagePlace    =    new google.maps.MarkerImage(iconmain);
            var mainPosPlace        =    new google.maps.LatLng(16.051571, 108.214897);
            
            var settings = {
                    zoom: 12,
                    //minZoom: 15,
                    //maxZoom: 20,
                    center: mainPosPlace,
                    mapTypeControl: true,
                    mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas_detail"), settings);
            var mainMarkerPlace    =    new google.maps.Marker({
                                position: mainPosPlace,
                                map: map,
                                icon: mainImagePlace,
                                title: 'Khách Sạn Hà Nội Windy',
                                picture: 'kew1332732339.jpg',
                                teaser: '',
                                address: '23 Ngõ Thông Phong, Tôn Đức Thắng, Đống Đa , Hà Nội',
                                pricemin: '795000',
                                star: '3',
                                url: '/vn/hotel/viet-nam/ha-noi/quan-dong-da/4470-khach-san-ha-noi-windy.html'
                            });
            //Hien thi boxinfo ban dau
            $('body').append(type_location == 'hotel' ? showmapinfohotel(mainMarkerPlace) : showmapinfolocation(mainMarkerPlace));
            $('.mapinfohotel').css('top', '295px').css('left', '334px').hover(function(){}, function(){$('.mapinfohotel').remove();});
            //Addlisten marker ban đầu
            google.maps.event.addListener(mainMarkerPlace, 'mouseover', function(){
                $('.mapinfohotel').remove();
                $('body').append(showmapinfohotel(this));
                $('.mapinfohotel').css('top', (my + 25) + 'px').css('left', (mx - 154) + 'px');
            });
         
            google.maps.event.addListener(map, 'idle', function(){
                getDataShow(map.getBounds());
            });
            google.maps.event.addListener(map, 'dragend', function(){
                getDataShow(map.getBounds());
            });
            google.maps.event.addListener(map, 'drag', function(){
                $('.mapinfohotel').remove();
            });
            
            function getDataShow(bounds){
                $.ajax({
                  type: 'GET',
                  url: base_url+'api/ajax_hotel1/<?=$hotel_id?>',
                  data: {bound: String(bounds)},
                  success: function(data){
                      for (var i = 1, dataRow; dataRow = data.rows[i]; i++) {    
                      //for(i = 0; i < data.length; i++){
                            if(jQuery.inArray(dataRow.id, arrayListId) == -1){
                                  arrayListId.push(dataRow.id);
                            var mainPosPlace = new google.maps.LatLng(dataRow.lat, dataRow.lng);
                                var mainImagePlace = new google.maps.MarkerImage(dataRow.type == "hotel" ? iconhotel : iconloc);
                                var newmarker = new google.maps.Marker({
                                    position: mainPosPlace,
                                    map: map,
                                    icon: mainImagePlace,
                                    type: dataRow.type,
                                    title: dataRow.name,
                                    picture: dataRow.picture,
                                    teaser: dataRow.teaser,
                                    address: dataRow.address,
                                    star: dataRow.category,
                                    //pricemin: data[i].price,
                                    url: dataRow.url,
                                    visible: (dataRow.type == "hotel" ? true : false)
                                });
                                //Gan vao array marker
                                mainMarkerPlace[dataRow.id] = newmarker;
                                //Su kien click den trang chi tiet cua location hoac KS
                                itemClick(newmarker, dataRow.url);
                                //Gan vao mang array hotel hoac location de lua chon an hoac hien
                                if (dataRow.type == "hotel") {
                                array_hotelMarker.push(newmarker);
                                //Show box info when mouse over icon
                                //Chỉ addListen các marker của hotel (Do ban đầu marker location đợc ẩn đi)
                                google.maps.event.addListener(mainMarkerPlace[dataRow.id], 'mouseover', function(){
                                      $('.mapinfohotel').remove();
                                      $('body').append(showmapinfohotel(this));
                                      $('.mapinfohotel').css('top', (my + 25) + 'px').css('left', (mx - 154) + 'px');
                                  });
                                }
                        //Mang marker location
                                if(dataRow.type == "location")    array_locationMarker.push(newmarker);
                            } //end if
                            
                            //remove box info when mouse out icon
                            google.maps.event.addListener(mainMarkerPlace[dataRow.id], 'mouseout', function(){
                                $('.mapinfohotel').remove();
                            });
                          }
                            /*$.each(array_hotelMarker, function(key, value){
                                    //this.setVisible(true);
                                    //this.setZIndex(1);
                                    $("#abc").append('<div> Key: '+key+" - Value: "+value+"</div>");
                            });  */                        
                  },
                  dataType: 'json'
                });
            } //end function
            
            function itemClick(Marker, url){
                google.maps.event.addListener(Marker,'click',function(){
                    window.parent.location.href = url;
                });
            }
            
            $('#show_hotel_near').click(function(){
                
                if($(this).is(':checked')){
                    $.each(array_hotelMarker, function(key, value){
                        this.setVisible(true);
                        this.setZIndex(1);
                        
                        //$("#abc").append('<div> Key: '+key+" - Value: "+value+"</div>");
                    });
                }else{
                    $.each(array_hotelMarker, function(key, value){
                        this.setVisible(false);
                        this.setZIndex(1);
                    });
                }
            });
            $('#show_location_near').click(function(){
                if($(this).attr('checked') == true){
                    $.each(array_locationMarker, function(key, value){
                        this.setVisible(true);
                        this.setZIndex(1);
                  //Show box info when mouse over icon
                        google.maps.event.addListener(this, 'mouseover', function(){
                            $('.mapinfohotel').remove();
                            $('body').append(showmapinfolocation(this));
                            $('.mapinfohotel').css('top', (my + 25) + 'px').css('left', (mx - 154) + 'px');
                        });
                    });
                }else{
                    $.each(array_locationMarker, function(key, value){
                        this.setVisible(false);
                    });
                }
            });
        });
</script>
<input type="checkbox" checked="checked" id="show_hotel_near">
<div id="abc"></div>
<div id="map_canvas_detail" class="mPop" style="width: 1300px; height: 490px;"></div>
<div class="mapinfohotel"></div>
<script type="text/javascript" src="<?=base_url()?>templates/js/jquery.js"></script>
<script type="text/javascript" src="<?=base_url()?>templates/js/mytour.min.js"></script> 
<style type="text/css">
.mapinfohotel {
    font-size: 11px;
    position: absolute;
    z-index: 99999;
}
</style>