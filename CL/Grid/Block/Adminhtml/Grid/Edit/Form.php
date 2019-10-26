<?php

namespace CL\Grid\Block\Adminhtml\Grid\Edit;

use Magento\Framework\Exception\LocalizedException;

/**
 * Class Form
 * @package CL\Grid\Block\Adminhtml\Grid\Edit
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var
     */
    protected $_systemStore;

    /**
     * Form constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form.
     *
     * @return $this
     * @throws LocalizedException
     */
    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('row_data');
        $form = $this->_formFactory->create(
            ['data' => [
                            'id' => 'edit_form',
                            'enctype' => 'multipart/form-data',
                            'action' => $this->getData('action'),
                            'method' => 'post'
                        ]
            ]
        );

        $form->setHtmlIdPrefix('clgrid_');
        if ($model->getProductId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Edit Product Data'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('product_id', 'hidden', ['name' => 'product_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('Add Product Data'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'sku',
            'text',
            [
                'name' => 'sku',
                'label' => __('SKU'),
                'id' => 'sku',
                'title' => __('SKU'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'vpn',
            'text',
            [
                'name' => 'vpn',
                'label' => __('VPN'),
                'id' => 'sku',
                'title' => __('VPN'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );
        $fieldset->addField(
            'copyright',
            'textarea',
            [
                'name' => 'copyright',
                'label' => __('Copyright'),
                'id' => 'copyright',
                'title' => __('Copyright'),
                'required' => false,
            ]
        );
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
