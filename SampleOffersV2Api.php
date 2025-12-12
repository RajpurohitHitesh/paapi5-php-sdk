<?php

/**
 * Copyright 2024 Amazon.com, Inc. or its affiliates. All Rights Reserved.
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
 * This sample code snippet is for ProductAdvertisingAPI 5.0's OffersV2 API
 *
 * For more details, refer: https://webservices.amazon.com/paapi5/documentation/offersV2.html
 */

use Amazon\ProductAdvertisingAPI\v1\ApiException;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\api\DefaultApi;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\GetItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsRequest;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\SearchItemsResource;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\PartnerType;
use Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\ProductAdvertisingAPIClientException;
use Amazon\ProductAdvertisingAPI\v1\Configuration;

require_once(__DIR__ . '/vendor/autoload.php'); // change path as needed

/**
 * Print OffersV2 details including DealDetails, Price, SavingBasis, and Savings
 *
 * @param \Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1\OffersV2 $offersV2 OffersV2 object
 */
function printOffersV2Details($offersV2)
{
    if ($offersV2 !== null) {
        $listings = $offersV2->getListings();
        
        if ($listings !== null && count($listings) > 0) {
            echo "OffersV2 Information:\n";
            echo str_repeat("-", 80) . "\n";
            
            foreach ($listings as $index => $listing) {
                echo "\nListing " . ($index + 1) . ":\n";
                
                // Availability Information
                $availability = $listing->getAvailability();
                if ($availability !== null) {
                    echo "  Availability:\n";
                    echo "    Type: " . ($availability->getType() ?? 'N/A') . "\n";
                    echo "    Message: " . ($availability->getMessage() ?? 'N/A') . "\n";
                    echo "    Min Order Quantity: " . ($availability->getMinOrderQuantity() ?? 'N/A') . "\n";
                    echo "    Max Order Quantity: " . ($availability->getMaxOrderQuantity() ?? 'N/A') . "\n";
                }
                
                // Condition Information
                $condition = $listing->getCondition();
                if ($condition !== null) {
                    echo "  Condition:\n";
                    echo "    Value: " . ($condition->getValue() ?? 'N/A') . "\n";
                    echo "    SubCondition: " . ($condition->getSubCondition() ?? 'N/A') . "\n";
                    $conditionNote = $condition->getConditionNote();
                    if (!empty($conditionNote)) {
                        echo "    Note: " . $conditionNote . "\n";
                    }
                }
                
                // Deal Details
                $dealDetails = $listing->getDealDetails();
                if ($dealDetails !== null) {
                    echo "  Deal Details:\n";
                    echo "    Access Type: " . ($dealDetails->getAccessType() ?? 'N/A') . "\n";
                    echo "    Badge: " . ($dealDetails->getBadge() ?? 'N/A') . "\n";
                    
                    $startTime = $dealDetails->getStartTime();
                    if ($startTime !== null) {
                        echo "    Start Time: " . $startTime . "\n";
                    }
                    
                    $endTime = $dealDetails->getEndTime();
                    if ($endTime !== null) {
                        echo "    End Time: " . $endTime . "\n";
                    }
                    
                    $percentClaimed = $dealDetails->getPercentClaimed();
                    if ($percentClaimed !== null) {
                        echo "    Percent Claimed: " . $percentClaimed . "%\n";
                    }
                    
                    $earlyAccessDuration = $dealDetails->getEarlyAccessDurationInMilliseconds();
                    if ($earlyAccessDuration !== null) {
                        echo "    Early Access Duration: " . $earlyAccessDuration . " ms\n";
                    }
                }
                
                // Buy Box Winner
                $isBuyBoxWinner = $listing->getIsBuyBoxWinner();
                if ($isBuyBoxWinner !== null) {
                    echo "  Is Buy Box Winner: " . ($isBuyBoxWinner ? 'Yes' : 'No') . "\n";
                }
                
                // Merchant Information
                $merchantInfo = $listing->getMerchantInfo();
                if ($merchantInfo !== null) {
                    echo "  Merchant:\n";
                    echo "    Name: " . ($merchantInfo->getName() ?? 'N/A') . "\n";
                    echo "    ID: " . ($merchantInfo->getId() ?? 'N/A') . "\n";
                }
                
                // Price Information (Main Feature)
                $price = $listing->getPrice();
                if ($price !== null) {
                    echo "  Price Information:\n";
                    
                    // Display Price (Money)
                    $money = $price->getMoney();
                    if ($money !== null) {
                        echo "    Display Amount: " . ($money->getDisplayAmount() ?? 'N/A') . "\n";
                        echo "    Amount: " . ($money->getAmount() ?? 'N/A') . "\n";
                        echo "    Currency: " . ($money->getCurrency() ?? 'N/A') . "\n";
                    }
                    
                    // Price Per Unit
                    $pricePerUnit = $price->getPricePerUnit();
                    if ($pricePerUnit !== null) {
                        echo "    Price Per Unit: " . ($pricePerUnit->getDisplayAmount() ?? 'N/A') . "\n";
                    }
                    
                    // Saving Basis (NEW in OffersV2)
                    $savingBasis = $price->getSavingBasis();
                    if ($savingBasis !== null) {
                        echo "    Saving Basis:\n";
                        echo "      Type: " . ($savingBasis->getSavingBasisType() ?? 'N/A') . "\n";
                        echo "      Type Label: " . ($savingBasis->getSavingBasisTypeLabel() ?? 'N/A') . "\n";
                        
                        $savingBasisMoney = $savingBasis->getMoney();
                        if ($savingBasisMoney !== null) {
                            echo "      Amount: " . ($savingBasisMoney->getDisplayAmount() ?? 'N/A') . "\n";
                        }
                    }
                    
                    // Savings (NEW in OffersV2)
                    $savings = $price->getSavings();
                    if ($savings !== null) {
                        echo "    Savings:\n";
                        
                        $savingsMoney = $savings->getMoney();
                        if ($savingsMoney !== null) {
                            echo "      Amount: " . ($savingsMoney->getDisplayAmount() ?? 'N/A') . "\n";
                        }
                        
                        $percentage = $savings->getPercentage();
                        if ($percentage !== null) {
                            echo "      Percentage: " . $percentage . "%\n";
                        }
                    }
                }
                
                // Loyalty Points (Japan marketplace only)
                $loyaltyPoints = $listing->getLoyaltyPoints();
                if ($loyaltyPoints !== null) {
                    echo "  Loyalty Points: " . ($loyaltyPoints->getPoints() ?? 'N/A') . "\n";
                }
                
                // Offer Type
                $type = $listing->getType();
                if ($type !== null) {
                    echo "  Type: " . $type . "\n";
                }
                
                // Violates MAP (Minimum Advertised Price)
                $violatesMAP = $listing->getViolatesMAP();
                if ($violatesMAP !== null) {
                    echo "  Violates MAP: " . ($violatesMAP ? 'Yes' : 'No') . "\n";
                }
                
                echo "\n";
            }
        } else {
            echo "No listings found in OffersV2.\n";
        }
    } else {
        echo "OffersV2 information not available.\n";
    }
}

