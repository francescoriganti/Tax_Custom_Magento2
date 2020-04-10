<?php
namespace Bestmetaweb\AddTax\Plugin\Model;
class UpdateCustomFeeForOrderPayPal
{
    /**
     * @var \Magento\Checkout\Model\Session
     */
    protected $_checkoutSession;
    const AMOUNT_SUBTOTAL = 'subtotal';
    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession
    ) {
        $this->_checkoutSession = $checkoutSession;
    }

    public function afterGetAmounts($cart,$result)
    {
        $quote = $this->_checkoutSession->getQuote();
        $paymentMethod = $quote->getPayment()->getMethod();
        $paypalMehodList = ['payflowpro','payflow_link','payflow_advanced','braintree_paypal','paypal_express_bml','payflow_express_bml','payflow_express','paypal_express'];

        // to check the paypal payment method
        if(in_array($paymentMethod,$paypalMehodList)){
            $result[self::AMOUNT_SUBTOTAL] = $result[self::AMOUNT_SUBTOTAL] + $quote->getFee();

        }

        return $result;
    }
}
