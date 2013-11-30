<?php
//
//        A simple PHP CAPTCHA script
//
//        Copyright 2013 by Cory LaViska for A Beautiful Site, LLC.
//
//        See readme.md for usage, demo, and licensing info
//
class Captcha
{
public static function simple_php_captcha($config = array()) {
        
        // Check for GD library
        if( !function_exists('gd_info') ) {
                throw new Exception('Required GD library is missing');
        }
        
$bg_path = dirname(__FILE__) . '/captcha/backgrounds/';
        $font_path = dirname(__FILE__) . '/captcha/fonts/';
        
        // Default values
        $captcha_config = array(
                'code' => '',
                'min_length' => 7,
                'max_length' => 7,
                'backgrounds' => array(
                        $bg_path . '45-degree-fabric.png',
                        $bg_path . 'cloth-alike.png',
                        $bg_path . 'grey-sandbag.png',
                        $bg_path . 'kinda-jean.png',
                        $bg_path . 'polyester-lite.png',
                        $bg_path . 'stitched-wool.png',
                        $bg_path . 'white-carbon.png',
                        $bg_path . 'white-wave.png'
                ),
                'fonts' => array(
                        $font_path . 'times_new_yorker.ttf'
                ),
                'characters' => 'ABCDEFGHJKLMNPRSTUVWXYZabcdefghjkmnprstuvwxyz23456789',
                'min_font_size' => 28,
                'max_font_size' => 28,
                'color' => '#666',
                'angle_min' => 0,
                'angle_max' => 10,
                'shadow' => true,
                'shadow_color' => '#fff',
                'shadow_offset_x' => -1,
                'shadow_offset_y' => 1
        );
        
        // Overwrite defaults with custom config values
        if( is_array($config) ) {
                foreach( $config as $key => $value ) $captcha_config[$key] = $value;
        }
        
        // Restrict certain values
        if( $captcha_config['min_length'] < 1 ) $captcha_config['min_length'] = 1;
        if( $captcha_config['angle_min'] < 0 ) $captcha_config['angle_min'] = 0;
        if( $captcha_config['angle_max'] > 10 ) $captcha_config['angle_max'] = 10;
        if( $captcha_config['angle_max'] < $captcha_config['angle_min'] ) $captcha_config['angle_max'] = $captcha_config['angle_min'];
        if( $captcha_config['min_font_size'] < 10 ) $captcha_config['min_font_size'] = 10;
        if( $captcha_config['max_font_size'] < $captcha_config['min_font_size'] ) $captcha_config['max_font_size'] = $captcha_config['min_font_size'];
        
        // Use milliseconds instead of seconds
        srand(microtime() * 100);
        
        // Generate CAPTCHA code if not set by user
        if( empty($captcha_config['code']) ) {
                $captcha_config['code'] = '';
                $length = rand($captcha_config['min_length'], $captcha_config['max_length']);
                while( strlen($captcha_config['code']) < $length ) {
                        $captcha_config['code'] .= substr($captcha_config['characters'], rand() % (strlen($captcha_config['characters'])), 1);
                }
        }
        
        // Generate HTML for image src
        $image_src = substr(dirname(__FILE__) . '/captcha/capget.php', strlen($_SERVER['DOCUMENT_ROOT'])) . '?_CAPTCHA&amp;t=' . urlencode(microtime());
        $image_src = '/' . ltrim(preg_replace('/\\\\/', '/', $image_src), '/');
        
        $_SESSION['_CAPTCHA']['config'] = serialize($captcha_config);
        
        return array(
                'code' => $captcha_config['code'],
                'image_src' => $image_src
        );
        
}



}