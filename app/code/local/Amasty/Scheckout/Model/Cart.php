<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) 2015 Amasty (https://www.amasty.com)
 * @package Amasty_Scheckout
 */

    class Amasty_Scheckout_Model_Cart extends Mage_Checkout_Model_Cart {
        public function init()
        {
            $initCheckout = $this->getCheckoutSession()->getCheckoutState() !== Mage_Checkout_Model_Session::CHECKOUT_STATE_BEGIN;
            $ret = parent::init();

            if ($initCheckout){
                $this->initAmscheckout();
            }
            

            return $ret;
        }

        function initAmscheckout(){
//            $initShipping = Mage::getSingleton('core/session')->getAmscheckoutInit(1) != 1;
//
//            if ($initShipping) {
               $this->_initBilling();
                $this->_initShipping();
                

//                Mage::getSingleton('core/session')->setAmscheckoutInit(1);
//            }
        }

        protected function _initBilling(){
            $quote = $this->getQuote();

            $address = $quote->getBillingAddress();

            if ($address) {
                $this->_initAddress($address);
            }
        }

        protected function _initShipping(){
            $quote = $this->getQuote();

            $address = $quote->getShippingAddress();

            if ($address) {
                $hlr = Mage::helper("amscheckout");

                $this->_initAddress($address);

                $address->setCollectShippingRates(true);

                try{
                    $payment = $quote->getPayment();
                    $payment->importData(array("method" => $hlr->getDefaultPeymentMethod($quote)));
                } catch (Exception $e){

                }

                $address->setShippingMethod($hlr->getDefaultShippingMethod($quote));

                $quote->setTotalsCollectedFlag(false);
                $quote->collectTotals();
                $quote->save();
            }
        }

        protected function _initAddress($address){
            $hlr = Mage::helper("amscheckout");

                $countryId = $hlr->getDefaultCountry();

                $city = $hlr->getDefaultCity();

                $postcode = $hlr->getDefaultPostcode();

                if ($countryId) {
                    $address->setCountryId($countryId);
                }

                if ($city){
                    $address->setCity($city);
                }

                if ($postcode){
                    $address->setPostcode($postcode);
                }
                }

    }
?>