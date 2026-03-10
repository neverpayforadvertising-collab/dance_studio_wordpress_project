<?php
$global_settings = new Eventprime_Global_Settings;
$global_options = $global_settings->ep_get_settings();
$ep_functions = new Eventprime_Basic_Functions;
$sub_options = $global_settings->sub_options;
$is_paypal_enabled = ! empty( $global_options->paypal_processor );?>
<table class="form-table">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="em_enable_paypal">
                    <?php esc_html_e( 'Enable/Disable', 'eventprime-event-calendar-management' );?>
                </label>
            </th>
            <td class="forminp forminp-text">
                <label class="ep-toggle-btn">
                    <input name="paypal_processor" id="ep_paypal_processor_settings" type="checkbox" value="1" <?php echo isset($global_options->paypal_processor ) && $global_options->paypal_processor == 1 ? 'checked' : '';?>>
                    <span class="ep-toogle-slider round"></span>
                </label>
                <div class="ep-help-tip-info ep-my-2 ep-text-muted"><?php esc_html_e( 'Enable or Disable Payment Gateway on checkout.', 'eventprime-event-calendar-management' );?></div>
            </td>
        </tr>
        <tr valign="top" class="ep-enable-paypal-service" id="ep_modern_paypal_test_mode_child" <?php echo $is_paypal_enabled ? '' : 'style="display:none;"'; ?>>
            <th scope="row" class="titledesc">
                <label for="payment_test_mode">
                    <?php esc_html_e( 'PayPal Sandbox Mode', 'eventprime-event-calendar-management' );?>
                </label>
            </th>
            <td class="forminp forminp-text">
                <label class="ep-toggle-btn">
                    <input name="payment_test_mode" id="payment_test_mode" type="checkbox" value="1" <?php echo isset( $global_options->payment_test_mode ) && (int) $global_options->payment_test_mode === 1 ? 'checked' : '';?>>
                    <span class="ep-toogle-slider round"></span>
                </label>
                <div class="ep-help-tip-info ep-my-2 ep-text-muted"><?php esc_html_e( 'Enable sandbox mode to process test transactions with PayPal.', 'eventprime-event-calendar-management' );?></div>
            </td>
        </tr>
        <tr valign="top" class="ep-enable-paypal-service" id="ep_modern_paypal_child" <?php echo $is_paypal_enabled ? '' : 'style="display:none;"'; ?>>
            <th scope="row" class="titledesc">
                <label for="paypal_client_id">
                    <?php esc_html_e( 'Paypal Client Id', 'eventprime-event-calendar-management' );?>
                </label>
            </th>
            <td class="forminp forminp-text">
                <input name="paypal_client_id" class="regular-text" id="paypal_client_id" type="text" value="<?php echo isset($global_options->paypal_client_id) ? esc_attr($global_options->paypal_client_id) : '';?>" required>
                <div class="ep-help-tip-info ep-my-2 ep-text-muted">
                    <?php 
                    $paypal_help_url = 'https://theeventprime.com/how-to-get-paypal-client-id-and-secret-key-for-wordpress-events-in-eventprime/';
                    printf(esc_html__( 'Enter your PayPal client id. %s How to find your PayPal client ID and secret? %s', 'eventprime-event-calendar-management' ),'<a href="' . esc_url( $paypal_help_url ) . '" target="_blank">','</a>');
                    ?>
                </div>

            </td>
        </tr>
        <tr valign="top" class="ep-enable-paypal-service" id="ep_modern_paypal_secret_child" <?php echo $is_paypal_enabled ? '' : 'style="display:none;"'; ?>>
            <th scope="row" class="titledesc">
                <label for="paypal_client_secret">
                    <?php esc_html_e( 'Paypal Client Secret', 'eventprime-event-calendar-management' );?>
                </label>
            </th>
            <td class="forminp forminp-text">
                <input name="paypal_client_secret" class="regular-text" id="paypal_client_secret" type="password" autocomplete="new-password" value="<?php echo isset( $global_options->paypal_client_secret ) ? esc_attr( $global_options->paypal_client_secret ) : ''; ?>">
                <div class="ep-help-tip-info ep-my-2 ep-text-muted">
                    <?php esc_html_e( 'Required for server-side PayPal order verification.', 'eventprime-event-calendar-management' );?>
                </div>
            </td>
        </tr>
    </tbody>
</table>
