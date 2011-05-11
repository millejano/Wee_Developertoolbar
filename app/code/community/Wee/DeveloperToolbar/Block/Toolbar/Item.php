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

class Cdb_DeveloperToolbar_Block_Toolbar_Item extends Cdb_DeveloperToolbar_Block_Template
{
    protected $name;
    protected $content;
    protected $label;
    protected $icon;
    
    public function __construct($name, $label = '')
    {
        parent::__construct();
        $this->name = $name;
        if ($label) {
            $this->label = $label;
        }
        if (!$this->hasData('template')) {
            $this->setTemplate('developertoolbar/item.phtml');
        }
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getLabel()
    {
        return $this->label;
    }
    
    public function setLabel($label)
    {
        $this->label = $label;
    }
    
    public function getIcon()
    {
        return $this->icon;
    }
    
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }
 
    public function getContent()
    {
        return $this->content;
    }
    
    public function setContent(Mage_Core_Block_Abstract $content)
    {
        $this->content = $content;
    }
    
    public function renderContent()
    {
    	return $this->content->toHtml();
    }
    
    public function render()
    {
    	return $this->toHtml();
    }
    
}