<?php

namespace CL\Grid\Model;

use CL\Grid\Api\ProductInterface;
use CL\Grid\Helper\Data;
use Magento\Framework\DataObject;
use Magento\Store\Model\StoreManagerInterface;
use CL\Grid\Model\Product\ProductPush;

/**
 * Class Product
 * @package CL\Grid\Model
 */
class Product implements ProductInterface
{
    /** @var Data */
    private $helper;

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var Data
     */
    protected $data;

    /**
     * @var Grid
     */
    protected $product;

    /**
     * @var \Magento\Framework\App\RequestInterface
     */
    protected $request;

    /**
     * @var ProductPush
     */
    private $productPush;

    /**
     * Product constructor.
     * @param Data $helper
     * @param StoreManagerInterface $storeManager
     * @param Grid $product
     * @param \Magento\Framework\App\RequestInterface $request
     * @param Data $data
     */
    public function __construct(
        Data $helper,
        StoreManagerInterface $storeManager,
        \CL\Grid\Model\Grid $product,
        ProductPush $productPush,
        \Magento\Framework\App\RequestInterface $request,
        Data $data
    ) {
        $this->helper = $helper;
        $this->storeManager = $storeManager;
        $this->product = $product;
        $this->productPush = $productPush;
        $this->request = $request;
        $this->data = $data;
    }

    /**
     * return Data according to vpn
     *
     * @return array|mixed|string
     */
    public function getProductDataByVPN()
    {
        try {
            $vpn = $this->request->getParam('vpn');
            if (!empty($vpn)) {
                $newsModel = $this->product;
                $newsCollection = $newsModel->getCollection()
                    ->addFieldToFilter('vpn', $vpn)
                    ->getData();
                return $newsCollection;
            } else {
                return ('Please provide vpn number to sellet data');
            }
        } catch (\Exception $e) {
            return($e->getMessage());
        }
    }

    /**
     * Update data according to product_id
     *
     * @return bool|mixed|string
     */
    public function updateProductData()
    {
        try {
            $productId = $this->request->getParam('product_id');
            $data = [];
            if (!empty($productId)) {
                $data['product_id'] = $productId;
                $model = $this->product;
                $newModel = $model->load($productId);
                if (!empty($this->request->getParam('sku'))) {
                    $sku = $this->request->getParam('sku');
                    $data['sku'] = $sku;
                    $newModel->setSku($sku);
                }
                if (!empty($this->request->getParam('copyright'))) {
                    $copyright = $this->request->getParam('copyright');
                    $data['copyright'] = $copyright;
                    $newModel->setCopyright($copyright);
                }
                if (!empty($this->request->getParam('vpn'))) {
                    $vpn = $this->request->getParam('vpn');
                    $data['vpn'] = $vpn;
                    $newModel->setVpn($vpn);
                }
                if ($newModel->save()) {
                    $this->productPush->enqueueProduct($data);
                    return ('Data Updated success');
                } else {
                    return ('Data not updated');
                }
            } else {
                return ('Please provide product_id number to update data');
            }
        } catch (\Exception $e) {
            return($e->getMessage());
        }
    }
}
