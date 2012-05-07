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

class Wee_DeveloperToolbar_Block_Template extends Mage_Core_Block_Template
{
   public function fetchView($fileName)
    {
        Varien_Profiler::start($fileName);

        extract ($this->_viewVars);
        $do = $this->getDirectOutput();

        if (!$do) {
            ob_start();
        }

        try {
            include $this->_viewDir . DS . $fileName;
        } catch (Exception $e) {
            ob_get_clean();
            throw $e;
        }


        if (!$do) {
            $html = ob_get_clean();
        } else {
            $html = '';
        }
        Varien_Profiler::stop($fileName);
        return $html;
    }
}