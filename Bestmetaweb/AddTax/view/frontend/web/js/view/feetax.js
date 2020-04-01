define([
        'ko',
        'jquery',
        'uiComponent',
        'underscore',
        'mage/storage',
        'Magento_Ui/js/form/element/single-checkbox',
        'Magento_Checkout/js/model/quote',
        'Magento_Checkout/js/model/resource-url-manager',
        'Magento_Checkout/js/model/full-screen-loader',
        'Magento_Checkout/js/model/error-processor'
    ],
    function (
        ko,
        $,
        Component,
        _,
        storage,
        AbstractField,
        quote,
        urlManager,
        fullScreenLoader,
        errorProcessor,

    ) {
        'use strict';

        return AbstractField.extend({
            defaults: {
                template: 'ui/form/components/single/field',
                checked: false,
                multiple: false,
                prefer: 'checkbox',
                valueMap: {},
                templates: {
                    checkbox: 'ui/form/components/single/checkbox'
                },
                listens: {
                    'checked': 'onCheckedChanged',
                }


            },

            onCheckedChanged: function () {
                this._super();

                var payload;
                if (!quote.billingAddress()) {
                    selectBillingAddressAction(quote.shippingAddress());
                }
                payload = {
                    addressInformation: {
                        shipping_address: quote.shippingAddress(),
                        billing_address: quote.billingAddress(),
                        shipping_method_code: quote.shippingMethod().method_code,
                        shipping_carrier_code: quote.shippingMethod().carrier_code,
                        extension_attributes:{
                            fee: jQuery('[name="custom_checkbox"]').prop("checked")
                        }
                    }
                };
                fullScreenLoader.startLoader();
                return storage.post(
                    urlManager.getUrlForSetShippingInformation(quote),
                    JSON.stringify(payload)

                ).done(
                    function (response) {
                        var deferred = $.Deferred();
                        quote.setTotals(response.totals);
                        fullScreenLoader.stopLoader();
                    }
                ).fail(
                    function (response) {
                        errorProcessor.process(response);
                        fullScreenLoader.stopLoader();
                    }
                );
            }
        });
    }
);