<?php
namespace MylSoft\Weather\Model\ResourceModel;

use MylSoft\Weather\Model\WeatherFactory;

class WeatherRepository {

    private $_weatherFactory;

    public function __construct(WeatherFactory  $weatherFactory)
    {
        $this->_weatherFactory = $weatherFactory;
    }    

    public function addData(array $data)
    {
        $data['time'] = time();
        $weather = $this->_weatherFactory->create();
        $weather->setData($data);
        $weather->save();

        return $post;
    }
}