<?php
/*
 * Copyright (c) 2022. Hafees Olasunkanmi OLATUNJI.
 * Email: aphzol@gmail.com
 * The entire source code of this project is an intellectual property of Hafees Olasunkanmi OLATUNJI
 * and his respective contributors as indicated in header of their respective files.
 * All libraries used in this project are intellectual properties of their respective authors
 * and their licence included where deemed fit.
 * All right reserved. No party has any right whatsoever to duplicate the content therein digitally
 * or otherwise without express written permission from the company.
 */

namespace aphzol\apis\driver;

use Curl\Curl;

class Braincert {
    public $api_key;
    public $apiendpoint = "https://api.braincert.com/v2";

    ##languages
    const LANGUAGE_ENGLISH = 11;

    ##locations

    /**
     * Intelligent routing to the nearest location
     */
    const LOCATION_INTELLIGENT = 0;
    /**
     * US East (Dallas, TX)
     */
    const LOCATION_US_EAST_DALLAS_TX = 1;
    /**
     * US East (New York)
     */
    const LOCATION_US_EAST_NEW_YORK = 3;
    /**
     * US East (Miami, FL)
     */
    const LOCATION_US_EAST_MIAMI_FL = 8;
    /**
     * US West (Los Angeles, CA)
     */
    const LOCATION_US_WEST_LOS_ANGELES_CA = 2;
    /**
     * Europe (Frankfurt, Germany)
     */
    const LOCATION_EUROPE_FRANKFURT_GERMANY = 4;
    /**
     * Europe (London)
     */
    const LOCATION_EUROPE_LONDON = 5;
    /**
     * Asia Pacific (Bangalore, India)
     */
    const LOCATION_ASIA_PACIFIC_BANGALORE_INDIA = 6;
    /**
     * Asia Pacific (Singapore)
     */
    const LOCATION_ASIA_PACIFIC_SINGAPORE = 7;
    /**
     * Asia Pacific (Hong Kong, China)
     */
    const LOCATION_ASIA_PACIFIC_HONG_KONG_CHINA = 14;
    /**
     * Middle East (Bahrain)
     */
    const LOCATION_MIDDLE_EAST_BAHRAIN = 11;

    ##Repeat List

    /**
     * Daily (all 7 days)
     */
    const REAPEAT_DAILY = 1;

    /**
     * 6 Days(Mon-Sat)
     */
    const REAPEAT_MONDAY_TO_SATURDAY = 2;

    /**
     * 5 Days(Mon-Fri)
     */
    const REAPEAT_MONDAY_TO_FRIDAY = 3;

    /**
     * Weekly
     */
    const REAPEAT_WEEKLY = 4;

    /**
     * Once every month
     */
    const REAPEAT_MONTHLY = 5;

    /**
     * On selected days
     */
    const REAPEAT_SELECTED_DAY = 6;

    ##Days Definition

    /**
     * Sunday
     */
    const DAY_SUNDAY = 1;

    /**
     * Monday
     */
    const DAY_MONDAY = 2;

    /**
     * Tuesday
     */
    const DAY_TUESDAY = 3;

    /**
     * Wednesday
     */
    const DAY_WEDNESDAY = 4;

    /**
     * Thursday
     */
    const DAY_THURSDAY = 5;

    /**
     * Friday
     */
    const DAY_FRIDAY = 6;

    /**
     * Saturday
     */
    const DAY_SATURDAY = 6;

    ##Timezone list

    /**
     * (GMT+01:00) West Central Africa
     */
    const TIMEZONE_PLUS_01_WEST_CENTRAL_AFRICA = 71;

    ##Currency list

    const CURRENCY_AUD = 'AUD';
    const CURRENCY_CAD = 'CAD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_GBP = 'GBP';
    const CURRENCY_NZD = 'NZD';
    const CURRENCY_USD = 'USD';



