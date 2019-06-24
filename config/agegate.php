<?php

/**
 * Age Gate configuration file
 */

return [
    /**
     * Cookie Name
     * Title of cookie that you'll be seeing in 
     * dev tools and used for verifications
     */
    'cookie_name'       => 'age-gate',

    /**
     * Page URL
     * The page url users are redirected to submit
     * age validation form
     */
    'page_url'          => 'age-gate',

    /**
     * Form Type
     * There are 2 options for form fields.
     * 'year' - displays a single input as year validation
     * 'dob' - displays 3 inputs, day/month/year as date of birth validation
     */
    'form_type'         => 'year',
    
    /**
     * Cookie time
     * Number of days after cookie expires
     */
    'cookie_time'       => 1, //days

    /**
     * Cookie Time Extended
     * Number of days after cookie expires when using
     * remember me option
     */
    'cookie_time_extended' => 30,
    

    /**
     * Legal age
     * Interval of years considered as legal age
     * to access the protected routes
     */
    'legal_age'         => 18, // defaults to 18
    'maximum_age'       => 120, // defaults to 120
];