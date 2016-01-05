<?php

class Vikont_ARIOEM_Controller_Router extends Mage_Core_Controller_Varien_Router_Standard
{

	/**
     * Match the request
     *
     * @param Zend_Controller_Request_Http $request
     * @return boolean
     */
    public function match(Zend_Controller_Request_Http $request)
    {
		if (!$this->_beforeModuleMatch()) {
			return false;
		}

		$front = $this->getFront();
        $path = trim($request->getPathInfo(), '/');
		$pathParts = explode('/', $path, 4);

		if(		isset($pathParts[0])
			&&	$pathParts[0] == Mage::getStoreConfig('arioem/parts/shortname')
		) {
			$request->setRouteName('arioem');
			$request->setModuleName('Vikont_ARIOEM');
			$request->setControllerModule('Vikont_ARIOEM');
			$request->setControllerName('parts');
			$request->setActionName('index');
			$request->setDispatched(true);

			$brand = empty($pathParts[1]) ? false : $pathParts[1];
			Mage::register('oem_brand', $brand);
			$request->setParam('brand', $brand);

			$partNumber = empty($pathParts[2]) ? false : $pathParts[2];
			Mage::register('oem_part_number', $partNumber);
			$request->setParam('partNumber', $partNumber);

			$controllerClassName = $this->_validateControllerClassName('Vikont_ARIOEM', 'parts');
			$controllerInstance = Mage::getControllerInstance($controllerClassName, $request, $front->getResponse());
			$controllerInstance->dispatch('index');

			return true;
		}

		return parent::match($request);
	}

}