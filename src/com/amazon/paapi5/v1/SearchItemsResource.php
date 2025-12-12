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

namespace Amazon\ProductAdvertisingAPI\v1\com\amazon\paapi5\v1;
use \Amazon\ProductAdvertisingAPI\v1\ObjectSerializer;

/**
 * SearchItemsResource Class Doc Comment
 *
 * @category Class
 * @package  Amazon\ProductAdvertisingAPI\v1
 * @author   Product Advertising API team
 */
class SearchItemsResource
{
    /**
     * Possible values of this enum
     */
    const BROWSE_NODE_INFOBROWSE_NODES = 'BrowseNodeInfo.BrowseNodes';
    const BROWSE_NODE_INFOBROWSE_NODESANCESTOR = 'BrowseNodeInfo.BrowseNodes.Ancestor';
    const BROWSE_NODE_INFOBROWSE_NODESSALES_RANK = 'BrowseNodeInfo.BrowseNodes.SalesRank';
    const BROWSE_NODE_INFOWEBSITE_SALES_RANK = 'BrowseNodeInfo.WebsiteSalesRank';
    const CUSTOMER_REVIEWSCOUNT = 'CustomerReviews.Count';
    const CUSTOMER_REVIEWSSTAR_RATING = 'CustomerReviews.StarRating';
    const IMAGESPRIMARYSMALL = 'Images.Primary.Small';
    const IMAGESPRIMARYMEDIUM = 'Images.Primary.Medium';
    const IMAGESPRIMARYLARGE = 'Images.Primary.Large';
    const IMAGESVARIANTSSMALL = 'Images.Variants.Small';
    const IMAGESVARIANTSMEDIUM = 'Images.Variants.Medium';
    const IMAGESVARIANTSLARGE = 'Images.Variants.Large';
    const ITEM_INFOBY_LINE_INFO = 'ItemInfo.ByLineInfo';
    const ITEM_INFOCONTENT_INFO = 'ItemInfo.ContentInfo';
    const ITEM_INFOCONTENT_RATING = 'ItemInfo.ContentRating';
    const ITEM_INFOCLASSIFICATIONS = 'ItemInfo.Classifications';
    const ITEM_INFOEXTERNAL_IDS = 'ItemInfo.ExternalIds';
    const ITEM_INFOFEATURES = 'ItemInfo.Features';
    const ITEM_INFOMANUFACTURE_INFO = 'ItemInfo.ManufactureInfo';
    const ITEM_INFOPRODUCT_INFO = 'ItemInfo.ProductInfo';
    const ITEM_INFOTECHNICAL_INFO = 'ItemInfo.TechnicalInfo';
    const ITEM_INFOTITLE = 'ItemInfo.Title';
    const ITEM_INFOTRADE_IN_INFO = 'ItemInfo.TradeInInfo';
    const OFFERS_V2LISTINGSAVAILABILITY = 'OffersV2.Listings.Availability';
    const OFFERS_V2LISTINGSAVAILABILITYMAX_ORDER_QUANTITY = 'OffersV2.Listings.Availability.MaxOrderQuantity';
    const OFFERS_V2LISTINGSAVAILABILITYMESSAGE = 'OffersV2.Listings.Availability.Message';
    const OFFERS_V2LISTINGSAVAILABILITYMIN_ORDER_QUANTITY = 'OffersV2.Listings.Availability.MinOrderQuantity';
    const OFFERS_V2LISTINGSAVAILABILITYTYPE = 'OffersV2.Listings.Availability.Type';
    const OFFERS_V2LISTINGSCONDITION = 'OffersV2.Listings.Condition';
    const OFFERS_V2LISTINGSCONDITIONCONDITION_NOTE = 'OffersV2.Listings.Condition.ConditionNote';
    const OFFERS_V2LISTINGSCONDITIONSUB_CONDITION = 'OffersV2.Listings.Condition.SubCondition';
    const OFFERS_V2LISTINGSCONDITIONVALUE = 'OffersV2.Listings.Condition.Value';
    const OFFERS_V2LISTINGSDEAL_DETAILS = 'OffersV2.Listings.DealDetails';
    const OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE = 'OffersV2.Listings.DealDetails.AccessType';
    const OFFERS_V2LISTINGSDEAL_DETAILSBADGE = 'OffersV2.Listings.DealDetails.Badge';
    const OFFERS_V2LISTINGSDEAL_DETAILSEARLY_ACCESS_DURATION_IN_MILLISECONDS = 'OffersV2.Listings.DealDetails.EarlyAccessDurationInMilliseconds';
    const OFFERS_V2LISTINGSDEAL_DETAILSEND_TIME = 'OffersV2.Listings.DealDetails.EndTime';
    const OFFERS_V2LISTINGSDEAL_DETAILSPERCENT_CLAIMED = 'OffersV2.Listings.DealDetails.PercentClaimed';
    const OFFERS_V2LISTINGSDEAL_DETAILSSTART_TIME = 'OffersV2.Listings.DealDetails.StartTime';
    const OFFERS_V2LISTINGSIS_BUY_BOX_WINNER = 'OffersV2.Listings.IsBuyBoxWinner';
    const OFFERS_V2LISTINGSLOYALTY_POINTS = 'OffersV2.Listings.LoyaltyPoints';
    const OFFERS_V2LISTINGSLOYALTY_POINTSPOINTS = 'OffersV2.Listings.LoyaltyPoints.Points';
    const OFFERS_V2LISTINGSMERCHANT_INFO = 'OffersV2.Listings.MerchantInfo';
    const OFFERS_V2LISTINGSMERCHANT_INFOID = 'OffersV2.Listings.MerchantInfo.Id';
    const OFFERS_V2LISTINGSMERCHANT_INFONAME = 'OffersV2.Listings.MerchantInfo.Name';
    const OFFERS_V2LISTINGSPRICE = 'OffersV2.Listings.Price';
    const OFFERS_V2LISTINGSPRICEMONEY = 'OffersV2.Listings.Price.Money';
    const OFFERS_V2LISTINGSPRICEPRICE_PER_UNIT = 'OffersV2.Listings.Price.PricePerUnit';
    const OFFERS_V2LISTINGSPRICESAVING_BASIS = 'OffersV2.Listings.Price.SavingBasis';
    const OFFERS_V2LISTINGSPRICESAVING_BASISMONEY = 'OffersV2.Listings.Price.SavingBasis.Money';
    const OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE = 'OffersV2.Listings.Price.SavingBasis.SavingBasisType';
    const OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE_LABEL = 'OffersV2.Listings.Price.SavingBasis.SavingBasisTypeLabel';
    const OFFERS_V2LISTINGSPRICESAVINGS = 'OffersV2.Listings.Price.Savings';
    const OFFERS_V2LISTINGSPRICESAVINGSMONEY = 'OffersV2.Listings.Price.Savings.Money';
    const OFFERS_V2LISTINGSPRICESAVINGSPERCENTAGE = 'OffersV2.Listings.Price.Savings.Percentage';
    const OFFERS_V2LISTINGSTYPE = 'OffersV2.Listings.Type';
    const OFFERS_V2LISTINGSVIOLATES_MAP = 'OffersV2.Listings.ViolatesMAP';
    const PARENT_ASIN = 'ParentASIN';
    const RENTAL_OFFERSLISTINGSAVAILABILITYMAX_ORDER_QUANTITY = 'RentalOffers.Listings.Availability.MaxOrderQuantity';
    const RENTAL_OFFERSLISTINGSAVAILABILITYMESSAGE = 'RentalOffers.Listings.Availability.Message';
    const RENTAL_OFFERSLISTINGSAVAILABILITYMIN_ORDER_QUANTITY = 'RentalOffers.Listings.Availability.MinOrderQuantity';
    const RENTAL_OFFERSLISTINGSAVAILABILITYTYPE = 'RentalOffers.Listings.Availability.Type';
    const RENTAL_OFFERSLISTINGSBASE_PRICE = 'RentalOffers.Listings.BasePrice';
    const RENTAL_OFFERSLISTINGSCONDITION = 'RentalOffers.Listings.Condition';
    const RENTAL_OFFERSLISTINGSCONDITIONCONDITION_NOTE = 'RentalOffers.Listings.Condition.ConditionNote';
    const RENTAL_OFFERSLISTINGSCONDITIONSUB_CONDITION = 'RentalOffers.Listings.Condition.SubCondition';
    const RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_AMAZON_FULFILLED = 'RentalOffers.Listings.DeliveryInfo.IsAmazonFulfilled';
    const RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_FREE_SHIPPING_ELIGIBLE = 'RentalOffers.Listings.DeliveryInfo.IsFreeShippingEligible';
    const RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_PRIME_ELIGIBLE = 'RentalOffers.Listings.DeliveryInfo.IsPrimeEligible';
    const RENTAL_OFFERSLISTINGSDELIVERY_INFOSHIPPING_CHARGES = 'RentalOffers.Listings.DeliveryInfo.ShippingCharges';
    const RENTAL_OFFERSLISTINGSMERCHANT_INFO = 'RentalOffers.Listings.MerchantInfo';
    const SEARCH_REFINEMENTS = 'SearchRefinements';
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::BROWSE_NODE_INFOBROWSE_NODES,
            self::BROWSE_NODE_INFOBROWSE_NODESANCESTOR,
            self::BROWSE_NODE_INFOBROWSE_NODESSALES_RANK,
            self::BROWSE_NODE_INFOWEBSITE_SALES_RANK,
            self::CUSTOMER_REVIEWSCOUNT,
            self::CUSTOMER_REVIEWSSTAR_RATING,
            self::IMAGESPRIMARYSMALL,
            self::IMAGESPRIMARYMEDIUM,
            self::IMAGESPRIMARYLARGE,
            self::IMAGESVARIANTSSMALL,
            self::IMAGESVARIANTSMEDIUM,
            self::IMAGESVARIANTSLARGE,
            self::ITEM_INFOBY_LINE_INFO,
            self::ITEM_INFOCONTENT_INFO,
            self::ITEM_INFOCONTENT_RATING,
            self::ITEM_INFOCLASSIFICATIONS,
            self::ITEM_INFOEXTERNAL_IDS,
            self::ITEM_INFOFEATURES,
            self::ITEM_INFOMANUFACTURE_INFO,
            self::ITEM_INFOPRODUCT_INFO,
            self::ITEM_INFOTECHNICAL_INFO,
            self::ITEM_INFOTITLE,
            self::ITEM_INFOTRADE_IN_INFO,
            self::OFFERS_V2LISTINGSAVAILABILITY,
            self::OFFERS_V2LISTINGSAVAILABILITYMAX_ORDER_QUANTITY,
            self::OFFERS_V2LISTINGSAVAILABILITYMESSAGE,
            self::OFFERS_V2LISTINGSAVAILABILITYMIN_ORDER_QUANTITY,
            self::OFFERS_V2LISTINGSAVAILABILITYTYPE,
            self::OFFERS_V2LISTINGSCONDITION,
            self::OFFERS_V2LISTINGSCONDITIONCONDITION_NOTE,
            self::OFFERS_V2LISTINGSCONDITIONSUB_CONDITION,
            self::OFFERS_V2LISTINGSCONDITIONVALUE,
            self::OFFERS_V2LISTINGSDEAL_DETAILS,
            self::OFFERS_V2LISTINGSDEAL_DETAILSACCESS_TYPE,
            self::OFFERS_V2LISTINGSDEAL_DETAILSBADGE,
            self::OFFERS_V2LISTINGSDEAL_DETAILSEARLY_ACCESS_DURATION_IN_MILLISECONDS,
            self::OFFERS_V2LISTINGSDEAL_DETAILSEND_TIME,
            self::OFFERS_V2LISTINGSDEAL_DETAILSPERCENT_CLAIMED,
            self::OFFERS_V2LISTINGSDEAL_DETAILSSTART_TIME,
            self::OFFERS_V2LISTINGSIS_BUY_BOX_WINNER,
            self::OFFERS_V2LISTINGSLOYALTY_POINTS,
            self::OFFERS_V2LISTINGSLOYALTY_POINTSPOINTS,
            self::OFFERS_V2LISTINGSMERCHANT_INFO,
            self::OFFERS_V2LISTINGSMERCHANT_INFOID,
            self::OFFERS_V2LISTINGSMERCHANT_INFONAME,
            self::OFFERS_V2LISTINGSPRICE,
            self::OFFERS_V2LISTINGSPRICEMONEY,
            self::OFFERS_V2LISTINGSPRICEPRICE_PER_UNIT,
            self::OFFERS_V2LISTINGSPRICESAVING_BASIS,
            self::OFFERS_V2LISTINGSPRICESAVING_BASISMONEY,
            self::OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE,
            self::OFFERS_V2LISTINGSPRICESAVING_BASISSAVING_BASIS_TYPE_LABEL,
            self::OFFERS_V2LISTINGSPRICESAVINGS,
            self::OFFERS_V2LISTINGSPRICESAVINGSMONEY,
            self::OFFERS_V2LISTINGSPRICESAVINGSPERCENTAGE,
            self::OFFERS_V2LISTINGSTYPE,
            self::OFFERS_V2LISTINGSVIOLATES_MAP,
            self::PARENT_ASIN,
            self::RENTAL_OFFERSLISTINGSAVAILABILITYMAX_ORDER_QUANTITY,
            self::RENTAL_OFFERSLISTINGSAVAILABILITYMESSAGE,
            self::RENTAL_OFFERSLISTINGSAVAILABILITYMIN_ORDER_QUANTITY,
            self::RENTAL_OFFERSLISTINGSAVAILABILITYTYPE,
            self::RENTAL_OFFERSLISTINGSBASE_PRICE,
            self::RENTAL_OFFERSLISTINGSCONDITION,
            self::RENTAL_OFFERSLISTINGSCONDITIONCONDITION_NOTE,
            self::RENTAL_OFFERSLISTINGSCONDITIONSUB_CONDITION,
            self::RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_AMAZON_FULFILLED,
            self::RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_FREE_SHIPPING_ELIGIBLE,
            self::RENTAL_OFFERSLISTINGSDELIVERY_INFOIS_PRIME_ELIGIBLE,
            self::RENTAL_OFFERSLISTINGSDELIVERY_INFOSHIPPING_CHARGES,
            self::RENTAL_OFFERSLISTINGSMERCHANT_INFO,
            self::SEARCH_REFINEMENTS,
        ];
    }
}


