<?php

namespace Tests\YooKassa\Request\Payments;

use PHPUnit\Framework\TestCase;
use YooKassa\Helpers\Random;
use YooKassa\Model\ConfirmationAttributes\ConfirmationAttributesExternal;
use YooKassa\Model\ConfirmationType;
use YooKassa\Model\CurrencyCode;
use YooKassa\Model\Deal\PaymentDealInfo;
use YooKassa\Model\Locale;
use YooKassa\Model\Metadata;
use YooKassa\Model\MonetaryAmount;
use YooKassa\Model\Payment;
use YooKassa\Model\PaymentData\PaymentDataQiwi;
use YooKassa\Model\Receipt;
use YooKassa\Model\ReceiptItem;
use YooKassa\Model\Recipient;
use YooKassa\Model\Transfer;
use YooKassa\Model\TransferStatus;
use YooKassa\Request\Payments\CreatePaymentRequest;
use YooKassa\Request\Payments\CreatePaymentRequestBuilder;

class CreatePaymentRequestTest extends TestCase
{
    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testRecipient($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasRecipient());
        self::assertNull($instance->getRecipient());
        self::assertNull($instance->recipient);

        $instance->setRecipient($options['recipient']);
        if (empty($options['recipient'])) {
            self::assertFalse($instance->hasRecipient());
            self::assertNull($instance->getRecipient());
            self::assertNull($instance->recipient);
        } else {
            self::assertTrue($instance->hasRecipient());
            self::assertSame($options['recipient'], $instance->getRecipient());
            self::assertSame($options['recipient'], $instance->recipient);
        }

        $instance->setRecipient(null);
        self::assertFalse($instance->hasRecipient());
        self::assertNull($instance->getRecipient());
        self::assertNull($instance->recipient);

