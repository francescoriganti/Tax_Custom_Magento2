<?php
namespace Bestmetaweb\AddTax\Plugin\Checkout\Model;


class ShippingInformationManagement
{
    /**
     * @var \Magento\Quote\Model\QuoteRepository
     */
    protected $quoteRepository;

    /**
     * @var \Bestmetaweb\AddTax\Helper\Data
     */
    protected $dataHelper;

    /**
     * @param \Magento\Quote\Model\QuoteRepository $quoteRepository
     * @param \Bestmetaweb\AddTax\Helper\Data $dataHelper
     */
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Bestmetaweb\AddTax\Helper\Data $dataHelper
    )
    {
        $this->quoteRepository = $quoteRepository;
        $this->dataHelper = $dataHelper;
    }

    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $customFee = $addressInformation->getExtensionAttributes()->getFee();
        $quote = $this->quoteRepository->getActive($cartId);
        if(isset($customFee)){
            if ($customFee) {
                if($quote->getFee() == null){
                    $amountTax = $this->dataHelper->getCustomFee();
                    $subtotal = $quote->getSubtotal();
                    if($this->dataHelper->getTypeoftax() == 'percentage' ){
                        $fee =  $subtotal * $amountTax / 100;
                    } else {
                        $fee =  $amountTax;
                    }

                    $quote->setFee($fee);
                    $quote->setBaseFee($fee);
                }
            } else {
                $quote->setFee(NULL);
            }
        }

    }
}

