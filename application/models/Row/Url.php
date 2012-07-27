<?php
/**
 * Description of Url
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Model_Row_Url extends \Zend_Db_Table_Row_Abstract
{
    protected $tag;
    
    public function getTag()
    {
        if(!$this->tag) {
            $this->tag = $this->findManyToManyRowset('Model_DbTable_Tag', 'Model_DbTable_UrlTag');
        }
        return $this->tag;
    }
}
