<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Birthday\Config;

class Config extends \Ilch\Config\Install
{
    public $config = [
        'key' => 'birthday',
        'version' => '1.3.0',
        'icon_small' => 'fa-birthday-cake',
        'author' => 'Veldscholten, Kevin',
        'link' => 'http://ilch.de',
        'languages' => [
            'de_DE' => [
                'name' => 'Geburtstag',
                'description' => 'Hier kannst du die Geburtstags-Box verwalten.',
            ],
            'en_EN' => [
                'name' => 'Birthday',
                'description' => 'Here you can manage the birthday-box.',
            ],
        ],
        'boxes' => [
            'birthday' => [
                'de_DE' => [
                    'name' => 'Geburtstag'
                ],
                'en_EN' => [
                    'name' => 'Birthday'
                ]
            ]
        ],
        'ilchCore' => '2.1.16',
        'phpVersion' => '5.6'
    ];

    public function install()
    {
        $databaseConfig = new \Ilch\Config\Database($this->db());
        $databaseConfig->set('bday_boxShow', '5');

        if ($this->db()->ifTableExists('[prefix]_calendar_events')) {
            $this->db()->queryMulti("INSERT INTO `[prefix]_calendar_events` (`url`) VALUES ('birthday/birthdays/index/');");
        }
    }

    public function uninstall()
    {
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'bday_boxShow'");

        if ($this->db()->ifTableExists('[prefix]_calendar_events')) {
            $this->db()->queryMulti("DELETE FROM `[prefix]_calendar_events` WHERE `url` = 'birthday/birthdays/index/';");
        }
    }

    public function getUpdate($installedVersion)
    {

    }
}
