<?php

/*
 * This file is part of the Predis package.
 *
 * (c) Daniele Alessandri <suppakilla@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Predis\Command;

use \PHPUnit_Framework_TestCase as StandardTestCase;

/**
 * @group commands
 * @group realm-zset
 */
class ZSetScoreTest extends CommandTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getExpectedCommand()
    {
        return 'Predis\Command\ZSetScore';
    }

    /**
     * {@inheritdoc}
     */
    protected function getExpectedId()
    {
        return 'ZSCORE';
    }

    /**
     * @group disconnected
     */
    public function testFilterArguments()
    {
        $arguments = array('key', 'member');
        $expected = array('key', 'member');

        $command = $this->getCommand();
        $command->setArguments($arguments);

        $this->assertSame($expected, $command->getArguments());
    }

    /**
     * @group disconnected
     */
    public function testParseResponse()
    {
        $this->assertSame(1, $this->getCommand()->parseResponse(1));
    }

    /**
     * @group disconnected
     */
    public function testPrefixKeys()
    {
        $arguments = array('key', 'member');
        $expected = array('prefix:key', 'member');

        $command = $this->getCommandWithArgumentsArray($arguments);
        $command->prefixKeys('prefix:');

        $this->assertSame($expected, $command->getArguments());
    }

    /**
     * @group disconnected
     */
    public function testPrefixKeysIgnoredOnEmptyArguments()
    {
        $command = $this->getCommand();
        $command->prefixKeys('prefix:');

        $this->assertSame(array(), $command->getArguments());
    }

    /**
     * @group connected
     */
    public function testReturnsRank()
    {
        $redis = $this->getClient();

        $redis->zadd('letters', -10, 'a', 0, 'b', 10, 'c', 20, 'd', 20, 'e', 30, 'f');

        $this->assertSame('-10', $redis->zscore('letters', 'a'));
        $this->assertSame('0', $redis->zscore('letters', 'b'));
        $this->assertSame('20', $redis->zscore('letters', 'e'));

        $this->assertNull($redis->zscore('unknown', 'a'));
    }

    /**
     * @group connected
     * @expectedException Predis\ServerException
     * @expectedExceptionMessage Operation against a key holding the wrong kind of value
     */
    public function testThrowsExceptionOnWrongType()
    {
        $redis = $this->getClient();

        $redis->set('foo', 'bar');
        $redis->zscore('foo', 'bar');
    }
}
