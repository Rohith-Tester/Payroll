<?php

return [

    'name' => env('COMPANY_NAME', 'Magneto Dynamics'),
    
    'director' => env('DIRECTOR' , 'Suresh Kumar') ,
    /*
    | Short brand for letterhead (e.g. logo strip text)
    */
    'short_brand' => env('COMPANY_SHORT_BRAND', 'Magneto Dynamics'),

    'address_line1' => env('COMPANY_ADDRESS_LINE1', 'Plot No 7-8-9, Venkateswara Nagar, Perungudi'),

    'address_line2' => env('COMPANY_ADDRESS_LINE2', 'Chennai, Tamil Nadu 600096'),

    'phone' => env('COMPANY_PHONE', '+91 00000 00000'),

    'email' => env('COMPANY_EMAIL', 'hr@company.com'),

    'website' => env('COMPANY_WEBSITE', 'www.company.com'),

    /*
    | Optional: public path to logo for print headers, e.g. /images/logo.png
    */
    'logo_path' => env('COMPANY_LOGO_PATH', 'images/magdyn.png'),

    /*
    | Single-line footer for offer letter pages (optional override)
    */
    'footer_address' => env('COMPANY_FOOTER_ADDRESS', null),

    'signatory_name' => env('COMPANY_SIGNATORY_NAME', 'Authorized Signatory'),

];