    public function __construct($api_key) {
        $this->api_key = $api_key;
    }

    public function getClassData($data = array()) {
        $data['task'] = 'getclass';
        return $this->sendHttpRequest($data);
    }

    /**
     * @param $data
     * @return false|object
     */
    public function createClass($data = array()) {
        $data['weekdays'] = implode(',', $data['weekdays']);

        if ($data['record'] == '1' && $data['start_recording_auto'] == '2') {
            $data['record'] = '2';
        }

        if ($data['allow_change_interface_language'] == 0) {
            $data['isLang'] = $data['language'];
        } else {
            $data['isLang'] = 11;
        }


        if ($data['location_id']) {
            $data['isRegion'] = $data['location_id'];
        }

        if ($data['location']) {
            $data['isRegion'] = $data['location'];
        }

        $data['isBoard'] = $data['classroom_type'];

        unset($data['location_id']);
        unset($data['location']);
        unset($data['start_recording_auto']);
        unset($data['allow_change_interface_language']);
        unset($data['classroom_type']);
        unset($data['language']);

        $data['task'] = 'schedule';
        return $this->sendHttpRequest($data);
    }

    public function getClassList($data = array()) {
        if ($data['class_id']) {
            $data['task'] = 'getclass';
        } else {
            $data['task'] = 'listclass';
        }

        return $this->sendHttpRequest($data);
    }

    public function getPrice($data = array()) {
        $data['task'] = 'addSchemes';
        return $this->sendHttpRequest($data);
    }

    public function getDiscount($data = array()) {
        $data['task'] = 'addSpecials';
        return $this->sendHttpRequest($data);
    }

    public function listDiscount($data = array()) {
        $data['task'] = 'listdiscount';
        return $this->sendHttpRequest($data);
    }

    public function listPrices($data = array()) {

        $data['task'] = 'listSchemes';
        return $this->sendHttpRequest($data);
    }

    public function getClassRecording($data = array()) {
        $data['task'] = 'getclassrecording';
        return $this->sendHttpRequest($data);
    }

    public function removeClassRecording($data = array()) {
        $data['task'] = 'removeclassrecording';
        return $this->sendHttpRequest($data);
    }

    public function changeStatusRecording($data = array()) {
        $data['task'] = 'changestatusrecording';

        return $this->sendHttpRequest($data);
    }

    public function removeDiscount($data = array()) {
        $data['task'] = 'removediscount';
        return $this->sendHttpRequest($data);
    }

    public function removePrice($data = array()) {
        $data['task'] = 'removeprice';
        return $this->sendHttpRequest($data);
    }

    public function getLaunchURL($data = array()) {
        $data['userId'] = rand();
        $data['task'] = 'getclasslaunch';
        return $this->sendHttpRequest($data);
    }

    public function getClassReport($data = array()) {
        $data['task'] = 'getclassreport';
        return $this->sendHttpRequest($data);
    }

    public function removeClass($data = array()) {
        $data['task'] = 'removeclass';
        return $this->sendHttpRequest($data);
    }

    public function getRecording($data = array()) {
        $data['task'] = 'getrecording';
        return $this->sendHttpRequest($data);
    }

    private function sendHttpRequest($data) {
        global $_debugging;
        $data['apikey'] = $this->api_key;
        $this->apiendpoint = $this->apiendpoint."/".$data['task'];
        $curl = new Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, true);
        $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
        $curl->setOpt( CURLOPT_MAXREDIRS, 10);
        $curl->setOpt( CURLOPT_TIMEOUT, 300);
        $curl->setOpt( CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $curl->post($this->apiendpoint, $data);
        if($curl->error){
            if ($_debugging) {
                echo "\$error = $curl->error" . br();
            }
            return false;
        }
        $result = $curl->response;
        if ($_debugging) {
            dumpVarsDebug('$result = ', $result);
            echo "\$result = $result" . br();
        }
        return json_decode($result);
    }
}
