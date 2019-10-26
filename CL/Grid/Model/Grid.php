<?php


namespace CL\Grid\Model;

use CL\Grid\Api\Data\GridInterface;

/**
 * Class Grid
 * @package CL\Grid\Model
 */
class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'cl_custom_catalog_grid';

    /**
     * @var string
     */
    protected $_cacheTag = 'cl_custom_catalog_grid';

    /**
     * Prefix of model events names.
     *
     * @var string
     */
    protected $_eventPrefix = 'cl_custom_catalog_grid';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('CL\Grid\Model\ResourceModel\Grid');
    }
    /**
     * @return mixed
     */
    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    /**
     * @param $productId
     * @return Product|mixed
     */
    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @return mixed
     */
    public function getSku()
    {
        return $this->getData(self::SKU);
    }

    /**
     * @param $sku
     * @return Product|mixed
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * @return mixed
     */
    public function getVpn()
    {
        return $this->getData(self::VPN);
    }
    /**
     * @param $vpn
     * @return Product|mixed
     */
    public function setVpn($vpn)
    {
        return $this->setData(self::VPN, $vpn);
    }

    /**
     * @return mixed
     */
    public function getCopyright()
    {
        return $this->getData(self::COPYRIGHT);
    }

    /**
     * @param $copyright
     * @return Grid|mixed
     */
    public function setCopyright($copyright)
    {
        return $this->setData(self::COPY_WRITE, $copyright);
    }

    /**
     * @return mixed
     */
    public function getCreationTime()
    {
        return $this->getData(self::CREATION_TIME);
    }

    /**
     * @param $creationTime
     * @return Product|mixed
     */
    public function setCreationTime($creationTime)
    {
        return $this->setData(self::CREATION_TIME, $creationTime);
    }
}
