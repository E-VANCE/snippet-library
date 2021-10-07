<?php
/**
 * Gravity Perks // Unique ID // Set Authorize.net Transaction Invoice Number
 * https://gravitywiz.com/documentation/gp-unique-id/
 *
 * This snippet sets the Authorize.net transaction invoice number using the unique ID generated by the Unique ID field.
 */
add_filter( 'gform_authorizenet_transaction_pre_capture', 'gpui_set_unique_transaction_id', 10, 5 );
function gpui_set_unique_transaction_id( $transaction, $form_data, $config, $form ) {

    // Update "123" to the form ID
    $target_form_id = 123; 
    // Update "4" to the Unique ID field ID
    $unique_id_field_id = 4; 

    if( $form['id'] == $target_form_id && is_callable( 'gp_unique_id' ) ) {
        foreach ( $form['fields'] as $field ) {
            if ($field->id == $unique_id_field_id){
                $uid = gp_unique_id()->get_unique( $form['id'], $field );
                $transaction->invoice_num = $uid;
                $_POST[ "input_{$unique_id_field_id}" ] = $uid;
            }
        }
    }
    return $transaction;
}
