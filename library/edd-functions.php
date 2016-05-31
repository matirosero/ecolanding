<?php

remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );


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