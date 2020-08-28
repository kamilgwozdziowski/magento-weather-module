<?php
namespace MylSoft\Weather\Model;

class Weather extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'mylsoft_weather_weather';

	protected $_cacheTag = 'mylsoft_weather_weather';

	protected $_eventPrefix = 'mylsoft_weather_weather';

	protected function _construct()
	{
		$this->_init('MylSoft\Weather\Model\ResourceModel\Weather');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}