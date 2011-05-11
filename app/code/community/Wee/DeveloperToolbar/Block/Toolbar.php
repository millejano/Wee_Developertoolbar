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

class Cdb_DeveloperToolbar_Block_Toolbar extends Cdb_DeveloperToolbar_Block_Template
{
    protected $_items = array();
    
    protected $jsFiles = array(
        'developertoolbar/jquery-1.4.2.min.js',
        'developertoolbar/developertoolbar.js',
    );

    public function __construct()
    {
        $this->_addDefaultItems();  
    }
    
    protected function _addDefaultItems()
    {
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Version('version'));
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Info('info', 'info'));
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Profiler('profiler', 'profiler'));
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Time('time'));
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Memory('memory'));
        $this->_addItem(new Cdb_DeveloperToolbar_Block_Toolbar_Item_Database('database'));    
    }
    
    protected function _addItem(Cdb_DeveloperToolbar_Block_Toolbar_Item $item)
    {
        $this->_items[] = $item;    
    }
    
    protected function getItems()
    {
        return $this->_items;
    }
    
    protected function _prepareLayout()
    {
        foreach ($this->jsFiles as $file) {
            $this->getLayout()->getBlock('head')->addJs($file);    
        }
    }
}