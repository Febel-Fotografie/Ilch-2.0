<?php
/**
 * @copyright Ilch 2.0
 * @package ilch
 */

namespace Modules\Statistic\Controllers;

use Modules\Statistic\Mappers\Statistic as StatisticMapper;

defined('ACCESS') or die('no direct access');

class Index extends \Ilch\Controller\Frontend
{
    public function indexAction()
    {
        $statisticMapper = new StatisticMapper();

        $this->getLayout()->getHmenu()->add($this->getTranslator()->trans('menuStatistic'), array('action' => 'index'));

        $date = new \Ilch\Date();
        $this->getView()->set('visitsToday', $statisticMapper->getVisitsCount($date->format('Y-m-d')));
        $this->getView()->set('visitsMonth', $statisticMapper->getVisitsMonthCount());
        $this->getView()->set('visitsYear', $statisticMapper->getVisitsYearCount());
        $this->getView()->set('visitsTotal', $statisticMapper->getVisitsCount());

        $this->getView()->set('statisticYearMonthDayList', $statisticMapper->getVisitsYearMonthDay());
        $this->getView()->set('statisticYearMonthList', $statisticMapper->getVisitsYearMonth());
        $this->getView()->set('statisticYearList', $statisticMapper->getVisitsYear());
        $this->getView()->set('statisticBrowserList', $statisticMapper->getVisitsBrowser());
        $this->getView()->set('statisticLanguageList', $statisticMapper->getVisitsLanguage($this->getTranslator()->getLocale()));
        $this->getView()->set('statisticOSList', $statisticMapper->getVisitsOS());
    }

    public function showAction()
    {
        $statisticMapper = new StatisticMapper();

        $month = $this->getRequest()->getParam('month');
        $year = $this->getRequest()->getParam('year');

        if ($year != '' AND $month != '') {
            $date = new \Ilch\Date($year.'-'.$month.'-01');

            $this->getLayout()->getHmenu()
                    ->add($this->getTranslator()->trans('menuStatistic'), array('action' => 'index'))
                    ->add($date->format('F', true), array('action' => 'show', 'year' => $year, 'month' => $month))
                    ->add($date->format('Y', true), array('action' => 'show', 'year' => $year));
        } elseif ($year != '') {
            $date = new \Ilch\Date($year.'-01-01');

            $this->getLayout()->getHmenu()
                    ->add($this->getTranslator()->trans('menuStatistic'), array('action' => 'index'))
                    ->add($date->format('Y', true), array('action' => 'show', 'year' => $year));        
        }

        if ($year != '' AND $month != '') {
            $this->getView()->set('visitsTotal', $statisticMapper->getVisitsMonthCount($year, $month));
            $this->getView()->set('statisticYearMonthDayList', $statisticMapper->getVisitsYearMonthDay($year, $month));
            $this->getView()->set('statisticYearList', $statisticMapper->getVisitsYear($year));
            $this->getView()->set('statisticBrowserList', $statisticMapper->getVisitsBrowser($year, $month));
            $this->getView()->set('statisticLanguageList', $statisticMapper->getVisitsLanguage($this->getTranslator()->getLocale(), $year, $month));
            $this->getView()->set('statisticOSList', $statisticMapper->getVisitsOS($year, $month));
        } elseif ($month == '' AND $year != '') {
            $this->getView()->set('visitsTotal', $statisticMapper->getVisitsCount($year));
            $this->getView()->set('statisticYearMonthList', $statisticMapper->getVisitsYearMonth($year));
            $this->getView()->set('statisticYearList', $statisticMapper->getVisitsYear($year));
            $this->getView()->set('statisticBrowserList', $statisticMapper->getVisitsBrowser($year));
            $this->getView()->set('statisticLanguageList', $statisticMapper->getVisitsLanguage($this->getTranslator()->getLocale(), $year));
            $this->getView()->set('statisticOSList', $statisticMapper->getVisitsOS($year));
        }
    }

    public function onlineAction()
    {
        $statisticMapper = new StatisticMapper();

        $this->getLayout()->getHmenu()
                ->add($this->getTranslator()->trans('menuStatistic'), array('action' => 'index'))
                ->add($this->getTranslator()->trans('menuOnline'), array('action' => 'online'));

        $this->getView()->set('userOnlineList', $statisticMapper->getVisitsOnline());
    }
}