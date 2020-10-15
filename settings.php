<?php
    define('CONFIG', [
        'API_KEY' => 'x5pE5EqPu1kP6xVmc3zJhMig8',
        'API_SECRET_KEY' => 'AdOicghgFGLRSYJrhHyvdg9yEFCfosr4XrN4LfDEyKLD55SgVB',
        'BEARER_TOKEN' => 'AAAAAAAAAAAAAAAAAAAAAJtcIgEAAAAA6oROgz4flyTkCEXz05yV9lYjTjM%3DBK2JHUnezX62NbZa1QFN7kSxH2jydqfglplHzRyY6GUIsTvk6s',
        'ACCESS_TOKEN' => '922239930-8aZyS6nJWR7cHRdXqFwCiQI1O9S2wDbDBS0l654N',
        'ACCESS_TOKEN_SECRET' => 'ywiQp5WUD3T95HC1DdlOp8dzfcxsRRsV2vGIu9PWtJoFl',
        'TAGS' => [
            0 => 'neutre',
            1 => 'positif',
            2 => 'negatif',
        ],
        'CARATERE' => 'avcdefghigklmnopqrstuvwxyz',
        'COUNTRIES' => array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"),
    ]);
    
    function generateRandomData(int $number) : array {
        $res = [];
        $curTime = time();
        for($i = 0; $i<$number; $i++) {
            $res[] = [
                'texte' => getTexte(),
                'age' => random_int(13, 75),
                'pays' => CONFIG['COUNTRIES'][random_int(0, count(CONFIG['COUNTRIES'])-1)],
                'datetime' => date('Y-m-d H:i:s', (($i % random_int(5, 10)) == 0)? $curTime-=1 : $curTime),
                'tag' => CONFIG['TAGS'][random_int(0, 2)],
            ];
        }
        
        return $res;
    }

    function generateRandomDataBySecond(int $second) {
        $res = [];
        $curTime = time();
        for($s = 0; $s < $second; $s++){
            for($i = 0; $i<random_int(5, 100); $i++) {
                $res[] = [
                    'texte' => getTexte(),
                    'age' => random_int(13, 75),
                    'pays' => CONFIG['COUNTRIES'][random_int(0, count(CONFIG['COUNTRIES'])-1)],
                    'datetime' => date('Y-m-d H:i:s', $curTime),
                    'tag' => CONFIG['TAGS'][random_int(0, 2)],
                ];
            }
            $curTime -= 1;
        }
        return $res;
    }

    function getTexte() {
        $texte = '';
        $textlen = random_int(20, 60);

        for($i=0;$i<$textlen;$i++) {
            $texte .= getMot(random_int(1, 5))." ";
        }
        return $texte;
    }

    function getMot(int $len) : string {
        $str = '';
        for($i=0;$i<$len;$i++) {
            $str .= CONFIG['CARATERE'][random_int(0, strlen(CONFIG['CARATERE'])-1)];
        }
        return $str;
    }
?>