/**
 * Example 1: Get Items with OffersV2 - Complete resource hierarchy
 */
function getItemsWithOffersV2()
{
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
        new GuzzleHttp\Client(),
        $config
    );

    # Request initialization

    # Choose item id(s)
    $itemIds = ["B00MNV8E0C"]; // Example ASIN

    /*
     * Choose OffersV2 resources with complete hierarchy
     * For more details, refer: https://webservices.amazon.com/paapi5/documentation/offersV2.html
     */
    $resources = [
        GetItemsResource::ITEM_INFOTITLE,
        // OffersV2 - Availability
        GetItemsResource::OFFERS_V2LISTINGSAVAILABILITY,
        GetItemsResource::OFFERS_V2LISTINGSAVAILABILITYMAX_ORDER_QUANTITY,
        GetItemsResource::OFFERS_V2LISTINGSAVAILABILITYMESSAGE,
        GetItemsResource::OFFERS_V2LISTINGSAVAILABILITYMIN_ORDER_QUANTITY,
        GetItemsResource::OFFERS_V2LISTINGSAVAILABILITYTYPE,
        // OffersV2 - Condition
        GetItemsResource::OFFERS_V2LISTINGSCONDITION,
        GetItemsResource::OFFERS_V2LISTINGSCONDITIONCONDITION_NOTE,
        GetItemsResource::OFFERS_V2LISTINGSCONDITIONSUB_CONDITION,
        GetItemsResource::OFFERS_V2LISTINGSCONDITIONVALUE,
        // OffersV2 - Deal Details (NEW)
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILS,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSBADGE,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSEARLY_ACCESS_DURATION_IN_MILLISECONDS,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSEND_TIME,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSPERCENT_CLAIMED,
        GetItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSSTART_TIME,
        // OffersV2 - Other fields
        GetItemsResource::OFFERS_V2LISTINGSIS_BUY_BOX_WINNER,
        GetItemsResource::OFFERS_V2LISTINGSLOYALTY_POINTS,
        GetItemsResource::OFFERS_V2LISTINGSLOYALTY_POINTSPOINTS,
        // OffersV2 - Merchant Info
        GetItemsResource::OFFERS_V2LISTINGSMERCHANT_INFO,
        GetItemsResource::OFFERS_V2LISTINGSMERCHANT_INFOID,
        GetItemsResource::OFFERS_V2LISTINGSMERCHANT_INFONAME,
        // OffersV2 - Price with SavingBasis and Savings (NEW)
        GetItemsResource::OFFERS_V2LISTINGSPRICE,
        GetItemsResource::OFFERS_V2LISTINGSPRICEMONEY,
        GetItemsResource::OFFERS_V2LISTINGSPRICEPRICE_PER_UNIT,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASIS,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASISMONEY,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE_LABEL,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVINGS,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVINGSMONEY,
        GetItemsResource::OFFERS_V2LISTINGSPRICESAVINGSPERCENTAGE,
        // OffersV2 - Type and ViolatesMAP
        GetItemsResource::OFFERS_V2LISTINGSTYPE,
        GetItemsResource::OFFERS_V2LISTINGSVIOLATES_MAP,
    ];

    # Forming the request
    $getItemsRequest = new GetItemsRequest();
    $getItemsRequest->setItemIds($itemIds);
    $getItemsRequest->setPartnerTag($partnerTag);
    $getItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
    $getItemsRequest->setResources($resources);

    # Validating request
    $invalidPropertyList = $getItemsRequest->listInvalidProperties();
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
        $getItemsResponse = $apiInstance->getItems($getItemsRequest);

        echo 'API called successfully', PHP_EOL;
        echo 'Complete Response: ', $getItemsResponse, PHP_EOL;

        # Parsing the response
        if ($getItemsResponse->getItemsResult() !== null) {
            echo 'Printing all item information in ItemsResult:', PHP_EOL;
            if ($getItemsResponse->getItemsResult()->getItems() !== null) {
                foreach ($getItemsResponse->getItemsResult()->getItems() as $item) {
                    echo "\nASIN: ", $item->getASIN(), PHP_EOL;
                    
                    if ($item->getItemInfo() !== null && $item->getItemInfo()->getTitle() !== null
                        && $item->getItemInfo()->getTitle()->getDisplayValue() !== null) {
                        echo 'Title: ', $item->getItemInfo()->getTitle()->getDisplayValue(), PHP_EOL;
                    }
                    
                    echo "\n";
                    printOffersV2Details($item->getOffersV2());
                }
            }
        }
        
        if ($getItemsResponse->getErrors() !== null) {
            echo PHP_EOL, 'Printing Errors:', PHP_EOL, 'Printing first error object from list of errors', PHP_EOL;
            echo 'Error code: ', $getItemsResponse->getErrors()[0]->getCode(), PHP_EOL;
            echo 'Error message: ', $getItemsResponse->getErrors()[0]->getMessage(), PHP_EOL;
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
}

