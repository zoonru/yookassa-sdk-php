<?php

namespace Tests\YooKassa\Model\Notification;

use PHPUnit\Framework\TestCase;
use YooKassa\Helpers\Random;
use YooKassa\Model\Notification\AbstractNotification;

abstract class AbstractNotificationTest extends TestCase
{
    /**
     * @param array $source
     * @return AbstractNotification
     */
    abstract protected function getTestInstance(array $source);

    /**
     * @return string
     */
    abstract protected function getExpectedType();

    /**
     * @return string
     */
    abstract protected function getExpectedEvent();

    /**
     * @return array
     */
    abstract public function validDataProvider();

    /**
     * @dataProvider validDataProvider
     * @param array $value
     */
    public function testGetType(array $value)
    {
        $instance = $this->getTestInstance($value);
        self::assertEquals($this->getExpectedType(), $instance->getType());
    }

    /**
     * @dataProvider invalidConstructorTypeDataProvider
     * @param array $source
     */
    public function testInvalidTypeInConstructor(array $source)
    {
        self::expectException(\InvalidArgumentException::class);
        $this->getTestInstance($source);
    }

    /**
     * @dataProvider validDataProvider
     * @param array $value
     */
    public function testGetEvent(array $value)
    {
        $instance = $this->getTestInstance($value);
        self::assertEquals($this->getExpectedEvent(), $instance->getEvent());
    }

    /**
     * @dataProvider invalidConstructorEventDataProvider
     * @param array $source
     */
    public function testInvalidEventInConstructor(array $source)
    {
        self::expectException(\InvalidArgumentException::class);
        $this->getTestInstance($source);
    }

    /**
     * @dataProvider invalidTypeDataProvider
     * @param $value
     */
    public function testInvalidType($value)
    {
        self::expectException(\InvalidArgumentException::class);
        new TestNotification($value, $this->getExpectedEvent());
    }

    /**
     * @dataProvider invalidEventDataProvider
     * @param $value
     */
    public function testInvalidEvent($value)
    {
        self::expectException(\InvalidArgumentException::class);
        new TestNotification($this->getExpectedType(), $value);
    }

    public function invalidConstructorTypeDataProvider()
    {
        return array(
            array(array('event' => $this->getExpectedEvent(), 'type' => 'test')),
            array(array('event' => $this->getExpectedEvent(), 'type' => null)),
            array(array('event' => $this->getExpectedEvent(), 'type' => '')),
            array(array('event' => $this->getExpectedEvent(), 'type' => 1)),
            array(array('event' => $this->getExpectedEvent(), 'type' => array())),
        );
    }

    public function invalidConstructorEventDataProvider()
    {
        return array(
            array(array('type' => $this->getExpectedType(), 'event' => 'test')),
            array(array('type' => $this->getExpectedType(), 'event' => null)),
            array(array('type' => $this->getExpectedType(), 'event' => '')),
            array(array('type' => $this->getExpectedType(), 'event' => 1)),
            array(array('type' => $this->getExpectedType(), 'event' => array())),
        );
    }

    public function invalidTypeDataProvider()
    {
        return array(
            array(''),
            array(null),
            array(Random::str(40)),
            array(0),
            array(array()),
            array(new \stdClass()),
        );
    }

    public function invalidEventDataProvider()
    {
        return array(
            array(''),
            array(null),
            array(Random::str(40)),
            array(0),
            array(array()),
            array(new \stdClass()),
        );
    }
}

class TestNotification extends AbstractNotification
{
    public function __construct($type, $event)
    {
        $this->_setType($type);
        $this->_setEvent($event);
    }
}