<?php

namespace CL\Grid\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'product_id';
    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init(
            'CL\Grid\Model\Grid',
            'CL\Grid\Model\ResourceModel\Grid'
        );
    }
}
