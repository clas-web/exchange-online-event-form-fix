<?php
/**
 * @package Exchange_Online_Event_Form_Fix
 * @version 1.0
 */
/*
Plugin Name: Exchange Online Event Form Fix
Plugin URI: https://clas-pages.uncc.edu/oat/
Description: This plugin simply uses existing event form date and time data to creates a single datetime field.  (THIS PLUGIN SHOULD ONLY BE USED ON THE EXCHANGE ONLINE SITE.  THIS PLUGIN INCLUDES FIELD IDS FROM THE CURRENT SITE.  IF THE EXISTING EVENT FORM IS CHANGED, THIS PLUGIN MIGHT NO LONGER WORK...)
Author: Alex Chapin
Version: 1.0
Author URI: https://clas-pages.uncc.edu/oat/
*/

add_filter( 'frm_add_entry_meta', 'exchange_event_create_datetime_field', 9999 );

/**
 * Populates the datetime fields when submitting a Formidible Event form.
 */
function exchange_event_create_datetime_field( $values )
{
	if( $values['field_id'] == 271 ) // datetime
	{
		$datetime = DateTime::createFromFormat( 'm/d/Y h:i A', $_POST['item_meta'][100].' '.$_POST['item_meta'][101] );
		$values['meta_value'] = $datetime->format('Y-m-d H:i:s');
		$_POST['item_meta'][271] = $datetime->format('Y-m-d H:i:s');
		$_POST['frm_wp_post_custom']['271=datetime'] = $datetime->format('Y-m-d H:i:s');
	}
	
	if( $values['field_id'] == 278 ) // formatted datetime
	{	
		$datetime = DateTime::createFromFormat( 'm/d/Y h:i A', $_POST['item_meta'][100].' '.$_POST['item_meta'][101] );
		$values['meta_value'] = $datetime->format('F d, Y, g:i A');
		$_POST['item_meta'][278] = $datetime->format('F d, Y, g:i A');
		$_POST['frm_wp_post_custom']['278=formatted-datetime'] = $datetime->format('F d, Y, g:i A');
	}

	return $values;
}
