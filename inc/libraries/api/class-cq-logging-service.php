<?php
namespace COINQVEST\Inc\Libraries\Api;

defined('ABSPATH') or exit;

/**
 * Class CQ_Logging_Service
 *
 * A logging service
 */
class CQ_Logging_Service {

    /**
     * Writes to a log file and prepends current time stamp
     *
     * @param $message
     */
    public static function write($message) {

        $cq_settings = get_option('coinqvest_settings');
        $cq_settings = unserialize($cq_settings);
        $log = isset($cq_settings['debug_log']) ? $cq_settings['debug_log'] : null;

        if ($log && $log == 'no') {
            return;
        }

	    global $wpdb;
	    $table_name = $wpdb->prefix . 'coinqvest_logs';

	    $wpdb->insert(
		    $table_name,
		    array(
			    'message' => $message,
		    	'time' => current_time('mysql')
		    )
	    );
    }

}