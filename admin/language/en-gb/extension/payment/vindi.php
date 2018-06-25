<?php

// Heading
$_['heading_title']                                         = 'Vindi OpenCart';
$_['heading_title_transaction']                             = 'View Transaction #%s';

// Help
$_['help_display_name']                                     = 'This text is the name of the payment method your customers will see during checkout. Default: Vindi Payment Gateway Services';
$_['help_api_key']                                          = 'Enter the API Key that is located in <strong>Vindi</strong> under <strong>Settings -> API Access Keys</strong>.';
$_['help_debug_log']                                        = 'Use this for debugging purposes. Enabling this will log the following to your OpenCart error log: notification data, REST API requests, REST API responses';
$_['help_gateway']                                          = 'If you want to enable test mode, select <strong>Sandbox</strong> in connection mode.';

// Tab
$_['tab_setting']                                           = 'Settings';

// Text
$_['text_edit']                                             = 'Vindi Payment Gateway Services';
$_['text_extension']                                        = 'Extensions';
$_['text_vindi']                                   = '<a target="_BLANK" href="https://www.vindi.com.br"><img src="view/image/payment/vindi.png" alt="Vindi Payment Gateway Services" title="Vindi Payment Gateway Services" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_success']                                          = 'Success: You have modified Vindi Payment Gateway Services payment module!';
$_['text_gateway_sandbox']                                       = 'Sandbox (Test)';
$_['text_gateway_production']                                       = 'Production';
$_['text_lightbox']                                         = 'Lightbox';
$_['text_hosted_payment_page']                              = 'Hosted Payment Page';
$_['text_pay']                                              = 'Pay';
$_['text_authorize']                                        = 'Authorize';
$_['text_notification_ssl']                                 = 'Careful: This payment extension will not work on stores without SSL.';
$_['text_loading']                                          = 'Loading data... Please wait...';
$_['text_loading_short']                                    = 'Please wait...';
$_['text_view']                                             = 'View';
$_['text_general_settings']                                 = 'General Settings';
$_['text_transaction_statuses']                             = 'Transaction Statuses';
$_['text_copy_clipboard']                                   = 'Copy to Clipboard';
$_['text_show_hide']                                        = 'Show/Hide';
$_['text_log_api_intro']                                    = '[Vindi Payment Gateway Services - REST API %s]: ';

