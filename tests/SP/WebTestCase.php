<?php
/**
 * sysPass
 *
 * @author    nuxsmin
 * @link      https://syspass.org
 * @copyright 2012-2018, Rubén Domínguez nuxsmin@$syspass.org
 *
 * This file is part of sysPass.
 *
 * sysPass is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sysPass is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 *  along with sysPass.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace SP\Tests;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class WebTestCase
 *
 * @package SP\Tests\SP
 */
abstract class WebTestCase extends TestCase
{
    /**
     * @param string $url
     * @param mixed  $content Unencoded JSON data
     *
     * @return ResponseInterface
     */
    protected static function postJson(string $url, $content = '')
    {
        return (new Client())->request('POST', $url, [
            'body' => json_encode($content),
            'headers' => ['Content-Type' => 'application/json'],
            'http_errors' => false,
        ]);
    }

    /**
     * @param ResponseInterface $response
     *
     * @param int    $httpCode
     *
     * @return stdClass
     */
    protected static function checkAndProcessJsonResponse(ResponseInterface $response, $httpCode = 200)
    {
        self::assertEquals($httpCode, $response->getStatusCode());
        self::assertEquals('application/json; charset=utf-8', $response->getHeaderLine('Content-Type'));

        return json_decode((string)$response->getBody());
    }
}
