<?php
function create_image()
{
    $APP = get_instance();
    $image_width = 60;
    $image_height = 26;
    $characters_on_image = 4;
    $font = BASEPATH.'font/utm_olossalis.ttf';

    //The characters that can be used in the CAPTCHA code.
    //avoid confusing characters (l 1 and i for example)
    $possible_letters = '123456789';
    $random_dots = 0;
    $random_lines = 0;
    $captcha_text_color="0xFFFFFF";
    $captcha_noice_color = "0x249805";

    $code = '';

    $i = 0;
    while ($i < $characters_on_image) { 
        $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters)-1), 1);
        $i++;
    }
    $APP->session->data['mabaove'] = $code;
    $font_size = $image_height * 0.5;
    $image = @imagecreate($image_width, $image_height);

    /* setting the background, text and noise colours here */
    $background_color = imagecolorallocate($image, 36, 152, 5);

    $arr_text_color = hexrgb($captcha_text_color);
    $text_color = imagecolorallocate($image, $arr_text_color['red'], $arr_text_color['green'], $arr_text_color['blue']);

    $arr_noice_color = hexrgb($captcha_noice_color);
    $image_noise_color = imagecolorallocate($image, $arr_noice_color['red'], $arr_noice_color['green'], $arr_noice_color['blue']);
    /* generating the dots randomly in background */
    for( $i=0; $i<$random_dots; $i++ ) {
    imagefilledellipse($image, mt_rand(0,$image_width),
        mt_rand(0,$image_height), 2, 3, $image_noise_color);
    }
    /* generating lines randomly in background of image */
    for( $i=0; $i<$random_lines; $i++ ) {
        imageline($image, mt_rand(0,$image_width), mt_rand(0,$image_height),
        mt_rand(0,$image_width), mt_rand(0,$image_height), $image_noise_color);
    }

    $textbox = imagettfbbox($font_size, 0, $font, $code); 
    $x = ($image_width - $textbox[4])/2;
    $y = ($image_height - $textbox[5])/2;
    imagettftext($image, $font_size, 0, $x, $y, $text_color, $font , $code);
    header('Content-Type: image/png');// defining the image type to be shown in browser widow
    imagepng($image);//showing the image
    imagedestroy($image);//destroying the image instance
    
    
}

function hexrgb ($hexstr){
  $int = hexdec($hexstr);
  return array("red" => 0xFF & ($int >> 0x10),
               "green" => 0xFF & ($int >> 0x8),
               "blue" => 0xFF & $int);
}
?>