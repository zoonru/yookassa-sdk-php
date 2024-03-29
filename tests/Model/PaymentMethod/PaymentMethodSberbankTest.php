<?php

namespace Tests\YooKassa\Model\PaymentMethod;

use YooKassa\Model\PaymentMethod\PaymentMethodSberbank;
use YooKassa\Model\PaymentMethodType;

class PaymentMethodSberbankTest extends PaymentMethodBankCardTest
{
    /**
     * @return PaymentMethodSberbank
     */
    protected function getTestInstance()
    {
        return new PaymentMethodSberbank();
    }

    /**
     * @return string
     */
    protected function getExpectedType()
    {
        return PaymentMethodType::SBERBANK;
    }

    /**
     * @dataProvider validPhoneDataProvider
     * @param $value
     */
    public function testGetSetPhone($value)
    {
        $instance = $this->getTestInstance();

        self::assertNull($instance->getPhone());
        self::assertNull($instance->phone);

        $instance->setPhone($value);
        self::assertEquals($value, $instance->getPhone());
        self::assertEquals($value, $instance->phone);

        $instance = $this->getTestInstance();
        $instance->phone = $value;
        self::assertEquals($value, $instance->getPhone());
        self::assertEquals($value, $instance->phone);
    }

    /**
     * @dataProvider invalidPhoneDataProvider
     *
     * @param $value
     */
    public function testSetInvalidPhone($value)
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = $this->getTestInstance();
        $instance->setPhone($value);
    }

    /**
     * @dataProvider invalidPhoneDataProvider
     *
     * @param $value
     */
    public function testSetterInvalidPhone($value)
    {
        $this->expectException(\InvalidArgumentException::class);
        $instance = $this->getTestInstance();
        $instance->phone = $value;
    }

    public function validPhoneDataProvider()
    {
        return array(
            array('0123'),
            array('45678'),
            array('901234'),
            array('5678901'),
            array('23456789'),
            array('012345678'),
            array('9012345678'),
            array('90123456789'),
            array('012345678901'),
            array('5678901234567'),
            array('89012345678901'),
            array('234567890123456'),
        );
    }

    public function invalidPhoneDataProvider()
    {
        return array(
            array(null),
            array(''),
            array(true),
            array(false),
            array(array()),
            array(new \stdClass()),
            array('2345678901234567'),
        );
    }
}
