<?php declare(strict_types=1);

namespace Enola\Api;

/**
 * This service provides REST calls to extract information on businesses and companies from simple parameters such as denomination or VAT number
 *
 * @link https://developers.openapi.it/categories/direct_marketing/imprese
 */
class Imprese extends AbstractApi
{
    public const ENDPOINT = 'https://imprese.openapi.it';

    public const SANDBOX = 'https://test.imprese.openapi.it';

    /**
     * This service returns basic information of a company such as company name and address
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_base__piva_cf_or_id_
     *
     * @param string $VatOrCfOrId VAT number, tax code or company ID
     * @return array|string
     */
    public function getBaseCompanyInformation(string $VatOrCfOrId)
    {
        return $this->get('/base/' . $VatOrCfOrId);
    }

    /**
     * With this service we can draw up a list of companies that correspond to certain parameters described below. The call returns a maximum of 100 results even if you set a higher limit.
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_advance
     *
     * @param array $params keys denominazione|provincia|codice_ateco|cciaa|rea|fatturato_min|fatturato_max|dipendenti_min|dipendenti_max|skip|limit|dry_run|lat|lng|radius
     * @return array|string
     */
    public function getCompaniesInformation(array $params = [])
    {
        return $this->get('/advance', $params);
    }

    /**
     * This service gets advanced information about a company
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_advance__piva_cf_or_id_
     *
     * @param string $VatOrCfOrId VAT number, tax code or company ID
     * @return array|string
     */
    public function getFullCompanyInformation(string $VatOrCfOrId)
    {
        return $this->get('/advance/' . $VatOrCfOrId);
    }

    /**
     * Simple service to understand if a VAT number has ceased or not according to the Tax Office
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_closed__piva_or_cf_
     *
     * @param string $vatOrCf VAT number or tax code
     * @return array|string
     */
    public function getClosedCompany(string $vatOrCf)
    {
        return $this->get('/closed/' . $vatOrCf);
    }

    /**
     * From this service you can understand if a company is part of a VAT group and if the tax code is consistent with the VAT number taken as input
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_gruppoiva__piva_or_cf_
     *
     * @param string $vatOrCf VAT number or tax code
     * @param array $params keys cf if a tax code is given, this service will return additional information about the relationship between the VAT group and the tax code
     * @return array|string
     */
    public function getGruppoiva(string $vatOrCf, array $params = [])
    {
        return $this->get('/gruppoiva/' . $vatOrCf, $params);
    }

    /**
     * Starting from a VAT number it extracts the pec of the company
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_pec__piva_or_cf_
     *
     * @param string $vatOrCf VAT number or tax code
     * @return array|string
     */
    public function getCompanyPec(string $vatOrCf)
    {
        return $this->get('/pec/' . $vatOrCf);
    }

    /**
     * This service performs a search on the list of all the available companies with the given query
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_autocomplete__query_
     *
     * @param string $term A search query; '*' can be used as a wildcard to search for strings that start, contain or end with the given query.
     * @param array $params keys lat|lng|radius
     * @return array|string
     */
    public function getAutocomplete(string $term, array $params = [])
    {
        return $this->get('/autocomplete/' . rawurlencode($term), $params);
    }

    /**
     * With this service you can see all the legal forms registered
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_forma_giuridica
     *
     * @return array|string
     */
    public function getFormaGiuridica()
    {
        return $this->get('/forma_giuridica');
    }

    /**
     * With this service you can see the value of the legal code passed as a parameter
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_forma_giuridica__codice_natura_giuridica_
     *
     * @param string $code legal code
     * @return array|string
     */
    public function getFormaGiuridicaByCode(string $code)
    {
        return $this->get('/forma_giuridica/' . $code);
    }

    /**
     * This call returns the list of all companies
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_updates
     *
     * @param array $params keys lat|lng|radius|skip|limit|dry_run
     * @return array|string
     */
    public function getUpdates(array $params = [])
    {
        return $this->get('/updates', $params);
    }

    /**
     * This call returns the list of all companies that have had updates after the time threshold passed via timestamp
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_updates__timestamp_
     *
     * @param \DateTimeImmutable $since a timestamp
     * @param array $params keys lat|lng|radius|skip|limit|dry_run
     * @return array|string
     */
    public function getUpdateSince(\DateTimeImmutable $since, array $params = [])
    {
        return $this->get('/updates/' . $since->getTimestamp(), $params);
    }
}
