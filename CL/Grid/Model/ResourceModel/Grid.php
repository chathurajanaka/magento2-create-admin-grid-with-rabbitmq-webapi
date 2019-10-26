<?php

namespace CL\Grid\Model\ResourceModel;

use Magento\Framework\Stdlib\DateTime\DateTime;

/**
 * Grid Grid mysql resource.
 */
class Grid extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var string
     */
    protected $_idFieldName = 'product_id';
    /**
     * @var DateTime
     */
    protected $_date;

    /**
     * Grid constructor.
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param DateTime $date
     * @param null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        DateTime $date,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('cl_custom_catalog_grid', 'product_id');
    }
}
