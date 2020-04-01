<?php

namespace Bestmetaweb\AddTax\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    /**
     * Custom fee config path
     */
    const CONFIG_CUSTOM_IS_ENABLED = 'customfee/customfee/status';
    const CONFIG_CUSTOM_FEE = 'customfee/customfee/customfee_amount';
    const CONFIG_FEE_LABEL = 'customfee/customfee/name';
    const CONFIG_CHECKBOX_TITLE = 'customfee/customfee/checkbox_title';
    const CONFIG_CHECKBOX_DESC = 'customfee/customfee/checkbox_description';
    const CONFIG_CHECKBOX_TYPETAX = 'customfee/customfee/list_typefee';
    const CONFIG_MINIMUM_ORDER_AMOUNT = 'customfee/customfee/minimum_order_amount';

    /**
     * @return mixed
     */
    public function isModuleEnabled()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $isEnabled = $this->scopeConfig->getValue(self::CONFIG_CUSTOM_IS_ENABLED, $storeScope);
        return $isEnabled;
    }

    /**
     * Get custom fee
     *
     * @return mixed
     */
    public function getCustomFee()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $fee = $this->scopeConfig->getValue(self::CONFIG_CUSTOM_FEE, $storeScope);
        return $fee;
    }

    /**
     * Get custom fee
     *
     * @return mixed
     */
    public function getFeeLabel()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $feeLabel = $this->scopeConfig->getValue(self::CONFIG_FEE_LABEL, $storeScope);
        return $feeLabel;
    }

    /**
     * Get checkbox title
     *
     * @return mixed
     */
    public function getCheckboxTitle()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $checkboxTitle = $this->scopeConfig->getValue(self::CONFIG_CHECKBOX_TITLE, $storeScope);
        return $checkboxTitle;
    }

    /**
     * Get checkbox description
     *
     * @return mixed
     */
    public function getCheckboxDescription()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $checkboxTitle = $this->scopeConfig->getValue(self::CONFIG_CHECKBOX_DESC, $storeScope);
        return $checkboxTitle;
    }

    /**
     * Get checkbox type of tax
     *
     * @return mixed
     */
    public function getTypeoftax()
    {
        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $typeoftax = $this->scopeConfig->getValue(self::CONFIG_CHECKBOX_TYPETAX, $storeScope);
        return $typeoftax;
    }

    /**
     * @return mixed
     */
    public function getMinimumOrderAmount()
    {

        $storeScope = \Magento\Store\Model\ScopeInterface::SCOPE_STORE;
        $MinimumOrderAmount = $this->scopeConfig->getValue(self::CONFIG_MINIMUM_ORDER_AMOUNT, $storeScope);
        return $MinimumOrderAmount;
    }
}
