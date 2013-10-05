<?php

class WHDataManager extends DataManager
{
	/**
	 * Return name of this model
	 *
	 * @param boolean $underscore
	 * @return string
	 */
	public static function getModelName($underscore = false)
	{
		return WEBHOOKS_MODULE;
	}

	/**
	 * Return name of the table where system will persist model instances
	 *
	 * @param boolean $with_prefix
	 * @return string
	 */
	public static function getTableName($with_prefix = true)
	{
		$table	=	'webhooks';
		
		return ($with_prefix ? TABLE_PREFIX : null).$table;
	}

	/**
	 * Return class name of a single instance
	 *
	 * @return string
	 */
	public static function getInstanceClassName()
	{
		return 'Webhooks';
	}

	/**
	 * Return whether instance class name should be loaded from a field, or based on table name
	 *
	 * @return string
	 */
	public static function getInstanceClassNameFrom()
	{
		return DataManager::CLASS_NAME_FROM_TABLE;
	}

	/**
	 * Return name of the field from which we will read instance class
	 *
	 * @return string
	 */
	public static function getInstanceClassNameFromField()
	{
		throw new NotImplementedError(__METHOD__);
	}

	/**
	 * Return default order by clause
	 *
	 * @return string
	 */
	public static function getDefaultOrderBy()
	{

	}
 }