// Entry
$_['entry_display_name']                                    = 'Display Name';
$_['entry_status']                                          = 'Status';
$_['entry_sort_order']                                      = 'Sort Order';
$_['entry_gateway']                                         = 'Connection Mode';
$_['entry_api_key']                                         = 'API Key';
$_['entry_debug_log']                                       = 'Debug Logging';
$_['entry_transaction_id']                                  = 'Transaction ID';
$_['entry_order_id']                                        = 'Order ID';
$_['entry_partner_solution_id']                             = 'Partner Solution ID';
$_['entry_result']                                          = 'Transaction Result';
$_['entry_type']                                            = 'Transaction Type';
$_['entry_currency']                                        = 'Currency';
$_['entry_amount']                                          = 'Amount';
$_['entry_risk_code']                                       = 'Risk Status';
$_['entry_risk_score']                                      = 'Risk Score';
$_['entry_api_version']                                     = 'API Version';
$_['entry_browser']                                         = 'Customer User Agent';
$_['entry_ip']                                              = 'Customer IP';
$_['entry_date_created']                                    = 'Date Created';
$_['entry_approved_authorization_order_status']             = 'Approved: Authorization';
$_['entry_approved_capture_order_status']                   = 'Approved: Capture';
$_['entry_approved_payment_order_status']                   = 'Approved: Payment';
$_['entry_approved_refund_order_status']                    = 'Approved: Refund';
$_['entry_approved_void_order_status']                      = 'Approved: Void';
$_['entry_approved_verification_order_status']              = 'Approved: Verification';
$_['entry_unspecified_failure_order_status']                = 'Unspecified Failure';
$_['entry_declined_order_status']                           = 'Declined';
$_['entry_timed_out_order_status']                          = 'Timed Out';
$_['entry_expired_card_order_status']                       = 'Expired Card';
$_['entry_insufficient_funds_order_status']                 = 'Insufficient Funds';
$_['entry_acquirer_system_error_order_status']              = 'Acquirer System Error';
$_['entry_system_error_order_status']                       = 'System Error';
$_['entry_not_supported_order_status']                      = 'Not Supported';
$_['entry_declined_do_not_contact_order_status']            = 'Declined Do Not Contact';
$_['entry_aborted_order_status']                            = 'Aborted';
$_['entry_blocked_order_status']                            = 'Blocked';
$_['entry_cancelled_order_status']                          = 'Cancelled';
$_['entry_deferred_transaction_received_order_status']      = 'Deferred Transaction Received';
$_['entry_referred_order_status']                           = 'Referred';
$_['entry_authentication_failed_order_status']              = 'Authentication Failed';
$_['entry_invalid_csc_order_status']                        = 'Invalid CSC';
$_['entry_lock_failure_order_status']                       = 'Lock Failure';
$_['entry_submitted_order_status']                          = 'Submitted';
$_['entry_not_enrolled_3d_secure_order_status']             = 'Not Enrolled 3D Secure';
$_['entry_pending_order_status']                            = 'Pending';
$_['entry_exceeded_retry_limit_order_status']               = 'Exceeded Retry Limit';
$_['entry_duplicate_batch_order_status']                    = 'Duplicate Batch';
$_['entry_declined_avs_order_status']                       = 'Declined AVS';
$_['entry_declined_csc_order_status']                       = 'Declined CSC';
$_['entry_declined_avs_csc_order_status']                   = 'Declined AVS/CSC';
$_['entry_declined_payment_plan_order_status']              = 'Declined Payment Plan';
$_['entry_approved_pending_settlement_order_status']        = 'Approved Pending Settlement';
$_['entry_partially_approved_order_status']                 = 'Partially Approved';
$_['entry_unknown_order_status']                            = 'Unknown';
$_['entry_risk_rejected_order_status']                      = 'Risk Assessment: Rejected';
$_['entry_risk_review_pending_order_status']                = 'Risk Review: Pending';
$_['entry_risk_review_rejected_order_status']               = 'Risk Review: Rejected';

// Error
$_['error_permission']                                      = 'Warning: You do not have permission to modify payment Vindi Payment Gateway Services!';
$_['error_api_key']                                         = 'You must specify a API Key with 43 characters.';
$_['error_notification_secret']                             = 'You must specify your notification secret, which is 32 characters long.';
$_['error_not_authorization']                               = 'Invalid transaction type. Expecting: AUTHORIZATION, AUTHORIZATION_UPDATE.';
$_['error_not_capture']                                     = 'Invalid transaction type. Expecting: CAPTURE, PAYMENT.';
$_['error_invalid_amount']                                  = 'Invalid amount. Please insert a valid numeric value.';
$_['error_api']                                             = 'An API error occurred: %s';
$_['error_api_transaction']                                 = 'Could not create new transaction.';
$_['error_unknown']                                         = 'An unexpected error has occurred. Please report this to the store owners.';
$_['error_warning']                                         = 'Warning: Please check the form carefully for errors!';

// Column
$_['column_transaction_id']                                 = 'Transaction ID';
$_['column_api_key']                                        = 'API Key';
$_['column_order_id']                                       = 'Order ID';
$_['column_status']                                         = 'Status';
$_['column_type']                                           = 'Type';
$_['column_amount']                                         = 'Amount';
$_['column_risk']                                           = 'Risk';
$_['column_ip']                                             = 'IP';
$_['column_date_created']                                   = 'Date Created';
$_['column_action']                                         = 'Action';

// Button
$_['button_void']                                           = 'Void';
$_['button_refund']                                         = 'Refund';
$_['button_capture']                                        = 'Capture';
$_['button_copy_clipboard']                                 = 'Copy to Clipboard';