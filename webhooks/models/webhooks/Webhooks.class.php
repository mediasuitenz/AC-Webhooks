<?php

/**
 * webhooks manager class
 *
 * @package activeCollab.modules.webhooks
 * @subpackage models
 */
class Webhooks extends ApplicationObject
{
	const VERSION = '1.0.4013';

	/**
	 * Name of the table where records are stored
	 *
	 * @var string
	 */
	protected $table_name = 'webhooks';

	/**
	 * All table fields
	 *
	 * @var array
	 */
	protected $fields = array('id', 'event', 'callback');

	/**
	 * Primary key fields
	 *
	 * @var array
	 */
	protected $primary_key = array('id');

	/**
	 * Name of AI field (if any)
	 *
	 * @var string
	 */
	protected $auto_increment = 'id';

	/**
	 * Handle an event
	 *
	 * @param unknown_type $event
	 * @param unknown_type $args
	 */
	static function handleEvent($event, $args)
	{
		// grab the webhook
		$webhook = Webhooks::findByEventname($event);

		// valid webhook?
		if($webhook !== null)
		{
			// set options
			$options[CURLOPT_URL] = $webhook->getCallback();
			$options[CURLOPT_USERAGENT] = 'ActiveCollab/'.APPLICATION_VERSION.' Webhooks/'.self::VERSION;
			$options[CURLOPT_TIMEOUT] = 5;
			$options[CURLOPT_HTTP_VERSION] = CURL_HTTP_VERSION_1_1;
			$options[CURLOPT_FAILONERROR] = true;
			$options[CURLOPT_FOLLOWLOCATION] = true;
			$options[CURLOPT_SSL_VERIFYPEER] = false;
			$options[CURLOPT_SSL_VERIFYHOST] = false;
			$options[CURLOPT_POST] = true;
			$options[CURLOPT_POSTFIELDS]['event'] = $event;
			$options[CURLOPT_RETURNTRANSFER] = true; 

			if(!empty($args))
				$options[CURLOPT_POSTFIELDS]['data'] = @serialize($args);

			// init
			$curl = curl_init();

			// set options
			curl_setopt_array($curl, $options);

			// execute
			curl_exec($curl);

			// close
			curl_close($curl);
		}
	}

	/**
	 * Get all events
	 *
	 * @return array
	 */
	static function getEvents()
	{
		return array(
			'on_subtask_options',
			'on_subtasks_for_widget_options',
			'on_notification_channels',
			'on_activity_log_callbacks',
			'on_rebuild_activity_log_actions',
			'on_activity_log_decorator',
			'on_history_field_renderers',
			'on_homescreen_tab_types',
			'on_homescreen_widget_types',
			'on_all_indices',
			'on_rebuild_all_indices',
			'on_frequently',
			'on_hourly',
			'on_daily',
			'on_wireframe_updates',
			'on_initial_javascript_assign',
			'on_admin_tabs',
			'on_admin_panel',
			'on_load_control_tower',
			'on_load_control_tower_badge',
			'on_load_control_tower_settings',
			'on_object_options',
			'on_context_domains',
			'on_visible_contexts',
			'on_rebuild_object_contexts_actions',
			'on_object_context_changed',
			'on_system_notifications',
			'on_status_bar',
			'on_trash_sections',
			'on_empty_trash',
			'on_trash_map',
			'on_main_menu',
			'on_used_disk_space',
			'on_object_inspector',
			'on_inline_tabs',
			'on_users_tabs',
			'on_user_type_changed',
			'on_system_permissions',
			'on_custom_user_permissions',
			'on_user_cleanup',
			'on_reports_tabs',
			'on_reports_panel',
			'on_attachment_options',
			'on_custom_field_disabled',
			'on_object_completed',
			'on_object_opened',
			'on_payment_methods',
			'on_new_gateway',
			'on_search_providers',
			'on_search_indices',
			'on_incoming_mail_actions',
			'on_notification_context_view_url',
			'on_incoming_mail_interceptors',
			'on_object_from_notification_context',
			'on_notification_inspector',
			'on_comment_options',
			'on_comment_deleted',
			'on_comments_for_widget_options',
			'on_rawtext_to_richtext',
			'on_before_object_validation',
			'on_after_object_validation',
			'on_before_object_deleted',
			'on_object_deleted',
			'on_before_object_save',
			'on_after_object_save',
			'on_before_object_insert',
			'on_object_inserted',
			'on_before_object_update',
			'on_object_updated',
			'on_extra_stats',
			'on_shutdown',
			'on_label_types',
			'on_projects_tabs',
			'on_people_tabs',
			'on_phone_homescreen',
			'on_milestone_sections',
			'on_build_names_search_index_for_project',
			'on_client_saved',
			'on_project_brief_stats',
			'on_project_overview_sidebars',
			'on_master_categories',
			'on_extend_project_items_type_id_map',
			'on_project_permissions',
			'on_project_object_category_copied',
			'on_project_object_copied',
			'on_project_object_moved',
			'on_portal_object_quick_options',
			'on_build_project_search_index',
			'on_project_created',
			'on_quick_add',
			'on_project_user_added',
			'on_project_user_updated',
			'on_project_user_removed',
			'on_project_user_replaced',
			'on_project_subcontext_permission',
			'on_reserved_project_slugs',
			'on_project_deleted',
			'on_project_tabs',
			'on_rebuild_names_search_index_steps',
			'on_get_completable_project_object_types',
			'on_get_day_project_object_types',
			'on_mass_edit',
			'on_available_project_tabs',
			'on_project_export',
			'on_client_invoices_tabs',
			'on_invoices_tabs',
			'on_documents_tabs',
			'on_calendar_tabs',
			'on_project_assets_new_options',
			'on_asset_types',
		);
	}

	/**
	 * Return value of id field
	 *
	 * @param void
	 * @return integer
	 */
	function getId()
	{
		return $this->getFieldValue('id');
	}

	/**
	 * Set value of id field
	 *
	 * @param integer $value
	 * @return integer
	 */
	function setId($value)
	{
		return $this->setFieldValue('id', $value);
	}

	/**
	 * Return value of callback field
	 *
	 * @param void
	 * @return string
	 */
	function getCallback()
	{
		return $this->getFieldValue('callback');
	}

	/**
	 * Set value of callback field
	 *
	 * @param string $value
	 * @return string
	 */
	function setCallback($value)
	{
		return $this->setFieldValue('callback', $value);
	}

	/**
	 * Return value of event field
	 *
	 * @param void
	 * @return string
	 */
	function getEvent()
	{
		return $this->getFieldValue('event');
	}

	/**
	 * Set value of event field
	 *
	 * @param string $value
	 * @return string
	 */
	function setEvent($value)
	{
		return $this->setFieldValue('event', $value);
	}

	/**
	 * Return object by eventname
	 *
	 * @param mixed $id
	 * @return SourceRepository
	 */
	function findByEventname($event)
	{
		if(empty($event))
		{
			return null;
		}

		$conditions		=	array();
		$conditions[]	=	'event = '.DB::escape($event);

		$object = WHDataManager::find(array(
			'conditions'	=>	implode(' AND ', $conditions),
			'one'			=>	true
		), TABLE_PREFIX.'webhooks', DataManager::CLASS_NAME_FROM_TABLE, 'Webhooks');

		return $object;
	}
	
	public function getModelName($underscore = false, $singular = false)
    {
    	
    }
}
