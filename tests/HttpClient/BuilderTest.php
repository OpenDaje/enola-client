<?php declare(strict_types=1);

namespace Enola\Tests\HttpClient;

use Enola\HttpClient\Builder;
use Http\Client\Common\Plugin;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Enola\HttpClient\Builder
 */
class BuilderTest extends TestCase
{
    public function testShouldClearHeaders()
    {
        $builder = self::getMockBuilder(Builder::class)
            ->onlyMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $builder->expects(self::once())
            ->method('addPlugin')
            ->with(self::isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $builder->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $builder->clearHeaders();
    }

    public function testShouldAddHeaders()
    {
        $headers = ['header1', 'header2'];

        $client = self::getMockBuilder(Builder::class)
            ->onlyMethods(['addPlugin', 'removePlugin'])
            ->getMock();
        $client->expects(self::once())
            ->method('addPlugin')
            // TODO verify that headers exists
            ->with(self::isInstanceOf(Plugin\HeaderAppendPlugin::class));

        $client->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $client->addHeaders($headers);
    }

    public function testAppendingHeaderShouldAddAndRemovePlugin()
    {
        $expectedHeaders = [
            'Accept' => 'application/json',
        ];

        $client = self::getMockBuilder(Builder::class)
            ->onlyMethods(['removePlugin', 'addPlugin'])
            ->getMock();

        $client->expects(self::once())
            ->method('removePlugin')
            ->with(Plugin\HeaderAppendPlugin::class);

        $client->expects(self::once())
            ->method('addPlugin')
            ->with(new Plugin\HeaderAppendPlugin($expectedHeaders));

        $client->addHeaderValue('Accept', 'application/json');
    }
}
