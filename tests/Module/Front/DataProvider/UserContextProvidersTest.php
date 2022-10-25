<?php

declare(strict_types=1);

namespace App\Tests\Module\Front\DataProvider;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class UserContextProvidersTest extends ApiTestCase
{
    public function testProvider(): void
    {
        $response = static::createClient()->request('GET', '/api/user_contexts');
        $data = $response->toArray();

        self::assertTrue($data['hydra:totalItems'] > 0);
        $this->assertResponseIsSuccessful();
    }
}
