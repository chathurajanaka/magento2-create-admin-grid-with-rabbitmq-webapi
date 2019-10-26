<?php

namespace CL\Grid\Api;

/**
 * Interface ProductInterface
 * @package CL\Grid\Api
 */
interface ProductInterface
{
    /**
     * @return mixed
     */
    public function getProductDataByVPN();

    /**
     * @return mixed
     */
    public function updateProductData();
}
