<?php
namespace MylSoft\Weather\Model\ResourceModel\Weather;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'id';
	protected $_eventPrefix = 'mylsoft_weather_weather';
	protected $_eventObject = 'weather_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('MylSoft\Weather\Model\Weather', 'MylSoft\Weather\Model\ResourceModel\Weather');
	}

}