<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Admin\Mappers;

use Modules\Admin\Models\Page as PageModel;

class Page extends \Ilch\Mapper
{
    /**
     * Get page lists for overview.
     *
     * @param string $locale
     * @return PageModel[]|array
     */
    public function getPageList($locale = '')
    {
        $sql = 'SELECT pc.title, pc.perma, p.id FROM `[prefix]_pages` as p
                LEFT JOIN `[prefix]_pages_content` as pc ON p.id = pc.page_id
                    AND pc.locale = "'.$this->db()->escape($locale).'"
                GROUP BY p.id, pc.title, pc.perma';
        $pageArray = $this->db()->queryArray($sql);

        if (empty($pageArray)) {
            return [];
        }

        $pages = [];
        foreach ($pageArray as $pageRow) {
            $pageModel = new PageModel();
            $pageModel->setId($pageRow['id']);
            $pageModel->setTitle($pageRow['title']);
            $pageModel->setPerma($pageRow['perma']);
            $pages[] = $pageModel;
        }

        return $pages;
    }

    /**
     * Returns page model found by the key.
     *
     * @param string $id
     * @param string $locale
     * @return PageModel|null
     */
    public function getPageByIdLocale($id, $locale = '')
    {
        $sql = 'SELECT * FROM [prefix]_pages as p
                INNER JOIN [prefix]_pages_content as pc ON p.id = pc.page_id
                WHERE p.`id` = "'.(int) $id.'" AND pc.locale = "'.$this->db()->escape($locale).'"';
        $pageRow = $this->db()->queryRow($sql);

        if (empty($pageRow)) {
            return null;
        }

        $pageModel = new PageModel();
        $pageModel->setId($pageRow['id']);
        $pageModel->setDescription($pageRow['description']);
        $pageModel->setKeywords($pageRow['keywords']);
        $pageModel->setTitle($pageRow['title']);
        $pageModel->setContent($pageRow['content']);
        $pageModel->setLocale($pageRow['locale']);
        $pageModel->setPerma($pageRow['perma']);

        return $pageModel;
    }

    /**
     * Returns all page permas.
     *
     * @return array|null
     */
    public function getPagePermas()
    {
        $sql = 'SELECT page_id, locale, perma FROM `[prefix]_pages_content`';
        $permas = $this->db()->queryArray($sql);
        $permaArray = [];

        if (empty($permas)) {
            return null;
        }

        foreach ($permas as $perma) {
            $permaArray[$perma['perma']] = $perma;
        }

        return $permaArray;
    }

    /**
     * Inserts or updates a page model in the database.
     *
     * @param PageModel $page
     * @return int
     */
    public function save(PageModel $page)
    {
        if ($page->getId()) {
            if ($this->getPageByIdLocale($page->getId(), $page->getLocale())) {
                $this->db()->update('pages_content')
                    ->values([
                        'title' => $page->getTitle(),
                        'description' => $page->getDescription(),
                        'keywords' => $page->getKeywords(),
                        'content' => $page->getContent(),
                        'perma' => $page->getPerma()
                    ])
                    ->where([
                        'page_id' => $page->getId(),
                        'locale' => $page->getLocale()
                    ])
                    ->execute();
            } else {
                $this->db()->insert('pages_content')
                    ->values([
                        'page_id' => $page->getId(),
                        'description' => $page->getDescription(),
                        'keywords' => $page->getKeywords(),
                        'title' => $page->getTitle(),
                        'content' => $page->getContent(),
                        'perma' => $page->getPerma(),
                        'locale' => $page->getLocale()
                    ])
                    ->execute();
            }
            return $page->getId();
        } else {
            $date = new \Ilch\Date();
            $pageId = $this->db()->insert('pages')
                ->values(['date_created' => $date->toDb()])
                ->execute();

            $this->db()->insert('pages_content')
                ->values([
                    'page_id' => $pageId,
                    'description' => $page->getDescription(),
                    'keywords' => $page->getKeywords(),
                    'title' => $page->getTitle(),
                    'content' => $page->getContent(),
                    'perma' => $page->getPerma(),
                    'locale' => $page->getLocale()
                ])
                ->execute();
            return $pageId;
        }
    }

    public function delete($id)
    {
        $this->db()->delete('pages')
            ->where(['id' => $id])
            ->execute();
        
        $this->db()->delete('pages_content')
            ->where(['page_id' => $id])
            ->execute();
    }
}
