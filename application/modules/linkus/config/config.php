<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Linkus\Config;

class Config extends \Ilch\Config\Install
{
    public $config = [
        'key' => 'linkus',
        'version' => '1.2.0',
        'icon_small' => 'fa-link',
        'author' => 'Veldscholten, Kevin',
        'link' => 'http://ilch.de',
        'languages' => [
            'de_DE' => [
                'name' => 'Link Us',
                'description' => 'Hier kann man Link Us verwalten.',
            ],
            'en_EN' => [
                'name' => 'Link Us',
                'description' => 'Here you can manage the link us.',
            ],
        ],
        'ilchCore' => '2.1.16',
        'phpVersion' => '5.6'
    ];

    public function install()
    {
        $this->db()->queryMulti($this->getInstallSql());

        $databaseConfig = new \Ilch\Config\Database($this->db());
        $databaseConfig->set('linkus_html', '1');
        $databaseConfig->set('linkus_bbcode', '1');
    }

    public function uninstall()
    {
        $this->db()->queryMulti('DROP TABLE `[prefix]_linkus`;');
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'linkus_html'");
        $this->db()->queryMulti("DELETE FROM `[prefix]_config` WHERE `key` = 'linkus_bbcode'");
    }

    public function getInstallSql()
    {
        return "CREATE TABLE IF NOT EXISTS `[prefix]_linkus` (
                  `id` INT(11) NOT NULL AUTO_INCREMENT,
                  `title` VARCHAR(100) NOT NULL,
                  `banner` VARCHAR(255) NOT NULL,
                  PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1";
    }

    public function getUpdate($installedVersion)
    {
        switch ($installedVersion) {
            case "1.0":
                // Convert table to new character set and collate
                $this->db()->query('ALTER TABLE `[prefix]_linkus` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;');
        }
    }
}
