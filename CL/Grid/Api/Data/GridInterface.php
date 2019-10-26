<?php

namespace CL\Grid\Api\Data;

/**
 * Interface GridInterface
 * @package CL\Grid\Api\Data
 */
interface GridInterface
{
    const PRODUCT_ID = 'product_id';
    const SKU = 'sku';
    const VPN = 'vpn';
    const COPYRIGHT = 'copyright';
    const CREATION_TIME = 'creation_time';

    /**
     * @return mixed
     */
    public function getProductId();

    /**
     * @param $productId
     * @return mixed
     */
    public function setProductId($productId);

    /**
     * @return mixed
     */
    public function getSku();

    /**
     * @param $sku
     * @return mixed
     */
    public function setSku($sku);

    /**
     * @return mixed
     */
    public function getVpn();

    /**
     * @param $vpn
     * @return mixed
     */
    public function setVpn($vpn);

    /**
     * @return mixed
     */
    public function getCopyright();

    /**
     * @param $copyright
     * @return mixed
     */
    public function setCopyright($copyright);

    /**
     * @return mixed
     */
    public function getCreationTime();

    /**
     * @param $creationTime
     * @return mixed
     */
    public function setCreationTime($creationTime);
}
