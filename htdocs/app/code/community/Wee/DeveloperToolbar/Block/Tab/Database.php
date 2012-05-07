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
 * @category    Wee
 * @package     Wee_DeveloperToolbar
 * @author      Stefan Wieczorek <stefan.wieczorek@mgt-commerce.com>
 * @copyright   Copyright (c) 2011 (http://www.mgt-commerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Wee_DeveloperToolbar_Block_Tab_Database extends Wee_DeveloperToolbar_Block_Tab
{
    protected $_profiler;
    protected $_longestQueryTime = 0;
    protected $_longestQuery;
    
    public function __construct($name, $label)
    {
        parent::__construct($name, $label);
        $this->setTemplate('wee_developertoolbar/tab/database.phtml');
        $this->setIsActive(true);
        $this->_profiler = Mage::getSingleton('core/resource')->getConnection('core_write')->getProfiler();
    }
    
    public function getProfiler() {
       return $this->_profiler;
    }
    
    protected function _getLongestQuery()
    {
        foreach ($this->_profiler->getQueryProfiles() as $query) {
            if ($query->getElapsedSecs() > $this->_longestQueryTime) {
                $this->_longestQueryTime  = $query->getElapsedSecs();
                $this->_longestQuery = $query->getQuery();
            }
        }
    }
    
    public function getLongestQueryTime()
    {
        if (!$this->_longestQueryTime) {
           $this->_getLongestQuery();    
        }
        return $this->_longestQueryTime;
    }
    
    public function getLongestQuery()
    {
        if (!$this->_longestQuery) {
            $this->_getLongestQuery();
        }
        return $this->_longestQuery;
    }
}