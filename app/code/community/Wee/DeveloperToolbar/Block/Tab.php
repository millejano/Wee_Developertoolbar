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

class Cdb_DeveloperToolbar_Block_Tab extends Cdb_DeveloperToolbar_Block_Template
{
    protected $name;
    protected $label;
    protected $isActive = false;

    public function __construct($name, $label)
    {
        parent::__construct();
        $this->name = $name;
        $this->label = $label;
    }
    
    public function isActive()
    {
        return $this->isActive;
    }
    
    public function setIsActive($flag)
    {
        $this->isActive = (bool)$flag;    
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
    
    public function render()
    {
        return $this->toHtml();
    }
}