<?php

namespace Tests\YooKassa\Model\PaymentData;

use YooKassa\Helpers\Random;
use YooKassa\Model\PaymentData\PaymentDataApplePay;

abstract class AbstractPaymentDataApplePayTest extends AbstractPaymentDataTest
{
    /**
     * @dataProvider validPaymentDataDataProvider
     * @param $value
     */
    public function testGetSetPaymentData($value)
    {
        /** @var PaymentDataApplePay $instance */
        $instance = $this->getTestInstance();

        self::assertNull($instance->getPaymentData());
        self::assertNull($instance->paymentData);
        self::assertNull($instance->payment_data);

        $instance->setPaymentData($value);
        if ($value === null || $value === '') {
            self::assertNull($instance->getPaymentData());
            self::assertNull($instance->paymentData);
            self::assertNull($instance->payment_data);
        } else {
            self::assertEquals($value, $instance->getPaymentData());
            self::assertEquals($value, $instance->paymentData);
            self::assertEquals($value, $instance->payment_data);
        }

        $instance = $this->getTestInstance();
        $instance->paymentData = $value;
        if ($value === null || $value === '') {
            self::assertNull($instance->getPaymentData());
            self::assertNull($instance->paymentData);
            self::assertNull($instance->payment_data);
        } else {
            self::assertEquals($value, $instance->getPaymentData());
            self::assertEquals($value, $instance->paymentData);
            self::assertEquals($value, $instance->payment_data);
        }

        $instance = $this->getTestInstance();
        $instance->payment_data = $value;
        if ($value === null || $value === '') {
            self::assertNull($instance->getPaymentData());
            self::assertNull($instance->paymentData);
            self::assertNull($instance->payment_data);
        } else {
            self::assertEquals($value, $instance->getPaymentData());
            self::assertEquals($value, $instance->paymentData);
            self::assertEquals($value, $instance->payment_data);
        }
    }

    /**
     * @dataProvider invalidPaymentDataDataProvider
     *
	 * @param $value
     */
    public function testSetInvalidPaymentData($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		/** @var PaymentDataApplePay $instance */
        $instance = $this->getTestInstance();
        $instance->setPaymentData($value);
    }

    /**
     * @dataProvider invalidPaymentDataDataProvider
     *
	 * @param $value
     */
    public function testSetterInvalidPaymentData($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		/** @var PaymentDataApplePay $instance */
        $instance = $this->getTestInstance();
        $instance->paymentData = $value;
    }

    /**
     * @dataProvider invalidPaymentDataDataProvider
     *
	 * @param $value
     */
    public function testSetterInvalidPayment_data($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		/** @var PaymentDataApplePay $instance */
        $instance = $this->getTestInstance();
        $instance->payment_data = $value;
    }

    public function validPaymentDataDataProvider()
    {
        return array(
            array('https://test.ru'),
            array(Random::str(256)),
            array(Random::str(1024)),
        );
    }

    public function invalidPaymentDataDataProvider()
    {
        return array(
            array(null),
            array(''),
            array(true),
            array(false),
            array(array()),
            array(new \stdClass()),
        );
    }
}
