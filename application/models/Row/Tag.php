<?php
/**
 * Description of Tag
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Model_Row_Tag extends \Zend_Db_Table_Row_Abstract
{
    protected $url;
    
    public function getUrl()
    {
        if(!$this->url) {
            $this->url = $this->findManyToManyRowset('Model_DbTable_Url', 'Model_DbTable_UrlTag');
        }
        return $this->url;
    }
}
