<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Statistic\Plugins;

class LanguageCodes
{
    public function statisticLanguage($language, $locale)
    {
        $languageDEArray = [
            'aa' => 'Fern',
            'ab' => 'Abchasen',
            'af' => 'Afrikaans',
            'am' => 'Amharisch',
            'ar' => 'Arabisch',
            'as' => 'Assamese',
            'ay' => 'Aymara',
            'az' => 'Azerbaijani',
            'ba' => 'Baschkirisch',
            'be' => 'Weißrussisch',
            'bg' => 'Bulgarisch',
            'bh' => 'Bihari',
            'bi' => 'Bislama',
            'bn' => 'Bengali',
            'bo' => 'Tibetan',
            'br' => 'Bretonisch',
            'ca' => 'Katalanisch',
            'co' => 'Korsischen',
            'cs' => 'Tschechisch',
            'cy' => 'Welch',
            'da' => 'Dänisch',
            'de' => 'Deutsch',
            'dz' => 'Bhutani',
            'el' => 'Griechisch',
            'en' => 'Englisch',
            'eo' => 'Esperanto',
            'es' => 'Spanisch',
            'et' => 'Estnisch',
            'eu' => 'Baske',
            'fa' => 'Persisch',
            'fi' => 'Finnisch',
            'fj' => 'Fiji',
            'fo' => 'Färöer',
            'fr' => 'Französisch',
            'fy' => 'Friesisch',
            'ga' => 'Irish',
            'gd' => 'Scots Gaelic',
            'gl' => 'Galizisch',
            'gn' => 'Guarani',
            'gu' => 'Gujarati',
            'ha' => 'Hausa',
            'hi' => 'Hindi',
            'he' => 'Hebräisch',
            'hr' => 'Kroatisch',
            'hu' => 'Ungarisch',
            'hy' => 'Armenisch',
            'ia' => 'Interlingua',
            'id' => 'Indonesier',
            'ie' => 'Interlingue',
            'ik' => 'Inupiak',
            'in' => 'eh. Indonesische',
            'is' => 'Isländisch',
            'it' => 'Italienisch',
            'iu' => 'Inuktitut',
            'iw' => 'eh. Hebrew',
            'ja' => 'Japanisch',
            'ji' => 'eh. Yiddish',
            'jw' => 'Javaner',
            'ka' => 'Georgian',
            'kk' => 'Kasachisch',
            'kl' => 'Grönländisch',
            'km' => 'Cambodian',
            'kn' => 'Kannada',
            'ko' => 'Koreanisch',
            'ks' => 'Kashmiri',
            'ku' => 'Kurdisch',
            'ky' => 'Kirgisen',
            'la' => 'Latein',
            'ln' => 'Lingála',
            'lo' => 'Laotisch',
            'lt' => 'Litauisch',
            'lv' => 'Lettisch',
            'mg' => 'Malagasy',
            'mi' => 'Maori',
            'mk' => 'Macedonian',
            'ml' => 'Malayalam',
            'mn' => 'Mongolisch',
            'mo' => 'Moldavian',
            'mr' => 'Marathi',
            'ms' => 'Malay',
            'mt' => 'Maltesisch',
            'my' => 'Burmese',
            'na' => 'Nauru',
            'ne' => 'Nepali',
            'nl' => 'Holländisch',
            'no' => 'Norwegisch',
            'oc' => 'Okzitanisch',
            'om' => 'Oromo',
            'or' => 'Oriya',
            'pa' => 'Panjabi',
            'pl' => 'Polnisch',
            'ps' => 'Pashto, Pushto',
            'pt' => 'Portugiesisch',
            'qu' => 'Quechua',
            'rm' => 'Rätoromanisch',
            'rn' => 'Kirundi',
            'ro' => 'Rumänisch',
            'ru' => 'Russisch',
            'rw' => 'Kinyarwanda',
            'sa' => 'Sanskrit',
            'sd' => 'Sindhi',
            'sg' => 'Sangro',
            'sh' => 'Serbo-Kroatisch',
            'si' => 'Singhalesisch',
            'sk' => 'Slowakisch',
            'sl' => 'Slowenisch',
            'sm' => 'Samoaner',
            'sn' => 'Shona',
            'so' => 'Somali',
            'sq' => 'Albanisch',
            'sr' => 'Serbisch',
            'ss' => 'Siswati',
            'st' => 'Sotho',
            'su' => 'Sudanese',
            'sv' => 'Schwedisch',
            'sw' => 'Swahili',
            'ta' => 'Tamilisch',
            'te' => 'Tegulu',
            'tg' => 'Tajik',
            'th' => 'Thailändisch',
            'ti' => 'Tigrinya',
            'tk' => 'Turkmenen',
            'tl' => 'Tagalog',
            'tn' => 'Setswana',
            'to' => 'Tonga',
            'tr' => 'Türkisch',
            'ts' => 'Tsonga',
            'tt' => 'Tatar',
            'tw' => 'Twi',
            'ug' => 'Uiguren',
            'uk' => 'Ukrainisch',
            'ur' => 'Urdu',
            'uz' => 'Usbekisch',
            'vi' => 'Vietnamesisch',
            'vo' => 'Volapuk',
            'wo' => 'Wolof',
            'xh' => 'Xhosa',
            'yi' => 'Jiddisch',
            'yo' => 'Yoruba',
            'za' => 'Zhuang',
            'zh' => 'Chinesisch',
            'zu' => 'Zulu',
            'zu' => 'Zulu',
            '' => '',
        ];

        $languageENArray = [
            'aa' => 'Afar',
            'ab' => 'Abkhaz',
            'af' => 'Afrikaans',
            'am' => 'Amharic',
            'ar' => 'Arabic',
            'as' => 'Assamese',
            'ay' => 'Aymara',
            'az' => 'Azerbaijani',
            'ba' => 'Bashkir',
            'be' => 'Belarusian',
            'bg' => 'Bulgarian',
            'bh' => 'Bihari',
            'bi' => 'Bislama',
            'bn' => 'Bengali',
            'bo' => 'Tibetan',
            'br' => 'Breton',
            'ca' => 'Corsican',
            'co' => 'Corsican',
            'cs' => 'Czech',
            'cy' => 'Welsh',
            'da' => 'Danish',
            'de' => 'German',
            'dz' => 'Dzongkha',
            'el' => 'Greek',
            'en' => 'English',
            'eo' => 'Esperanto',
            'es' => 'Spanish',
            'et' => 'Estonian',
            'eu' => 'Basque',
            'fa' => 'Persian',
            'fi' => 'Finnish',
            'fj' => 'Fiji',
            'fo' => 'Faroese',
            'fr' => 'French',
            'fy' => 'Frisian',
            'ga' => 'Irish',
            'gd' => 'Scots Gaelic',
            'gl' => 'Galician',
            'gn' => 'Guarani',
            'gu' => 'Gujarati',
            'ha' => 'Hausa',
            'hi' => 'Hindi',
            'he' => 'Hebrew',
            'hr' => 'Croatian',
            'hu' => 'Hungarian',
            'hy' => 'Armenian',
            'ia' => 'Interlingua',
            'id' => 'Indonesian',
            'ie' => 'Interlingue',
            'ik' => 'Inupiaq',
            'in' => 'former Indonesian',
            'is' => 'Icelandic',
            'it' => 'Italian',
            'iu' => 'Inuktitut',
            'iw' => 'former Hebrew',
            'ja' => 'Japanese',
            'ji' => 'former Yiddish',
            'jw' => 'Javanese',
            'ka' => 'Georgian',
            'kk' => 'Kazakh',
            'kl' => 'Greenlandic',
            'km' => 'Cambodian',
            'kn' => 'Kannada',
            'ko' => 'Korean',
            'ks' => 'Kashmiri',
            'ku' => 'Kurdish',
            'ky' => 'Kirghiz',
            'la' => 'Latin',
            'ln' => 'Lingala',
            'lo' => 'Laothian',
            'lt' => 'Lithuanian',
            'lv' => 'Latvian, Lettish',
            'mg' => 'Malagasy',
            'mi' => 'Maori',
            'mk' => 'Macedonian',
            'ml' => 'Malayalam',
            'mn' => 'Mongolian',
            'mo' => 'Moldavian',
            'mr' => 'Marathi',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'my' => 'Burmese',
            'na' => 'Nauru',
            'ne' => 'Nepali',
            'nl' => 'Dutch',
            'no' => 'Norwegian',
            'oc' => 'Occitan',
            'om' => 'Oromo',
            'or' => 'Oriya',
            'pa' => 'Punjabi',
            'pl' => 'Polish',
            'ps' => 'Pashto, Pushto',
            'pt' => 'Portuguese',
            'qu' => 'Quechua',
            'rm' => 'Rhaeto-Romance',
            'rn' => 'Kirundi',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'rw' => 'Kinyarwanda',
            'sa' => 'Sanskrit',
            'sd' => 'Sindhi',
            'sg' => 'Sango',
            'sh' => 'Serbo-Croatian',
            'si' => 'Singhalese',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'sm' => 'Samoan',
            'sn' => 'Shona',
            'so' => 'Somali',
            'sq' => 'Albanian',
            'sr' => 'Serbian',
            'ss' => 'Swati',
            'st' => 'Sesotho',
            'su' => 'Sudanese',
            'sv' => 'Swedish',
            'sw' => 'Swahili',
            'ta' => 'Tamil',
            'te' => 'Tegulu',
            'tg' => 'Tajik',
            'th' => 'Thai',
            'ti' => 'Tigrinya',
            'tk' => 'Turkmen',
            'tl' => 'Tagalog',
            'tn' => 'Setswana',
            'to' => 'Tonga',
            'tr' => 'Turkish',
            'ts' => 'Tsonga',
            'tt' => 'Tatar',
            'tw' => 'Twi',
            'ug' => 'Uighur',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'uz' => 'Uzbek',
            'vi' => 'Vietnamese',
            'vo' => 'Volapuk',
            'wo' => 'Wolof',
            'xh' => 'Xhosa',
            'yi' => 'Yiddish',
            'yo' => 'Yoruba',
            'za' => 'Zhuang',
            'zh' => 'Chinese',
            'zu' => 'Zulu',
        ]; 

        if ($locale == 'de_DE') {
            $language = $languageDEArray[$language];
        } else {
            $language = $languageENArray[$language];
        }

        return $language;
    }
}
