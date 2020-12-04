<?php

namespace Tests\Client\ApiDojo;

use Imdb\Client\ApiDojo\Client;
use Imdb\Client\ApiDojo\ClientFactory;
use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use Imdb\Client\ApiDojo\Credentials;
use PHPUnit\Framework\TestCase;

class ClientFactoryTest extends TestCase
{
    public function testCreatApiDojoClient() {
        $factory = new ClientFactory($this->createMock(GuzzleClientInterface::class), $this->createMock(Credentials::class));
        $this->assertEquals(
            new Client($this->createMock(GuzzleClientInterface::class), $this->createMock(Credentials::class)),
            $factory->createClient()
        );
    }
}