/**
 * Example 2: Search Items with OffersV2
 */
function searchItemsWithOffersV2()
{
    $config = new Configuration();

    # Please add your access key here
    $config->setAccessKey('<YOUR ACCESS KEY>');
    # Please add your secret key here
    $config->setSecretKey('<YOUR SECRET KEY>');
    # Please add your partner tag (store/tracking id) here
    $partnerTag = '<YOUR PARTNER TAG>';

    $config->setHost('webservices.amazon.com');
    $config->setRegion('us-east-1');

    $apiInstance = new DefaultApi(
        new GuzzleHttp\Client(),
        $config
    );

    # Request initialization
    $keyword = 'headphones';

    # Choose OffersV2 resources
    $resources = [
        SearchItemsResource::ITEM_INFOTITLE,
        SearchItemsResource::OFFERS_V2LISTINGSAVAILABILITY,
        SearchItemsResource::OFFERS_V2LISTINGSCONDITION,
        SearchItemsResource::OFFERS_V2LISTINGSDEAL_DETAILS,
        SearchItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSBADGE,
        SearchItemsResource::OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE,
        SearchItemsResource::OFFERS_V2LISTINGSIS_BUY_BOX_WINNER,
        SearchItemsResource::OFFERS_V2LISTINGSMERCHANT_INFO,
        SearchItemsResource::OFFERS_V2LISTINGSPRICE,
        SearchItemsResource::OFFERS_V2LISTINGSPRICESAVING_BASIS,
        SearchItemsResource::OFFERS_V2LISTINGSPRICESAVINGS,
        SearchItemsResource::OFFERS_V2LISTINGSTYPE,
        SearchItemsResource::OFFERS_V2LISTINGSVIOLATES_MAP,
    ];

    # Forming the request
    $searchItemsRequest = new SearchItemsRequest();
    $searchItemsRequest->setKeywords($keyword);
    $searchItemsRequest->setPartnerTag($partnerTag);
    $searchItemsRequest->setPartnerType(PartnerType::ASSOCIATES);
    $searchItemsRequest->setResources($resources);
    $searchItemsRequest->setItemCount(5);

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
        
        # Parsing the response
        if ($searchItemsResponse->getSearchResult() !== null) {
            echo 'Printing items with OffersV2:', PHP_EOL;
            if ($searchItemsResponse->getSearchResult()->getItems() !== null) {
                foreach ($searchItemsResponse->getSearchResult()->getItems() as $item) {
                    echo "\nASIN: ", $item->getASIN(), PHP_EOL;
                    
                    if ($item->getItemInfo() !== null && $item->getItemInfo()->getTitle() !== null
                        && $item->getItemInfo()->getTitle()->getDisplayValue() !== null) {
                        echo 'Title: ', $item->getItemInfo()->getTitle()->getDisplayValue(), PHP_EOL;
                    }
                    
                    echo "\n";
                    printOffersV2Details($item->getOffersV2());
                }
            }
        }
        
        if ($searchItemsResponse->getErrors() !== null) {
            echo PHP_EOL, 'Printing Errors:', PHP_EOL;
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
}

// Uncomment the function you want to test
// getItemsWithOffersV2();
// searchItemsWithOffersV2();

echo "\nOffersV2 Sample API - Ready to use!\n";
echo "Please update your credentials and uncomment the function calls to test.\n\n";
echo "Key Features of OffersV2:\n";
echo "- Complete Availability information (Type, Message, Min/Max Order Quantity)\n";
echo "- Enhanced Condition details (Value, SubCondition, ConditionNote)\n";
echo "- Deal Details (Badge, AccessType, StartTime, EndTime, PercentClaimed, EarlyAccessDuration)\n";
echo "- Merchant Information (Name and ID)\n";
echo "- Enhanced Price with SavingBasis (Type, TypeLabel, Money)\n";
echo "- Savings details (Money and Percentage)\n";
echo "- ViolatesMAP flag\n";
echo "- Offer Type (LIGHTNING_DEAL, SUBSCRIBE_AND_SAVE)\n";
echo "\nFor more details: https://webservices.amazon.com/paapi5/documentation/offersV2.html\n";
