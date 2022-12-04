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
     * @return array|string
     */
    public function getCompanyByPartitaIva(string $pivaOrVatOrId, array $params = [])
    {
        return $this->get('/base/' . $pivaOrVatOrId, $params);
    }

    /**
     * With this service we can draw up a list of companies that correspond to certain parameters described below. The call returns a maximum of 100 results even if you set a higher limit.
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_advance
     *
     * @return array|string
     */
    public function getAdvancedCompanyInformation(array $params = [])
    {
        return $this->get('/advance', $params);
    }

    /**
     * This service gets advanced information about a company
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_advance__piva_cf_or_id_
     *
     * @return array|string
     */
    public function getFullCompanyByPartitaIva(string $pivaOrVatOrId, array $params = [])
    {
        return $this->get('/advance/' . $pivaOrVatOrId, $params);
    }

    /**
     * Simple service to understand if a VAT number has ceased or not according to the Tax Office
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_closed__piva_or_cf_
     *
     * @return array|string
     */
    public function getClosedCompanyByPartitaIva(string $pivaOrVat, array $params = [])
    {
        return $this->get('/closed/' . $pivaOrVat, $params);
    }

    /**
     * From this service you can understand if a company is part of a VAT group and if the tax code is consistent with the VAT number taken as input
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_gruppoiva__piva_or_cf_
     *
     * @return array|string
     */
    public function getGruppoiva(string $pivaOrVat, array $params = [])
    {
        return $this->get('/gruppoiva/' . $pivaOrVat, $params);
    }

    /**
     * Starting from a VAT number it extracts the pec of the company
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_pec__piva_or_cf_
     *
     * @return array|string
     */
    public function getCompanyPec(string $pivaOrVat, array $params = [])
    {
        return $this->get('/pec/' . $pivaOrVat, $params);
    }

    /**
     * This service performs a search on the list of all the available companies with the given query
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_autocomplete__query_
     *
     * @return array|string
     */
    public function getAutocomplete(string $term, array $params = [])
    {
        return $this->get('/autocomplete/' . $term, $params);
    }

    /**
     * With this service you can see all the legal forms registered
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_forma_giuridica
     *
     * @return array|string
     */
    public function getFormaGiuridica(array $params = [])
    {
        return $this->get('/forma_giuridica', $params);
    }

    /**
     * With this service you can see the value of the legal code passed as a parameter
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_forma_giuridica__codice_natura_giuridica_
     *
     * @return array|string
     */
    public function getFormaGiuridicaByCode(string $code, array $params = [])
    {
        return $this->get('/forma_giuridica/' . $code, $params);
    }

    /**
     * This call returns the list of all companies
     *
     * @link https://developers.openapi.it/categories/direct_marketing/imprese#/Company%20Information/get_updates
     *
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
     * @return array|string
     */
    public function getUpdateSince(\DateTimeImmutable $since, array $params = [])
    {
        return $this->get('/updates/' . $since->getTimestamp(), $params);
    }
}
