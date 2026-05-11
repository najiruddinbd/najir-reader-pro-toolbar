<?php
/*
Plugin Name: Najir Reader Pro Toolbar
Description: Premium reading toolbar with advanced UI control system
Version: 1.3
Author: Najir Uddin
*/

if (!defined('ABSPATH')) exit;

/* ================= DEFAULT SETTINGS ================= */
function nr_default_settings(){
    return [
        'bg_enable' => 1,

        // Desktop Colors
        'bg_desktop' => '#111111',
        'btn_bg_desktop' => '#ffffff',
        'btn_color_desktop' => '#000000',

        // Mobile Colors
        'bg_mobile' => '#222222',
        'btn_bg_mobile' => '#ffffff',
        'btn_color_mobile' => '#000000',

        // Border
        'border_enable' => 1,
        'border_width' => 1,
        'border_color' => '#000',

        // Radius (Desktop)
        'radius' => 10,

        // Padding (Desktop)
        'pad_top' => 8,
        'pad_right' => 8,
        'pad_bottom' => 8,
        'pad_left' => 8,

        // Font Step (Desktop)
        'step' => 2,

        // Animation
        'anim_duration' => 0.3,

        // Position
        'desktop_pos' => 'right',
        'mobile_align' => 'center',

        // UI SCALE (Desktop)
        'toolbar_scale' => 1,
        'button_scale' => 1,

        /* ================= MOBILE UI CONTROL ================= */
        'm_radius' => 10,

        'm_pad_top' => 6,
        'm_pad_right' => 10,
        'm_pad_bottom' => 6,
        'm_pad_left' => 10,

        'm_step' => 2,

        'm_toolbar_scale' => 1,
        'm_button_scale' => 1,
    ];
}

/* ================= ADMIN MENU ================= */
add_action('admin_menu', function () {
    add_menu_page(
        'Najir Reader Pro',
        'Najir Reader Pro',
        'manage_options',
        'nr-settings',
        'nr_settings_page',
        'dashicons-welcome-view-site'
    );
});

/* ================= REGISTER SETTINGS ================= */
add_action('admin_init', function () {
    register_setting('nr_group', 'nr_settings');

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
});

