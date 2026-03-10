/**
 * Add Vacile custom profile section
 */
add_action('show_user_profile', 'vacile_custom_profile_section');
add_action('edit_user_profile', 'vacile_custom_profile_section');

function vacile_custom_profile_section($user) {
    ?>
    <h2>Vacile Member Info</h2>
    <div class="vacile-user-account">
        <img src="<?php echo esc_url(get_avatar_url($user->ID, ['size' => 96])); ?>" 
             alt="<?php echo esc_attr($user->display_name); ?>" 
             class="vacile-user-avatar">
        <div class="vacile-user-info">
            <span class="vacile-user-name"><?php echo esc_html($user->display_name); ?></span>
            <span class="vacile-user-role"><?php echo esc_html(implode(', ', $user->roles)); ?></span>
        </div>
    </div>
    <?php
}