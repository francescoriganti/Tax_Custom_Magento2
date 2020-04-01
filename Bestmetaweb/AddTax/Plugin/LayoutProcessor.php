<?php
namespace Bestmetaweb\AddTax\Plugin;

class LayoutProcessor
{

    protected $helper;
    public function  __construct(
        \Bestmetaweb\Addtax\Helper\Data $helper
    )
    {
        $this->helper = $helper;
    }

    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $processor,
        $jsLayout

    ){
        $enabled = $this->helper->isModuleEnabled();
        $visible = $enabled ?  true : false;

            $checkboxTitle = $this->helper->getCheckboxTitle();
            $checkboxDesc = $this->helper->getCheckboxDescription();
            $jsLayout['components']['checkout']['children']['steps']['children']['billing-step']['children']['feetax'] = [
                'component' => 'Bestmetaweb_AddTax/js/view/feetax',
                'config' => [
                    'customScope' => 'feetax',
                    'template' => 'ui/form/field',
                    'prefer' => 'checkbox'
                ],
                'dataScope' => 'feetax.custom_checkbox',
                'deps' => 'checkout.steps',
                'label' => ''. $checkboxTitle .'',
                'description' => ''. $checkboxDesc .'',
                'provider' => 'checkoutProvider',
                'visible' => ''. $visible .'',
                'sortOrder' => 500,
                'valueMap' => [
                    'true' => true,
                    'false' => false
                ]
            ];


            return $jsLayout;


    }
}