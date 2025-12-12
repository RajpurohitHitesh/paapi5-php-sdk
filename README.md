# Product Advertising API 5.0 SDK for PHP

[![Version](https://img.shields.io/packagist/v/rajpurohithitesh/paapi5-php-sdk)](https://packagist.org/packages/rajpurohithitesh/paapi5-php-sdk)
[![PHP Version](https://img.shields.io/packagist/php-v/rajpurohithitesh/paapi5-php-sdk)](https://packagist.org/packages/rajpurohithitesh/paapi5-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/rajpurohithitesh/paapi5-php-sdk.svg?style=flat)](https://packagist.org/packages/rajpurohithitesh/paapi5-php-sdk)

This repository contains the open source PHP SDK that allows you to access the [Product Advertising API](https://webservices.amazon.com/paapi5/documentation/index.html) from your PHP app.

## 🚨 Version 1.0.0 - Breaking Changes

**Legacy Offers v1 has been completely removed.** This SDK now exclusively supports **OffersV2**.

If you're upgrading from v1.x:
- Replace all `OFFERSLISTINGS*` with `OFFERS_V2LISTINGS*`
- Change `getOffers()` to `getOffersV2()`
- Update price access: `getPrice()->getMoney()->getDisplayAmount()`

See [MIGRATION_GUIDE_V2.md](MIGRATION_GUIDE_V2.md) for complete migration instructions.

## Installation
The Product Advertising API PHP SDK can be installed with [Composer](https://getcomposer.org/). The SDK is available via [Packagist](http://packagist.org/) under the [`rajpurohithitesh/paapi5-php-sdk`](https://packagist.org/packages/rajpurohithitesh/paapi5-php-sdk) package. If Composer is installed globally on your system, you can run the following in the base directory of your project to add the SDK as a dependency:

```sh
composer require rajpurohithitesh/paapi5-php-sdk
```

## Usage
> **Note:** This version of the Product Advertising API SDK for PHP requires PHP 8.0 or greater.

Simple example for [SearchItems](https://webservices.amazon.com/paapi5/documentation/search-items.html) to discover Amazon products with the keyword 'Harry Potter' in Books category:

```php
<?php
/**
 * Copyright 2019 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

/*
 * ProductAdvertisingAPI
 *
 * https://webservices.amazon.com/paapi5/documentation/index.html
 */
 
/*
 * This sample code snippet is for ProductAdvertisingAPI 5.0's SearchItems API
 *
 * For more details, refer: https://webservices.amazon.com/paapi5/documentation/search-items.html
 */
 
use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\PartnerType;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\ProductAdvertisingAPIClientException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResource;
use Amazon\ProductAdvertisingAPI\v1\Configuration;
 
require_once(__DIR__ . '/vendor/autoload.php'); // change path as needed
 
 
$config = new Configuration();

/*
 * Add your credentials
 */
# Please add your access key here
$config->setAccessKey('<YOUR ACCESS KEY>');
# Please add your secret key here
$config->setSecretKey('<YOUR SECRET KEY>');
 
# Please add your partner tag (store/tracking id) here
$partnerTag = '<YOUR PARTNER TAG>';
 
/*
 * PAAPI host and region to which you want to send request
 * For more details refer:
 * https://webservices.amazon.com/paapi5/documentation/common-request-parameters.html#host-and-region
 */
$config->setHost('webservices.amazon.com');
$config->setRegion('us-east-1');
 
$apiInstance = new DefaultApi(
    /*
     * If you want use custom http client, pass your client which implements `GuzzleHttp\ClientInterface`.
     * This is optional, `GuzzleHttp\Client` will be used as default.
     */
    new GuzzleHttp\Client(), $config);
 
# Request initialization
 
# Specify keywords
$keyword = 'Harry Potter';
 
/*
 * Specify the category in which search request is to be made
 * For more details, refer:
 * https://webservices.amazon.com/paapi5/documentation/use-cases/organization-of-items-on-amazon/search-index.html
 */
$searchIndex = "Books";
 
# Specify item count to be returned in search result
$itemCount = 1;
 
/*
 * Choose resources you want from SearchItemsResource enum
 * For more details, refer:
 * https://webservices.amazon.com/paapi5/documentation/search-items.html#resources-parameter
 */
$resources = [
    SearchItemsResource::ITEM_INFOTITLE,
    SearchItemsResource::OFFERS_V2LISTINGSPRICE];
 
# Forming the request
$searchItemsRequest = new SearchItemsRequest();
$searchItemsRequest->setSearchIndex($searchIndex);
$searchItemsRequest->setKeywords($keyword);
$searchItemsRequest->setItemCount($itemCount);
$searchItemsRequest->setPartnerTag($partnerTag);
$searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
$searchItemsRequest->setResources($resources);
 
# Validating request
$invalidPropertyList = $searchItemsRequest->listInvalidProperties();
$length = count($invalidPropertyList);
if ($length > 0) {
    echo "Error forming the request", PHP_EOL;
    foreach ($invalidPropertyList as $invalidProperty) {
        echo $invalidProperty, PHP_EOL;
    }
    return;
}

# Sending the request
try {
    $searchItemsResponse = $apiInstance->searchItems($searchItemsRequest);

    echo 'API called successfully', PHP_EOL;
    echo 'Complete Response: ', $searchItemsResponse, PHP_EOL;

    # Parsing the response
    if ($searchItemsResponse->getSearchResult() !== null) {
        echo 'Printing first item information in SearchResult:', PHP_EOL;
        $item = $searchItemsResponse->getSearchResult()->getItems()[0];
        if ($item !== null) {
            if ($item->getASIN() !== null) {
                echo "ASIN: ", $item->getASIN(), PHP_EOL;
            }
            if ($item->getDetailPageURL() !== null) {
                echo "DetailPageURL: ", $item->getDetailPageURL(), PHP_EOL;
            }
            if ($item->getItemInfo() !== null
                and $item->getItemInfo()->getTitle() !== null
                and $item->getItemInfo()->getTitle()->getDisplayValue() !== null) {
                echo "Title: ", $item->getItemInfo()->getTitle()->getDisplayValue(), PHP_EOL;
            }
            if ($item->getOffersV2() !== null
                and $item->getOffersV2()->getListings() !== null
                and $item->getOffersV2()->getListings()[0]->getPrice() !== null
                and $item->getOffersV2()->getListings()[0]->getPrice()->getMoney() !== null
                and $item->getOffersV2()->getListings()[0]->getPrice()->getMoney()->getDisplayAmount() !== null) {
                echo "Buying price: ", $item->getOffersV2()->getListings()[0]->getPrice()
                    ->getMoney()->getDisplayAmount(), PHP_EOL;
            }
        }
    }
    if ($searchItemsResponse->getErrors() !== null) {
        echo PHP_EOL, 'Printing Errors:', PHP_EOL, 'Printing first error object from list of errors', PHP_EOL;
        echo 'Error code: ', $searchItemsResponse->getErrors()[0]->getCode(), PHP_EOL;
        echo 'Error message: ', $searchItemsResponse->getErrors()[0]->getMessage(), PHP_EOL;
    }
} catch (ApiException $exception) {
    echo "Error calling PA-API 5.0!", PHP_EOL;
    echo "HTTP Status Code: ", $exception->getCode(), PHP_EOL;
    echo "Error Message: ", $exception->getMessage(), PHP_EOL;
    if ($exception->getResponseObject() instanceof ProductAdvertisingAPIClientException) {
        $errors = $exception->getResponseObject()->getErrors();
        foreach ($errors as $error) {
            echo "Error Type: ", $error->getCode(), PHP_EOL;
            echo "Error Message: ", $error->getMessage(), PHP_EOL;
        }
    } else {
        echo "Error response body: ", $exception->getResponseBody(), PHP_EOL;
    }
} catch (Exception $exception) {
    echo "Error Message: ", $exception->getMessage(), PHP_EOL;
}
?>
```

Complete documentation, installation instructions, and examples are available [here](https://webservices.amazon.com/paapi5/documentation/index.html).

## OffersV2 Support

This SDK includes complete support for **OffersV2**, Amazon's enhanced offers API with improved reliability and data quality. OffersV2 is recommended over the legacy Offers API.

### Key Features of OffersV2

- **Enhanced Availability Information**: Detailed stock status with message, min/max order quantities
- **Complete Condition Details**: Value, SubCondition, and ConditionNote
- **Deal Details**: Lightning Deals, Prime Exclusive Deals with Badge, AccessType, StartTime, EndTime, PercentClaimed, and Early Access Duration
- **Merchant Information**: Name and ID
- **Enhanced Pricing**:
  - Money (Amount, Currency, DisplayAmount)
  - PricePerUnit
  - **SavingBasis** (Type, TypeLabel, Money) - NEW!
  - **Savings** (Money, Percentage) - NEW!
- **Offer Type**: LIGHTNING_DEAL, SUBSCRIBE_AND_SAVE
- **ViolatesMAP**: Minimum Advertised Price flag
- **Loyalty Points**: Japan marketplace support

### OffersV2 Resources Available

The SDK provides granular resource constants for all OffersV2 fields across all operations (GetItems, SearchItems, GetVariations):

#### Availability Resources
- `OFFERS_V2LISTINGSAVAILABILITY`
- `OFFERS_V2LISTINGSAVAILABILITYMAX_ORDER_QUANTITY`
- `OFFERS_V2LISTINGSAVAILABILITYMESSAGE`
- `OFFERS_V2LISTINGSAVAILABILITYMIN_ORDER_QUANTITY`
- `OFFERS_V2LISTINGSAVAILABILITYTYPE`

#### Condition Resources
- `OFFERS_V2LISTINGSCONDITION`
- `OFFERS_V2LISTINGSCONDITIONCONDITION_NOTE`
- `OFFERS_V2LISTINGSCONDITIONSUB_CONDITION`
- `OFFERS_V2LISTINGSCONDITIONVALUE`

#### Deal Details Resources (NEW)
- `OFFERS_V2LISTINGSDEAL_DETAILS`
- `OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE`
- `OFFERS_V2LISTINGSDEAL_DETAILSBADGE`
- `OFFERS_V2LISTINGSDEAL_DETAILSEARLY_ACCESS_DURATION_IN_MILLISECONDS`
- `OFFERS_V2LISTINGSDEAL_DETAILSEND_TIME`
- `OFFERS_V2LISTINGSDEAL_DETAILSPERCENT_CLAIMED`
- `OFFERS_V2LISTINGSDEAL_DETAILSSTART_TIME`

#### Price Resources with SavingBasis and Savings (NEW)
- `OFFERS_V2LISTINGSPRICE`
- `OFFERS_V2LISTINGSPRICEMONEY`
- `OFFERS_V2LISTINGSPRICEPRICE_PER_UNIT`
- `OFFERS_V2LISTINGSPRICESAVING_BASIS`
- `OFFERS_V2LISTINGSPRICESAVING_BASISMONEY`
- `OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE`
- `OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE_LABEL`
- `OFFERS_V2LISTINGSPRICESAVINGS`
- `OFFERS_V2LISTINGSPRICESAVINGSMONEY`
- `OFFERS_V2LISTINGSPRICESAVINGSPERCENTAGE`

#### Merchant Info Resources
- `OFFERS_V2LISTINGSMERCHANT_INFO`
- `OFFERS_V2LISTINGSMERCHANT_INFOID`
- `OFFERS_V2LISTINGSMERCHANT_INFONAME`

#### Other Resources
- `OFFERS_V2LISTINGSIS_BUY_BOX_WINNER`
- `OFFERS_V2LISTINGSLOYALTY_POINTS`
- `OFFERS_V2LISTINGSLOYALTY_POINTSPOINTS`
- `OFFERS_V2LISTINGSTYPE`
- `OFFERS_V2LISTINGSVIOLATES_MAP`

### Sample Code

See [SampleOffersV2Api.php](SampleOffersV2Api.php) for complete examples demonstrating:
- GetItems with complete OffersV2 hierarchy
- SearchItems with OffersV2 
- Deal Details extraction
- SavingBasis and Savings calculation
- All OffersV2 fields parsing

### Quick Example

```php
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetItemsResource;

$resources = [
    GetItemsResource::ITEM_INFOTITLE,
    // Deal Details
    GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILS,
    GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSBADGE,
    GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE,
    // Price with Savings
    GetItemsResource::OFFERS_V2LISTINGSPRICE,
    GetItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASIS,
    GetItemsResource::OFFERS_V2LISTINGSPRICESAVINGS,
    // Other fields
    GetItemsResource::OFFERS_V2LISTINGSVIOLATES_MAP,
];
```

For complete OffersV2 documentation, visit: [https://webservices.amazon.com/paapi5/documentation/offersV2.html](https://webservices.amazon.com/paapi5/documentation/offersV2.html)

## License
This SDK is distributed under the [Apache License, Version 2.0](http://www.apache.org/licenses/LICENSE-2.0), see LICENSE.txt and NOTICE.txt for more information.
