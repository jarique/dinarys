define([
    'uiComponent',
    'mage/storage',
    'mage/url'
], function (uiComponent, storage, urlBuilder) {
    return uiComponent.extend({
        defaults: {
            template: "Test_CustomerVouchers/voucher"
        },
        initialize: function () {
            var self = this;
            this._super();
            this.observe(['voucher_list']);

            setInterval(function () {
                storage.get(
                    urlBuilder.build('rest/V1/customer-vouchers/customer-vouchers'),
                    true,
                    'application/json').success(function (result) {
                    self.voucher_list(result);
                })
            }, 10000)
        }
    });
});
