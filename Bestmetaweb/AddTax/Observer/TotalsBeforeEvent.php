<?php
namespace Bestmetaweb\AddTax\Observer;

use Magento\Quote\Model\Quote;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Api\Data\ShippingAssignmentInterface;

/**
 * Class TotalsBeforeEvent
 */
class TotalsBeforeEvent implements ObserverInterface
{

    protected $dataHelper;

    public function __construct(
        \Bestmetaweb\AddTax\Helper\Data $dataHelper
    ){
        $this->dataHelper = $dataHelper;
    }
    /**
     * @param Observer $observer
     * @return void
     */
    public function execute( Observer $observer )
    {
        /** Fetch Address related data */
        $shippingAssignment = $observer->getEvent()->getShippingAssignment();
        $address = $shippingAssignment->getShipping()->getAddress();

        // fetch quote data
        /** @var Quote $quote */
        $quote = $observer->getEvent()->getQuote();
        $fee = $quote->getFee();
                    if(isset($fee) && $fee != null ){
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
    }
}