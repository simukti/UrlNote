<?php
/**
 * Description of Container
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
use Pimple;
use \Zend_Paginator as Paginator;
use \Zend_Paginator_Adapter_Iterator as IteratorAdapter;
use \Model_DbTable_Url as UrlTable;
use \Model_DbTable_Tag as TagTable;
use \Model_DbTable_UrlTag as UrlTagTable;
use \Form_Url as UrlForm;

/**
 * Urlnote base application container
 */
class Service_Container
{
    /**
     * @var Pimple
     */
    static protected $container;
    
    /**
     * @return  Pimple
     */
    static public function getContainer()
    {
        self::$container = new Pimple;
        self::_initProtectedServices();
        self::_initSharedServices();
        return self::$container;
    }
    
    /**
     * @param   string $key
     * @return  mixed
     */
    static public function get($key)
    {
        $container = self::getContainer();
        return $container[$key];
    }
    
    /**
     * @return  array
     */
    static public function getServiceList()
    {
        return self::$container->keys();
    }
    
    static protected function _initProtectedServices()
    {
        self::$container['paginator'] = self::$container->protect(function($adapter) {
            return new Paginator($adapter);
        });
        self::$container['paginator.adapter.iterator'] = self::$container->protect(function($data) {
            return new IteratorAdapter($data);
        });
    }
    
    static protected function _initSharedServices()
    {
        self::$container['table.url'] = self::$container->share(function() {
            return new UrlTable;
        });
        
        self::$container['table.tag'] = self::$container->share(function() {
            return new TagTable;
        });
        
        self::$container['table.urlTag'] = self::$container->share(function() {
            return new UrlTagTable;
        });
        
        self::$container['form.url'] = self::$container->share(function() {
            return new UrlForm;
        });
    }
}
