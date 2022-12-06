<?php declare(strict_types=1);

namespace Enola\Api;

/**
 * This service allows you to search italian cities and get their istat and cap codes.
 *
 * @link https://developers.openapi.it/categories/ecommerce/cap
 */
class Cap extends AbstractApi
{
    public const ENDPOINT = 'https://cap.openapi.it';

    public const SANDBOX = 'https://test.cap.openapi.it';

    /**
     * Search cities by name, region and/or province
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Comuni/get_cerca_comuni
     *
     * @param array $params keys comune|cap|istat|codice_catasto|regione|provincia|cod_fisco
     * @return array|string
     */
    public function searchCity(array $params = [])
    {
        return $this->get('/cerca_comuni', $params);
    }

    /**
     * Get basic information about a city
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Comuni/get_comuni_base__istat_code_
     *
     * @param string $istatCode Istat code of the city, you can find it in the search results
     * @return array|string
     */
    public function getBaseCityInformation(string $istatCode)
    {
        return $this->get('/comuni_base/' . rawurlencode($istatCode));
    }

    /**
     * Get more information about a city
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Comuni/get_comuni_advance__istat_code_
     *
     * @param string $istatCode Istat code of the city, you can find it in the search results
     * @return array|string
     */
    public function getFullCityInformation(string $istatCode)
    {
        return $this->get('/comuni_advance/' . rawurlencode($istatCode));
    }

    /**
     * Get a list of suppressed municipalities
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Comuni/get_comuni_soppressi
     *
     * @param array $params key sigla_provincia
     * @return array|string
     */
    public function getSuppressedCities(array $params = [])
    {
        return $this->get('/comuni_soppressi', $params);
    }

    /**
     * Get a list of Italian metropolitan cities
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Comuni/get_citta_metropolitane
     *
     * @return array|string
     */
    public function getMetropolitanCities()
    {
        return $this->get('/citta_metropolitane');
    }

    /**
     * Get a list of cities that match a cap
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Cap/get_cap__cap_
     *
     * @param string $cap A cap code
     * @return array|string
     */
    public function getCitiesByCap(string $cap)
    {
        return $this->get('/cap/' . rawurlencode($cap));
    }

    /**
     * Get the list of italian regions.
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Regioni/get_regioni
     *
     * @return array|string
     */
    public function getRegioni()
    {
        return $this->get('/regioni');
    }

    /**
     * Get the list of italian provinces.
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Province/get_province
     *
     * @return array|string
     */
    public function getProvince()
    {
        return $this->get('/province');
    }

    /**
     * Get an italian province
     *
     * @link https://developers.openapi.it/categories/ecommerce/cap#/Province/get_province__code_
     *
     * @param string $code The province code, like RM, MI, TO ...
     * @return array|string
     */
    public function getProvinceByCode(string $code)
    {
        return $this->get('/province/' . rawurlencode($code));
    }
}
