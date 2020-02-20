# Store Reviews for Magento 2

    xvrmallafre/module-storereviews

## Requirements

 - PHP: 7.2.20~
 - Magento: 2.3.4~

`Only tested with versions shown above`

## Main Functionalities

This loyalty module provides new URLs to the frontend of the platform, that will allow the store to be reviewed, and see those reviews.
After X days (configurable value in backend), the customer which did a purchase in the store, and the status for the order is complete, will get an email with a custom link, that will redirect him to an URL to rate some aspects from that purchase.
The Magento administrator, will be allowed to hide or not, any of the reviews.


## Installation

### Via Composer:

 - Install the module composer by running `composer require xvrmallafre/module-store_reviews:1.0.0`
 - enable the module by running `php bin/magento module:enable Xvrmallafre_StoreReviews`
 - apply database updates by running `php bin/magento setup:upgrade`
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - STORES > CONFIGURATION > GENERAL > Store Reviews
    - GENERAL
         - Enables the module (xvrmallafre_storereviews/general/enabled)
         - Let the comment be available (xvrmallafre_storereviews/general/comments_enabled)
         - Days after purchase to send the email (xvrmallafre_storereviews/general/send_message_days)


## Specifications

 - Plugin
	- afterSave - Magento\Sales\Model\ResourceModel\Order > Xvrmallafre\StoreReviews\Plugin\OrderStatePlugin

 - Cronjob
	- xvrmallafre_storereviews_crontab: `0 */1 * * *`

 - Controller
	- frontend > reviews/index/index
	- frontend > reviews/review/index
	- frontend > reviews/review/save

 - Template
    - storereviews_create_review > This email will arrive to the user which creates the order.

