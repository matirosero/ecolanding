<?php

remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );



/**
 * Get the payment ID from a user ID and download IE
 * 
 * @param int $download_id Download ID, int $user_ID User ID,
 * @return int $payment_id
*/
function edd_get_payment_id($user_ID, $download_id) {

	//If user has purchased this, find payment ID
	if( edd_has_user_purchased($user_ID, $download_id) ) {

		//Use Log IDs to get Payments IDs

		// Instantiate a new instance of the class
		$edd_logging = new EDD_Logging;

		// get logs for this download with type of 'sale'
		$logs = $edd_logging->get_logs( $download_id, 'sale' );

		// if logs exist
		if ( $logs ) {
			// create array to store our log IDs into
			$log_ids = array();
			// add each log ID to the array
			foreach ( $logs as $log ) {
				$log_ids[] = $log->ID;
			}
			// return our array

			$payment_ids = array();

			foreach ( $log_ids as $log_id ) {
				// get the payment ID for each corresponding log ID
				// $payment_ids[] = get_post_meta( $log_id, '_edd_log_payment_id', true );
				$payment_id = get_post_meta( $log_id, '_edd_log_payment_id', true );

				$payment = new EDD_Payment($payment_id);

				//http://stackoverflow.com/questions/8102221/php-multidimensional-array-searching-find-key-by-specific-value
				if ( $payment->user_id == $user_ID) {
					// echo 'PAYMENT USER ID <strong>'.$payment->user_id.'</strong> matches USER ID <strong>'.$user_ID.'</strong><br /> Return PAYMENT ID <strong>'.$payment_id.'</strong><br />';
					$the_payment_ID = $payment_id;

					return $the_payment_ID;
				}

			}

		}
	}
	return false;

}

/**
 * Get an array of all the log IDs using the EDD Logging Class
 * 
 * @return array if logs, null otherwise
 * @param $download_id Download's ID
*/
function get_log_ids( $download_id = '' ) {

	// Instantiate a new instance of the class
	$edd_logging = new EDD_Logging;

	// get logs for this download with type of 'sale'
	$logs = $edd_logging->get_logs( $download_id, 'sale' );

	// if logs exist
	if ( $logs ) {
		// create array to store our log IDs into
		$log_ids = array();
		// add each log ID to the array
		foreach ( $logs as $log ) {
			$log_ids[] = $log->ID;
		}
		// return our array
		return $log_ids;
	}
	
	return null;

}


/**
 * Get array of payment IDs
 * 
 * @param int $download_id Download ID
 * @return array $payment_ids
*/
function get_payment_ids( $download_id = '' ) {
	// these functions are used within a class, so you may need to update the function call
	$log_ids = $this->get_log_ids( $download_id );

	if ( $log_ids ) {
		// create $payment_ids array
		$payment_ids = array();

		foreach ( $log_ids as $id ) {
			// get the payment ID for each corresponding log ID
			$payment_ids[] = get_post_meta( $id, '_edd_log_payment_id', true );
		}
		
		// return our payment IDs
		return $payment_ids;
	}
	
	return null;
}