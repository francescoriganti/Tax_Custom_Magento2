<?php

namespace Bestmetaweb\AddTax\Model\Config\Source;

class ListTypefee implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 'percentage', 'label' => __('Percentage')],
            ['value' => 'fix', 'label' => __('Fixed Fee')]
        ];
    }
}