<?php

    function getDigits( $number, $length=0 )
    {
        $strlen = strlen($number);
        
        $arr    =    array();
        $diff    =    $length -  $strlen;
        
        // Push Leading Zeros
        while ( $diff>0 ){
            array_push( $arr,0 );
            $diff--;
        }
        
        // For PHP 4.x
        $arrNumber    =    array();
        for ($i = 0; $i < $strlen; $i++) {
            $arrNumber[] = substr($number,$i,1);
        }
        
        // For PHP 5.x: $arrNumber    =    str_split( $number );
        
        $arr        =    array_merge( $arr,$arrNumber );
        
        return $arr;
    }
    /* ------------------------------------------------------------------------------------------------ */
    

    
    /*
    ** Show Digit Counter Image
    */
    /* ------------------------------------------------------------------------------------------------ */
    function showDigitImage( $digit_type="default", $digit )
    {    
        $path = base_url().'site/views/modules/mod_online/number'; 
        $ret    =    '<img alr='.$digit.' src="'.$path.'/'.$digit_type.'/'.$digit.'.png"';
        $ret    .=    ' />';
        
        return $ret;
    }
    /* ------------------------------------------------------------------------------------------------ */    
$CI = get_instance();
$rs_i = $CI->online->hitsonline();     
$is_online = $CI->online->get_is_online();     
?>

<?php
    
    $path = base_url().'site/mod/mod_online/icon/';
    $digit_type  = 'ledgreen';//get_params('number',$attr);
    $number_digits  = 8;//get_params('total_number',$attr);
    $arr = $CI->online->getDigits( $rs_i->c_total,$number_digits );
    $h_o = '';
    foreach ($arr as $digit){
        $h_o .= $CI->online->showDigitImage( $digit_type, $digit );
    };
?>

<div class="char-outer">
	<div class="row"><label><i class="fa fa-user"></i>Đang online:</label><span><?=$is_online?></span></div>
	<div class="row"><label><i class="fa fa-user"></i>Lượt hôm nay:</label><span><?=$rs_i->c_today_hits?></span></div>
	<div class="row"><label><i class="fa fa-users"></i>Tổng lượt truy cập:</label><span><?=$rs_i->c_total?></span></div>
</div><!--char-outer-->