/* ================= ADMIN PANEL ================= */
function nr_settings_page(){
    $opt = wp_parse_args(get_option('nr_settings'), nr_default_settings());
?>
<div class="wrap">
<h1>🔥 Najir Reader Pro Settings</h1>

<form method="post" action="options.php">
<?php settings_fields('nr_group'); ?>

<!-- ================= DESKTOP ================= -->
<h2>🖥️ Desktop UI Control</h2>

<h3>🎨 Background Color</h3>
<input type="text" class="color-field" name="nr_settings[bg_desktop]" value="<?php echo $opt['bg_desktop']; ?>">

<h3>🔘 Button Background</h3>
<input type="text" class="color-field" name="nr_settings[btn_bg_desktop]" value="<?php echo $opt['btn_bg_desktop']; ?>">

<h3>🔤 Button Text Color</h3>
<input type="text" class="color-field" name="nr_settings[btn_color_desktop]" value="<?php echo $opt['btn_color_desktop']; ?>">

<hr>

<h3>📐 Radius</h3>
<input type="number" name="nr_settings[radius]" value="<?php echo $opt['radius']; ?>">

<h3>📦 Padding</h3>
Top <input type="number" name="nr_settings[pad_top]" value="<?php echo $opt['pad_top']; ?>">
Right <input type="number" name="nr_settings[pad_right]" value="<?php echo $opt['pad_right']; ?>">
Bottom <input type="number" name="nr_settings[pad_bottom]" value="<?php echo $opt['pad_bottom']; ?>">
Left <input type="number" name="nr_settings[pad_left]" value="<?php echo $opt['pad_left']; ?>">

<h3>🔠 Font Step</h3>
<input type="number" name="nr_settings[step]" value="<?php echo $opt['step']; ?>">

<h3>📏 Toolbar Scale</h3>
<input type="number" step="0.1" name="nr_settings[toolbar_scale]" value="<?php echo $opt['toolbar_scale']; ?>">

<h3>🔘 Button Scale</h3>
<input type="number" step="0.1" name="nr_settings[button_scale]" value="<?php echo $opt['button_scale']; ?>">

<hr>

<!-- ================= MOBILE ================= -->
<h2>📱 Mobile UI Control</h2>

<h3>🎨 Background Color</h3>
<input type="text" class="color-field" name="nr_settings[bg_mobile]" value="<?php echo $opt['bg_mobile']; ?>">

<h3>🔘 Button Background</h3>
<input type="text" class="color-field" name="nr_settings[btn_bg_mobile]" value="<?php echo $opt['btn_bg_mobile']; ?>">

<h3>🔤 Button Text Color</h3>
<input type="text" class="color-field" name="nr_settings[btn_color_mobile]" value="<?php echo $opt['btn_color_mobile']; ?>">

<hr>

<h3>📐 Radius</h3>
<input type="number" name="nr_settings[m_radius]" value="<?php echo $opt['m_radius']; ?>">

<h3>📦 Padding</h3>
Top <input type="number" name="nr_settings[m_pad_top]" value="<?php echo $opt['m_pad_top']; ?>">
Right <input type="number" name="nr_settings[m_pad_right]" value="<?php echo $opt['m_pad_right']; ?>">
Bottom <input type="number" name="nr_settings[m_pad_bottom]" value="<?php echo $opt['m_pad_bottom']; ?>">
Left <input type="number" name="nr_settings[m_pad_left]" value="<?php echo $opt['m_pad_left']; ?>">

<h3>🔠 Font Step</h3>
<input type="number" name="nr_settings[m_step]" value="<?php echo $opt['m_step']; ?>">

<h3>📏 Toolbar Scale</h3>
<input type="number" step="0.1" name="nr_settings[m_toolbar_scale]" value="<?php echo $opt['m_toolbar_scale']; ?>">

<h3>🔘 Button Scale</h3>
<input type="number" step="0.1" name="nr_settings[m_button_scale]" value="<?php echo $opt['m_button_scale']; ?>">

<hr>

<!-- ================= POSITION ================= -->
<h2>📍 Desktop Position</h2>
<select name="nr_settings[desktop_pos]">
    <option value="left" <?php selected($opt['desktop_pos'],'left'); ?>>Left</option>
    <option value="right" <?php selected($opt['desktop_pos'],'right'); ?>>Right</option>
</select>

<h2>📱 Mobile Align</h2>
<select name="nr_settings[mobile_align]">
    <option value="left" <?php selected($opt['mobile_align'],'left'); ?>>Left</option>
    <option value="center" <?php selected($opt['mobile_align'],'center'); ?>>Center</option>
    <option value="right" <?php selected($opt['mobile_align'],'right'); ?>>Right</option>
</select>

<br><br>
<button class="button button-primary">Save Settings</button>

</form>
</div>

<script>
jQuery(function($){
    $('.color-field').wpColorPicker();
});
</script>
<?php }

/* ================= FRONTEND ================= */
add_action('wp_enqueue_scripts', function () {
    if (!is_single()) return;

    wp_enqueue_style('nr-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('nr-script', plugin_dir_url(__FILE__) . 'assets/script.js', [], null, true);

    $settings = wp_parse_args(get_option('nr_settings'), nr_default_settings());
    wp_localize_script('nr-script', 'nrData', $settings);
});

/* ================= TOOLBAR ================= */
add_action('wp_footer', function () {
    if (!is_single()) return;

    echo '
    <div id="nr-toolbar">
        <button data-action="increase">A+</button>
        <button data-action="decrease">A-</button>
        <button data-action="reset">Reset</button>
    </div>';
});