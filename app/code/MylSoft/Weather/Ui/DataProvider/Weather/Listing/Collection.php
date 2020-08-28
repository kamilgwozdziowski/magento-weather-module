<?php
namespace MylSoft\Weather\Ui\DataProvider\Weather\Listing;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * Override _initSelect to add custom columns
     *
     * @return void
     */
    protected function _initSelect()
    {
        $this->addFilterToMap('name', 'mylsoftweathername.value');
        parent::_initSelect();
    }
}
