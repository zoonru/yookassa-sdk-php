<?php

namespace Tests\YooKassa\Model\PaymentData;

use YooKassa\Helpers\Random;
use YooKassa\Model\PaymentData\PaymentDataAlfabank;
use YooKassa\Model\PaymentMethodType;

class PaymentDataAlfabankTest extends AbstractPaymentDataTest
{
    /**
     * @return PaymentDataAlfabank
     */
    protected function getTestInstance()
    {
        return new PaymentDataAlfabank();
    }

    /**
     * @return string
     */
    protected function getExpectedType()
    {
        return PaymentMethodType::ALFABANK;
    }

    /**
     * @dataProvider validLoginDataProvider
     * @param $value
     */
    public function testGetSetLogin($value)
    {
        $instance = $this->getTestInstance();

        self::assertNull($instance->getLogin());
        self::assertNull($instance->login);

        $instance->setLogin($value);
        self::assertEquals($value, $instance->getLogin());
        self::assertEquals($value, $instance->login);

        $instance = $this->getTestInstance();
        $instance->login = $value;
        self::assertEquals($value, $instance->getLogin());
        self::assertEquals($value, $instance->login);
    }

    /**
     * @dataProvider invalidLoginDataProvider
     *
	 * @param $value
     */
    public function testSetInvalidLogin($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		$instance = $this->getTestInstance();
        $instance->setLogin($value);
    }

    /**
     * @dataProvider invalidLoginDataProvider
     *
	 * @param $value
     */
    public function testSetterInvalidLogin($value)
    {
		$this->expectException(\InvalidArgumentException::class);
		$instance = $this->getTestInstance();
        $instance->login = $value;
    }

    public function validLoginDataProvider()
    {
        return array(
            array('123'),
            array(Random::str(256)),
            array(Random::str(1024)),
        );
    }

    public function invalidLoginDataProvider()
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