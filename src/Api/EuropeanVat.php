<?php declare(strict_types=1);

namespace Enola\Api;

/**
 * This service provides REST calls to extract information on european companies from simple parameters such as country code and VAT number
 *
 * @link https://developers.openapi.it/categories/ecommerce/europeanvat
 */
class EuropeanVat extends AbstractApi
{
    public const ENDPOINT = 'https://europeanvat.altravia.com';

    public const SANDBOX = 'https://test.europeanvat.altravia.com';

    /**
     * This service returns basic information of a company such as company name and address.
     *
     * @link https://developers.openapi.it/categories/ecommerce/europeanvat#/Company%20Information/get_companies__country_code___vat_
     *
     * @param string $countryCode company country code
     * @param string $vatNumber VAT number of the company
     * @return array|string
     */
    public function getCompanyInformation(string $countryCode, string $vatNumber, array $params = [])
    {
        return $this->get('/companies/' . rawurlencode($countryCode) . '/' . rawurlencode($vatNumber), $params);
    }
}
