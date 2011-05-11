<?php
class Wee_DeveloperToolbar_Model_Resource  extends Mage_Core_Model_Resource 
{
    public function getConnection($name)
    {
        if (isset($this->_connections[$name])) {
            return $this->_connections[$name];
        }
        $connConfig = Mage::getConfig()->getResourceConnectionConfig($name);
        if (!$connConfig) {
            $this->_connections[$name] = $this->_getDefaultConnection($name);
            return $this->_connections[$name];
        }
        if (!$connConfig->is('active', 1)) {
            return false;
        }
        $origName = $connConfig->getParent()->getName();

        if (isset($this->_connections[$origName])) {
            $this->_connections[$name] = $this->_connections[$origName];
            return $this->_connections[$origName];
        }

        $typeInstance = $this->getConnectionTypeInstance((string)$connConfig->type);
        $conn = $typeInstance->getConnection($connConfig);
        $conn->getProfiler()->setEnabled(true);
        if (method_exists($conn, 'setCacheAdapter')) {
            $conn->setCacheAdapter(Mage::app()->getCache());
        }

        $this->_connections[$name] = $conn;
        if ($origName!==$name) {
            $this->_connections[$origName] = $conn;
        }
        return $conn;
    } 	
}