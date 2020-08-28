<?php

namespace MylSoft\Weather\Cron;

use Magento\Framework\HTTP\Client\Curl;
use \Magento\Framework\ObjectManagerInterface;

class GetData
{

	protected $_objectManager;
	private $_curlClient;
    private $_apiUrl;

    /**
    * @param \Magento\Framework\ObjectManagerInterface $objectManager
    */
    public function __construct(ObjectManagerInterface $objectManager, Curl $curlClient) {
		$this->_objectManager = $objectManager;
        $this->_curlClient = $curlClient;
        $this->_apiUrl = 'http://api.openweathermap.org/data/2.5/weather?q={city},{code}&units=metric&appid=3f343b0ca451c3d06e48b7220b0c7c4d';
	}
	
	private function getCityData(string $city, string $countryCode): array {
        $url = str_replace(['{city}', '{code}'], [$city, $countryCode], $this->_apiUrl);
        $this->_curlClient->get($url);
		$response = $this->_curlClient->getBody();
		
		return $this->parseWeatherData($response);
	}
	
	private function parseWeatherData(string $jsonResponse): array {
		$jsonObj = json_decode($jsonResponse);

		if($jsonObj->cod != 200)
		{
			return [];
		}

		return [
			'city_id' => $jsonObj->id,
			'name' => $jsonObj->name,
			'country' => $jsonObj->sys->country,
			'temp' => $jsonObj->main->temp,
			'feels_like' => $jsonObj->main->feels_like,
			'temp_min' => $jsonObj->main->temp_min,
			'temp_max' => $jsonObj->main->temp_max,
			'wind_speed' => $jsonObj->wind->speed,
			'wind_deg' => $jsonObj->wind->deg,
			'pressure' => $jsonObj->main->pressure,
			'humidity' => $jsonObj->main->humidity,
			'clouds' => $jsonObj->clouds->all,
		];
	}

	public function execute()
	{

		$writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cron.log');
		$logger = new \Zend\Log\Logger();
		$logger->addWriter($writer);
		$logger->info(__METHOD__);
		
		$repo = $this->_objectManager->get('MylSoft\Weather\Model\ResourceModel\WeatherRepository');
		$logger->info('TEST MYL2 weathe:');
		$response = $this->getCityData('Lublin', 'pl');
		$res = $repo->addData($response); 
		$logger->info($res);

		return $this;
	}
}