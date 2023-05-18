# Enola Client

[![Latest Stable Version](http://poser.pugx.org/opendaje/enola-client/v)](https://packagist.org/packages/opendaje/enola-client) [![Total Downloads](http://poser.pugx.org/opendaje/enola-client/downloads)](https://packagist.org/packages/opendaje/enola-client) [![Latest Unstable Version](http://poser.pugx.org/opendaje/enola-client/v/unstable)](https://packagist.org/packages/opendaje/enola-client) [![License](http://poser.pugx.org/opendaje/enola-client/license)](https://packagist.org/packages/opendaje/enola-client) [![PHP Version Require](http://poser.pugx.org/opendaje/enola-client/require/php)](https://packagist.org/packages/opendaje/enola-client)

[![CD/CI](https://github.com/OpenDaje/enola-client/actions/workflows/cd-ci.yaml/badge.svg)](https://github.com/OpenDaje/enola-client/actions/workflows/cd-ci.yaml) [![codecov](https://codecov.io/gh/OpenDaje/enola-client/branch/main/graph/badge.svg?token=NVZZU0KDIH)](https://codecov.io/gh/OpenDaje/enola-client)

Unofficial [OpenApi.it](https://developers.openapi.it/) api client.

⚠ Launching early stage releases (0.x.x) could break the API according to [Semantic Versioning 2.0](https://semver.org/). We are using *minor* for breaking changes.
This will change with the release of the stable `1.0.0` version.

Questa libreria fornisce un'api client per parte delle api di [OpenApi.it](https://developers.openapi.it/) ( [official client](https://github.com/openapi-it/OpenApi-PHP) )

A differenza del client ufficiale, il client enola è sviluppato sulle specifiche [PSR](https://www.php-fig.org/psr/psr-18/) per http, quindi la libreria non viene distribuita
con uno specifico http client, ma è compatibile con quelli presenti in questa [lista](https://packagist.org/providers/psr/http-client-implementation)

## Servizi/Api supportati

- Cap
- Europena Vat
- Imprese
- Car

## INSTALLAZIONE

```sh
composer require opendaje/enola-client

// installa un Http client compatibile con lo standard PSR

composer require http-interop/http-factory-guzzle php-http/guzzle6-adapter
```

## Uso

```php
$token = 'MY_TOKEN';
$isSandbox = true;

$client = new EnolaClient($token, $isSandbox);
$response = $client->api('cap')->getRegioni();
print_r($response);
```