        $instance->recipient = $options['recipient'];
        if (empty($options['recipient'])) {
            self::assertFalse($instance->hasRecipient());
            self::assertNull($instance->getRecipient());
            self::assertNull($instance->recipient);
        } else {
            self::assertTrue($instance->hasRecipient());
            self::assertSame($options['recipient'], $instance->getRecipient());
            self::assertSame($options['recipient'], $instance->recipient);
        }
    }

    /**
     * @dataProvider invalidRecipientDataProvider
     * @param $value
     */
    public function testSetInvalidRecipient($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setRecipient($value);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testAmount($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertNull($instance->getAmount());
        self::assertNull($instance->amount);

        $instance->setAmount($options['amount']);

        self::assertSame($options['amount'], $instance->getAmount());
        self::assertSame($options['amount'], $instance->amount);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testPaymentToken($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasPaymentToken());
        self::assertNull($instance->getPaymentToken());
        self::assertNull($instance->paymentToken);

        $instance->setPaymentToken($options['paymentToken']);
        if (empty($options['paymentToken'])) {
            self::assertFalse($instance->hasPaymentToken());
            self::assertNull($instance->getPaymentToken());
            self::assertNull($instance->paymentToken);
            self::assertNull($instance->payment_token);
        } else {
            self::assertTrue($instance->hasPaymentToken());
            self::assertSame($options['paymentToken'], $instance->getPaymentToken());
            self::assertSame($options['paymentToken'], $instance->paymentToken);
            self::assertSame($options['paymentToken'], $instance->payment_token);
        }

        $instance->setPaymentToken(null);
        self::assertFalse($instance->hasPaymentToken());
        self::assertNull($instance->getPaymentToken());
        self::assertNull($instance->paymentToken);

        $instance->paymentToken = $options['paymentToken'];
        if (empty($options['paymentToken'])) {
            self::assertFalse($instance->hasPaymentToken());
            self::assertNull($instance->getPaymentToken());
            self::assertNull($instance->paymentToken);
            self::assertNull($instance->payment_token);
        } else {
            self::assertTrue($instance->hasPaymentToken());
            self::assertSame($options['paymentToken'], $instance->getPaymentToken());
            self::assertSame($options['paymentToken'], $instance->paymentToken);
            self::assertSame($options['paymentToken'], $instance->payment_token);
        }

        $instance->paymentToken = null;
        self::assertFalse($instance->hasPaymentToken());
        self::assertNull($instance->getPaymentToken());
        self::assertNull($instance->paymentToken);

        $instance->payment_token = $options['paymentToken'];
        if (empty($options['paymentToken'])) {
            self::assertFalse($instance->hasPaymentToken());
            self::assertNull($instance->getPaymentToken());
            self::assertNull($instance->paymentToken);
            self::assertNull($instance->payment_token);
        } else {
            self::assertTrue($instance->hasPaymentToken());
            self::assertSame($options['paymentToken'], $instance->getPaymentToken());
            self::assertSame($options['paymentToken'], $instance->paymentToken);
            self::assertSame($options['paymentToken'], $instance->payment_token);
        }
    }

    /**
     * @dataProvider invalidPaymentTokenDataProvider
     * @param $value
     */
    public function testSetInvalidPaymentToken($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setPaymentToken($value);
    }

    /**
     * @dataProvider invalidPaymentTokenDataProvider
     * @param $value
     */
    public function testSetterInvalidPaymentToken($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->paymentToken = $value;
    }

    /**
     * @dataProvider invalidPaymentTokenDataProvider
     * @param $value
     */
    public function testSetterInvalidPayment_token($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->payment_token = $value;
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testPaymentMethodId($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasPaymentMethodId());
        self::assertNull($instance->getPaymentMethodId());
        self::assertNull($instance->paymentMethodId);
        self::assertNull($instance->payment_method_id);

        $instance->setPaymentMethodId($options['paymentMethodId']);
        if (empty($options['paymentMethodId'])) {
            self::assertFalse($instance->hasPaymentMethodId());
            self::assertNull($instance->getPaymentMethodId());
            self::assertNull($instance->paymentMethodId);
            self::assertNull($instance->payment_method_id);
        } else {
            self::assertTrue($instance->hasPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->getPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->paymentMethodId);
            self::assertSame($options['paymentMethodId'], $instance->payment_method_id);
        }

        $instance->setPaymentMethodId(null);
        self::assertFalse($instance->hasPaymentMethodId());
        self::assertNull($instance->getPaymentMethodId());
        self::assertNull($instance->paymentMethodId);

        $instance->paymentMethodId = $options['paymentMethodId'];
        if (empty($options['paymentMethodId'])) {
            self::assertFalse($instance->hasPaymentMethodId());
            self::assertNull($instance->getPaymentMethodId());
            self::assertNull($instance->paymentMethodId);
            self::assertNull($instance->payment_method_id);
        } else {
            self::assertTrue($instance->hasPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->getPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->paymentMethodId);
            self::assertSame($options['paymentMethodId'], $instance->payment_method_id);
        }

        $instance->setPaymentMethodId(null);
        self::assertFalse($instance->hasPaymentMethodId());
        self::assertNull($instance->getPaymentMethodId());
        self::assertNull($instance->paymentMethodId);

        $instance->payment_method_id = $options['paymentMethodId'];
        if (empty($options['paymentMethodId'])) {
            self::assertFalse($instance->hasPaymentMethodId());
            self::assertNull($instance->getPaymentMethodId());
            self::assertNull($instance->paymentMethodId);
            self::assertNull($instance->payment_method_id);
        } else {
            self::assertTrue($instance->hasPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->getPaymentMethodId());
            self::assertSame($options['paymentMethodId'], $instance->paymentMethodId);
            self::assertSame($options['paymentMethodId'], $instance->payment_method_id);
        }
    }

    /**
     * @dataProvider invalidPaymentMethodIdDataProvider
     * @param $value
     */
    public function testSetInvalidPaymentMethodId($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setPaymentMethodId($value);
    }

    /**
     * @dataProvider invalidPaymentMethodIdDataProvider
     * @param $value
     */
    public function testSetterInvalidPaymentMethodId($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->paymentMethodId = $value;
    }

    /**
     * @dataProvider invalidPaymentMethodIdDataProvider
     * @param $value
     */
    public function testSetterInvalidPayment_method_id($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->payment_method_id = $value;
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testPaymentData($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasPaymentMethodData());
        self::assertNull($instance->getPaymentMethodData());
        self::assertNull($instance->paymentMethodData);

        $instance->setPaymentMethodData($options['paymentMethodData']);
        if (empty($options['paymentMethodData'])) {
            self::assertFalse($instance->hasPaymentMethodData());
            self::assertNull($instance->getPaymentMethodData());
            self::assertNull($instance->paymentMethodData);
        } else {
            self::assertTrue($instance->hasPaymentMethodData());
            self::assertSame($options['paymentMethodData'], $instance->getPaymentMethodData());
            self::assertSame($options['paymentMethodData'], $instance->paymentMethodData);
        }

        $instance->setPaymentMethodData(null);
        self::assertFalse($instance->hasPaymentMethodData());
        self::assertNull($instance->getPaymentMethodData());
        self::assertNull($instance->paymentMethodData);

        $instance->paymentMethodData = $options['paymentMethodData'];
        if (empty($options['paymentMethodData'])) {
            self::assertFalse($instance->hasPaymentMethodData());
            self::assertNull($instance->getPaymentMethodData());
            self::assertNull($instance->paymentMethodData);
        } else {
            self::assertTrue($instance->hasPaymentMethodData());
            self::assertSame($options['paymentMethodData'], $instance->getPaymentMethodData());
            self::assertSame($options['paymentMethodData'], $instance->paymentMethodData);
        }
    }

    /**
     * @dataProvider invalidPaymentDataDataProvider
     * @param $value
     */
    public function testSetInvalidPaymentData($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setPaymentMethodData($value);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testConfirmationAttributes($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasConfirmation());
        self::assertNull($instance->getConfirmation());
        self::assertNull($instance->confirmation);

        $instance->setConfirmation($options['confirmation']);
        if (empty($options['confirmation'])) {
            self::assertFalse($instance->hasConfirmation());
            self::assertNull($instance->getConfirmation());
            self::assertNull($instance->confirmation);
        } else {
            self::assertTrue($instance->hasConfirmation());
            if (is_array($options['confirmation'])) {
                self::assertSame($options['confirmation'], $instance->getConfirmation()->toArray());
                self::assertSame($options['confirmation'], $instance->confirmation->toArray());
            } else {
                self::assertSame($options['confirmation'], $instance->getConfirmation());
                self::assertSame($options['confirmation'], $instance->confirmation);
            }
        }

        $instance->setConfirmation(null);
        self::assertFalse($instance->hasConfirmation());
        self::assertNull($instance->getConfirmation());
        self::assertNull($instance->confirmation);

        $instance->confirmation = $options['confirmation'];
        if (empty($options['confirmation'])) {
            self::assertFalse($instance->hasConfirmation());
            self::assertNull($instance->getConfirmation());
            self::assertNull($instance->confirmation);
        } else {
            self::assertTrue($instance->hasConfirmation());
            if (is_array($options['confirmation'])) {
                self::assertSame($options['confirmation'], $instance->getConfirmation()->toArray());
                self::assertSame($options['confirmation'], $instance->confirmation->toArray());
            } else {
                self::assertSame($options['confirmation'], $instance->getConfirmation());
                self::assertSame($options['confirmation'], $instance->confirmation);
            }
        }
    }

    /**
     * @dataProvider invalidConfirmationAttributesDataProvider
     * @param $value
     */
    public function testSetInvalidConfirmationAttributes($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setConfirmation($value);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testCreateRecurring($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasSavePaymentMethod());
        self::assertNull($instance->getSavePaymentMethod());
        self::assertNull($instance->savePaymentMethod);

        $instance->setSavePaymentMethod($options['savePaymentMethod']);
        if ($options['savePaymentMethod'] === null || $options['savePaymentMethod'] === '') {
            self::assertFalse($instance->hasSavePaymentMethod());
            self::assertNull($instance->getSavePaymentMethod());
            self::assertNull($instance->savePaymentMethod);
        } else {
            self::assertTrue($instance->hasSavePaymentMethod());
            self::assertSame($options['savePaymentMethod'], $instance->getSavePaymentMethod());
            self::assertSame($options['savePaymentMethod'], $instance->savePaymentMethod);
        }

        $instance->setSavePaymentMethod(null);
        self::assertFalse($instance->hasSavePaymentMethod());
        self::assertNull($instance->getSavePaymentMethod());
        self::assertNull($instance->savePaymentMethod);

        $instance->savePaymentMethod = $options['savePaymentMethod'];
        if ($options['savePaymentMethod'] === null || $options['savePaymentMethod'] === '') {
            self::assertFalse($instance->hasSavePaymentMethod());
            self::assertNull($instance->getSavePaymentMethod());
            self::assertNull($instance->savePaymentMethod);
        } else {
            self::assertTrue($instance->hasSavePaymentMethod());
            self::assertSame($options['savePaymentMethod'], $instance->getSavePaymentMethod());
            self::assertSame($options['savePaymentMethod'], $instance->savePaymentMethod);
        }
    }

    /**
     * @dataProvider invalidBooleanDataProvider
     * @param $value
     */
    public function testSetInvalidCreateRecurring($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setSavePaymentMethod($value);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testCapture($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasCapture());
        self::assertNull($instance->getCapture());
        self::assertNull($instance->capture);

        $instance->setCapture($options['capture']);
        if ($options['capture'] === null || $options['capture'] === '') {
            self::assertFalse($instance->hasCapture());
            self::assertNull($instance->getCapture());
            self::assertNull($instance->capture);
        } else {
            self::assertTrue($instance->hasCapture());
            self::assertSame($options['capture'], $instance->getCapture());
            self::assertSame($options['capture'], $instance->capture);
        }

        $instance->setCapture(null);
        self::assertFalse($instance->hasCapture());
        self::assertNull($instance->getCapture());
        self::assertNull($instance->capture);

        $instance->capture = $options['capture'];
        if ($options['capture'] === null || $options['capture'] === '') {
            self::assertFalse($instance->hasCapture());
            self::assertNull($instance->getCapture());
            self::assertNull($instance->capture);
        } else {
            self::assertTrue($instance->hasCapture());
            self::assertSame($options['capture'], $instance->getCapture());
            self::assertSame($options['capture'], $instance->capture);
        }
    }

    /**
     * @dataProvider invalidBooleanDataProvider
     * @param $value
     */
    public function testSetInvalidCapture($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setCapture($value);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testClientIp($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasClientIp());
        self::assertNull($instance->getClientIp());
        self::assertNull($instance->clientIp);

        $instance->setClientIp($options['clientIp']);
        if (empty($options['clientIp'])) {
            self::assertFalse($instance->hasClientIp());
            self::assertNull($instance->getClientIp());
            self::assertNull($instance->clientIp);
        } else {
            self::assertTrue($instance->hasClientIp());
            self::assertSame($options['clientIp'], $instance->getClientIp());
            self::assertSame($options['clientIp'], $instance->clientIp);
        }

        $instance->setClientIp(null);
        self::assertFalse($instance->hasClientIp());
        self::assertNull($instance->getClientIp());
        self::assertNull($instance->clientIp);

        $instance->clientIp = $options['clientIp'];
        if (empty($options['clientIp'])) {
            self::assertFalse($instance->hasClientIp());
            self::assertNull($instance->getClientIp());
            self::assertNull($instance->clientIp);
        } else {
            self::assertTrue($instance->hasClientIp());
            self::assertSame($options['clientIp'], $instance->getClientIp());
            self::assertSame($options['clientIp'], $instance->clientIp);
        }
    }

    /**
     * @dataProvider invalidClientIpDataProvider
     * @param $value
     */
    public function testSetInvalidClientIp($value)
    {
		$this->expectException('\InvalidArgumentException');
        $instance = new CreatePaymentRequest();
        $instance->setClientIp($value);
    }

    public function invalidClientIpDataProvider()
    {
        return array(
            array(array()),
            array(new \stdClass()),
            array(true),
            array(false),
        );
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testMerchantCustomerId($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasMerchantCustomerId());
        self::assertNull($instance->getMerchantCustomerId());
        self::assertNull($instance->merchantCustomerId);
        self::assertNull($instance->merchant_customer_id);

        $instance->setMerchantCustomerId($options['merchant_customer_id']);
        if (empty($options['merchant_customer_id'])) {
            self::assertFalse($instance->hasMerchantCustomerId());
            self::assertNull($instance->getMerchantCustomerId());
            self::assertNull($instance->merchantCustomerId);
            self::assertNull($instance->merchant_customer_id);
        } else {
            self::assertTrue($instance->hasMerchantCustomerId());
            self::assertSame($options['merchant_customer_id'], $instance->getMerchantCustomerId());
            self::assertSame($options['merchant_customer_id'], $instance->merchantCustomerId);
            self::assertSame($options['merchant_customer_id'], $instance->merchant_customer_id);
        }

        $instance->setMerchantCustomerId(null);
        self::assertFalse($instance->hasMerchantCustomerId());
        self::assertNull($instance->getMerchantCustomerId());
        self::assertNull($instance->merchantCustomerId);
        self::assertNull($instance->merchant_customer_id);

        $instance->merchant_customer_id = $options['merchant_customer_id'];
        if (empty($options['merchant_customer_id'])) {
            self::assertFalse($instance->hasMerchantCustomerId());
            self::assertNull($instance->getMerchantCustomerId());
            self::assertNull($instance->merchantCustomerId);
            self::assertNull($instance->merchant_customer_id);
        } else {
            self::assertTrue($instance->hasMerchantCustomerId());
            self::assertSame($options['merchant_customer_id'], $instance->getMerchantCustomerId());
            self::assertSame($options['merchant_customer_id'], $instance->merchantCustomerId);
            self::assertSame($options['merchant_customer_id'], $instance->merchant_customer_id);
        }
    }

    /**
     * @dataProvider invalidMerchantCustomerIdDataProvider
     *
	 * @param $value
     */
    public function testSetInvalidMerchantCustomerId($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		$instance = new CreatePaymentRequest();
        $instance->setMerchantCustomerId($value);
    }

    public function invalidMerchantCustomerIdDataProvider()
    {
        return array(
            array(array()),
            array(new \stdClass()),
            array(true),
            array(false),
            array(Random::str(Payment::MAX_LENGTH_MERCHANT_CUSTOMER_ID + 1)),
        );
    }

    /**
     * @dataProvider validTransfers
     * @param $value
     */
    public function testSetTransfer($value)
    {
        $instance = new CreatePaymentRequest();
        $instance->setTransfers($value);
        if (is_array($value)) {
            $value = array(new Transfer($value[0]));
        }
        self::assertEquals($value, $instance->getTransfers());
    }

    /**
     * @return array[]
     * @throws \Exception
     */
    public function validTransfers()
    {
        $metadata = new Metadata();
        $metadata->test = 'test';
        $transfers = array();
        for($i = 0; $i < 10; $i++) {
            $transfers[$i][] = array(
                'account_id' => (string)Random::int(11111111, 99999999),
                'amount' => array(
                    'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                    'currency' => Random::value(CurrencyCode::getValidValues())
                ),
                'status' => Random::value(TransferStatus::getValidValues()),
                'platform_fee_amount' => array(
                    'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                    'currency' => Random::value(CurrencyCode::getValidValues())
                ),
                'description' => Random::str(1, Transfer::MAX_LENGTH_DESCRIPTION),
                'metadata' => $i == 0 ? $metadata : array('test' => 'test'),
            );
        }
        $transfers[$i][] = array(new Transfer($transfers[0]));

        return array($transfers);
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testMetadata($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasMetadata());
        self::assertNull($instance->getMetadata());
        self::assertNull($instance->metadata);

        $expected = $options['metadata'];
        if ($expected instanceof Metadata) {
            $expected = $expected->toArray();
        }

        $instance->setMetadata($options['metadata']);
        if (empty($options['metadata'])) {
            self::assertFalse($instance->hasMetadata());
            self::assertNull($instance->getMetadata());
            self::assertNull($instance->metadata);
        } else {
            self::assertTrue($instance->hasMetadata());
            self::assertSame($expected, $instance->getMetadata()->toArray());
            self::assertSame($expected, $instance->metadata->toArray());
        }

        $instance->setMetadata(null);
        self::assertFalse($instance->hasMetadata());
        self::assertNull($instance->getMetadata());
        self::assertNull($instance->metadata);

        $instance->metadata = $options['metadata'];
        if (empty($options['metadata'])) {
            self::assertFalse($instance->hasMetadata());
            self::assertNull($instance->getMetadata());
            self::assertNull($instance->metadata);
        } else {
            self::assertTrue($instance->hasMetadata());
            self::assertSame($expected, $instance->getMetadata()->toArray());
            self::assertSame($expected, $instance->metadata->toArray());
        }
    }

    /**
     * @dataProvider validDataProvider
     * @param $options
     */
    public function testDeal($options)
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->hasDeal());
        self::assertNull($instance->getDeal());
        self::assertNull($instance->deal);

        $expected = $options['deal'];
        if ($expected instanceof PaymentDealInfo) {
            $expected = $expected->toArray();
        }

        $instance->setDeal($options['deal']);
        if (empty($options['deal'])) {
            self::assertFalse($instance->hasDeal());
            self::assertNull($instance->getDeal());
            self::assertNull($instance->deal);
        } else {
            self::assertTrue($instance->hasDeal());
            self::assertSame($expected, $instance->getDeal()->toArray());
            self::assertSame($expected, $instance->deal->toArray());
        }

        $instance->setDeal(null);
        self::assertFalse($instance->hasDeal());
        self::assertNull($instance->getDeal());
        self::assertNull($instance->deal);

        $instance->deal = $options['deal'];
        if (empty($options['deal'])) {
            self::assertFalse($instance->hasDeal());
            self::assertNull($instance->getDeal());
            self::assertNull($instance->deal);
        } else {
            self::assertTrue($instance->hasDeal());
            self::assertSame($expected, $instance->getDeal()->toArray());
            self::assertSame($expected, $instance->deal->toArray());
        }
    }

    public function testValidate()
    {
        $instance = new CreatePaymentRequest();

        self::assertFalse($instance->validate());

        $amount = new MonetaryAmount();
        $instance->setAmount($amount);
        self::assertFalse($instance->validate());

        $instance->setAmount(new MonetaryAmount(10));
        self::assertTrue($instance->validate());

        $instance->setPaymentToken(Random::str(10));
        self::assertTrue($instance->validate());
        $instance->setPaymentMethodId(Random::str(10));
        self::assertFalse($instance->validate());
        $instance->setPaymentMethodId(null);
        self::assertTrue($instance->validate());
        $instance->setPaymentMethodData(new PaymentDataQiwi());
        self::assertFalse($instance->validate());
        $instance->setPaymentToken(null);
        self::assertTrue($instance->validate());
        $instance->setPaymentMethodId(Random::str(10));
        self::assertFalse($instance->validate());
        $instance->setPaymentMethodId(null);
        self::assertTrue($instance->validate());

        $receipt = new Receipt();
        $instance->setReceipt($receipt);
        $item = new ReceiptItem();
        $item->setPrice(new MonetaryAmount(10));
        $item->setDescription('test');
        $receipt->addItem($item);
        self::assertFalse($instance->validate());
        $receipt->getCustomer()->setPhone('123123');
        self::assertTrue($instance->validate());
        $item->setVatCode(3);
        self::assertTrue($instance->validate());
        $receipt->setTaxSystemCode(4);
        self::assertTrue($instance->validate());

        self::assertNotNull($instance->getReceipt());
        $instance->removeReceipt();
        self::assertTrue($instance->validate());
        self::assertNull($instance->getReceipt());

        $instance->setAmount(new MonetaryAmount());
        self::assertFalse($instance->validate());
    }

    public function testBuilder()
    {
        $builder = CreatePaymentRequest::builder();
        self::assertTrue($builder instanceof CreatePaymentRequestBuilder);
    }

    /**
     * @dataProvider invalidMetadataDataProvider
     *
	 * @param $value
     */
    public function testSetInvalidMetadata($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		$instance = new CreatePaymentRequest();
        $instance->setMetadata($value);
    }

    /**
     * @dataProvider invalidMetadataDataProvider
     *
	 * @param $value
     */
    public function testSetInvalidDeal($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		$instance = new CreatePaymentRequest();
        $instance->setDeal($value);
    }

    public function validDataProvider()
    {
        $metadata = new Metadata();
        $metadata->test = 'test';
        $result = array(
            array(
                array(
                    'recipient' => null,
                    'amount' => new MonetaryAmount(Random::int(1, 1000000)),
                    'referenceId' => null,
                    'paymentToken' => null,
                    'paymentMethodId' => null,
                    'paymentMethodData' => null,
                    'confirmation' => null,
                    'savePaymentMethod' => null,
                    'capture' => null,
                    'clientIp' => null,
                    'metadata' => null,
                    'deal' => null,
                    'merchant_customer_id' => null,
                ),
            ),
            array(
                array(
                    'recipient' => null,
                    'amount' => new MonetaryAmount(Random::int(1, 1000000)),
                    'referenceId' => '',
                    'paymentToken' => '',
                    'paymentMethodId' => '',
                    'paymentMethodData' => '',
                    'confirmation' => '',
                    'savePaymentMethod' => '',
                    'capture' => '',
                    'clientIp' => '',
                    'metadata' => array(),
                    'deal' => new PaymentDealInfo(array(
                        'id' => Random::str(36, 50),
                        'settlements' => array()
                    )),
                    'merchant_customer_id' => '',
                ),
            ),
        );
        for ($i = 0; $i < 10; $i++) {
            $request = array(
                'recipient' => new Recipient(),
                'amount' => new MonetaryAmount(Random::int(1, 1000000)),
                'referenceId' => uniqid(),
                'paymentToken' => uniqid(),
                'paymentMethodId' => uniqid(),
                'paymentMethodData' => new PaymentDataQiwi(),
                'confirmation' => new ConfirmationAttributesExternal(),
                'savePaymentMethod' => Random::bool(),
                'capture' => Random::bool(),
                'clientIp' => long2ip(mt_rand(0, pow(2, 32))),
                'metadata' => $i == 0 ? $metadata : array('test' => 'test'),
                'transfers' => array(
                    array(
                        'account_id' => (string)Random::int(11111111, 99999999),
                        'amount' => array(
                            'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                            'currency' => Random::value(CurrencyCode::getValidValues())
                        ),
                        'status' => Random::value(TransferStatus::getValidValues()),
                        'platform_fee_amount' => array(
                            'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                            'currency' => Random::value(CurrencyCode::getValidValues())
                        ),
                        'description' => Random::str(1, Transfer::MAX_LENGTH_DESCRIPTION),
                        'metadata' => $i == 0 ? $metadata : array('test' => 'test'),
                    )
                ),
                'deal' => array(
                    'id' => Random::str(36, 50),
                    'settlements' => array()
                ),
                'merchant_customer_id' => Random::str(36, 50),
            );
            $result[] = array($request);
        }

        $result[] = array(
            array(
                'recipient' => new Recipient(),
                'amount' => new MonetaryAmount(Random::int(1, 1000000)),
                'referenceId' => uniqid(),
                'paymentToken' => uniqid(),
                'paymentMethodId' => uniqid(),
                'paymentMethodData' => new PaymentDataQiwi(),
                'confirmation' => array(
                    'return_url' => Random::str(10),
                    'type' => ConfirmationType::MOBILE_APPLICATION,
                    'locale' => Locale::RUSSIAN,
                ),
                'savePaymentMethod' => Random::bool(),
                'capture' => Random::bool(),
                'clientIp' => long2ip(mt_rand(0, pow(2, 32))),
                'metadata' => $i == 0 ? $metadata : array('test' => 'test'),
                'transfers' => array(
                    array(
                        'account_id' => (string)Random::int(11111111, 99999999),
                        'amount' => array(
                            'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                            'currency' => Random::value(CurrencyCode::getValidValues())
                        ),
                        'status' => Random::value(TransferStatus::getValidValues()),
                        'platform_fee_amount' => array(
                            'value' => sprintf('%.2f', round(Random::float(0.1, 99.99), 2)),
                            'currency' => Random::value(CurrencyCode::getValidValues())
                        ),
                        'description' => Random::str(1, Transfer::MAX_LENGTH_DESCRIPTION),
                        'metadata' => $i == 0 ? $metadata : array('test' => 'test'),
                    )
                ),
                'deal' => array(
                    'id' => Random::str(36, 50),
                    'settlements' => array()
                ),
                'merchant_customer_id' => Random::str(36, 50),
            )
        );

        return $result;
    }

    public function invalidRecipientDataProvider()
    {
        return array(
            array(false),
            array(true),
            array(1),
            array(Random::str(10)),
            array(new \stdClass()),
        );
    }

    public function invalidReferenceIdDataProvider()
    {
        return array(
            array(false),
            array(true),
            array(new \stdClass()),
            array(array()),
            array(Random::str(32)),
        );
    }

    public function invalidPaymentTokenDataProvider()
    {
        return array(
            array(false),
            array(true),
            array(new \stdClass()),
            array(array()),
            array(Random::str(CreatePaymentRequest::MAX_LENGTH_PAYMENT_TOKEN + 1)),
        );
    }

    public function invalidPaymentMethodIdDataProvider()
    {
        return array(
            array(false),
            array(true),
            array(new \stdClass()),
            array(array()),
        );
    }

    public function invalidPaymentDataDataProvider()
    {
        return array(
            array(array()),
            array(false),
            array(true),
            array(1),
            array(Random::str(10)),
            array(new \stdClass()),
        );
    }

    public function invalidConfirmationAttributesDataProvider()
    {
        return array(
            array(array()),
            array(false),
            array(true),
            array(1),
            array(Random::str(10)),
            array(new \stdClass()),
        );
    }

    public function invalidMetadataDataProvider()
    {
        return array(
            array(false),
            array(true),
            array(1),
            array(Random::str(10)),
        );
    }

    public function invalidBooleanDataProvider()
    {
        return array(
            array(array()),
            array(new \stdClass()),
            array('test'),
        );
    }
}