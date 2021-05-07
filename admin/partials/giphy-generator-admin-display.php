<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       nella.com
 * @since      1.0.0
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1>Giphy Generator Settings</h1>
    <form method="post" action="options.php">
        <?php 
        settings_fields('giphy_options'); 
        do_settings_sections( 'giphy_options' );
        ?>
        
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Giphy words</th>
                <td>
                    <input type="text" name="giphy_words" value="<?php echo esc_attr( get_option('giphy_words') ); ?>" />
                </td>
            </tr>
        </table>
        <?php submit_button(); ?> 
    </form>
</div>