<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initNamespace()
    {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath'  => APPLICATION_PATH
        ));
        return $moduleLoader;
    }
    
    protected function _initRoute()
    {
        $router = $this->getPluginResource('router')->getRouter();
        $router->removeDefaultRoutes();
        return $router;
    }
}