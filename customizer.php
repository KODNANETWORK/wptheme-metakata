<?php
/**
 * The customizer file
 *
 * This is the customizer file in a WordPress theme.
 *
 * @link https://kodna.net/
 *
 * @package WordPress
 * @subpackage MetaKata
 * @since 0
 */
/* control panel */
function metarealm_customize_register($wp_customize) {
/* upload icon image */
$wp_customize->add_section('pdn_home_section', array(
'title' => 'Icon',
'description'   => 'Update image'
)
);
$wp_customize->add_setting('pdn_home_img_settings', array(
//default value
)
);
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'pdn_home_img_control', array(
'label' => 'Edit Image',
'settings'  => 'pdn_home_img_settings',
'section'   => 'pdn_home_section'
)
)
);
/* text area */
$wp_customize->add_section('callout-section', array(
'title' => 'Callout Text'
)
);
$wp_customize->add_setting('callout-custom-text', array(
'default' => 'Example Text'
)
);
$wp_customize->add_control( new WP_Customize_Control($wp_customize,'callout-text-control', array(
'label' => 'Text',
'section' => 'callout-section',
'settings' => 'callout-custom-text'
)
)
);
}
add_action('customize_register', 'metarealm_customize_register');
?>
