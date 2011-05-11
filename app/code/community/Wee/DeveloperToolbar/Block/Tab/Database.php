<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category    Cdb
 * @package     Cdb_DeveloperToolbar
 * @author      Stefan Wieczorek <stefan.wieczorek@codingbitch.de>
 * @copyright   Copyright (c) 2010 (http://www.codingbitch.de)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Wee_DeveloperToolbar_Block_Tab_Database extends Wee_DeveloperToolbar_Block_Tab
{
    protected $_profiler;
    protected $longestQueryTime = 0;
    protected $longestQuery;
    
    public function __construct($name, $label)
    {
        parent::__construct($name, $label);
        $this->setTemplate('developertoolbar/tab/database.phtml');
        $this->setIsActive(true);
        $this->_profiler = Mage::getSingleton('core/resource')->getConnection('core_write')->getProfiler();
    }
    
    public function getProfiler() {
       return $this->_profiler;
    }
    
    protected function _getLongestQuery()
    {
        foreach ($this->_profiler->getQueryProfiles() as $query) {
            if ($query->getElapsedSecs() > $this->longestQueryTime) {
                $this->longestQueryTime  = $query->getElapsedSecs();
                $this->longestQuery = $query->getQuery();
            }    
        }
    }
    
    public function getLongestQueryTime()
    {
        if (!$this->longestQueryTime) {
           $this->_getLongestQuery();    
        }
        return $this->longestQueryTime;
    }
    
    public function getLongestQuery()
    {
        if (!$this->longestQuery) {
            $this->_getLongestQuery();
        }
        return $this->longestQuery;
    }
}