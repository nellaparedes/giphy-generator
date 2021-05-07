<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       nella.com
 * @since      1.0.0
 *
 * @package    Giphy_Generator
 * @subpackage Giphy_Generator/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php if($images && count($images) > 0) : ?>
    <div class="giphy-message"></div>
    <ul class="giphy-grid">
        <?php foreach($images as $image) : ?>
            <li>
                <a class="handler" data-url="<?php echo $image['url']; ?>" title="Set as avatar">
                    <img src="<?php echo $image['url']; ?>" />
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>