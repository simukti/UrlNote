<?php
/**
 * Description of Tag
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Model_DbTable_Tag extends \Zend_Db_Table_Abstract
{
    protected $_name            = 'tag';
    protected $_rowClass        = 'Model_Row_Tag';
    protected $_rowsetClass     = 'Model_Rowset_Tag';
    protected $_dependentTables = array(
        'Model_DbTable_UrlTag'
    );
    
    public function findAllTags()
    {
        $select = $this->select()->order('name ASC');
        return $this->fetchAll($select);
    }
    
    public function findOneBySlug($slug)
    {
        $where = $this->select()->where('slug = ?', $slug);
        return $this->fetchRow($where);
    }
    
    public function findUrlByTagSlug($slug)
    {
        $where = $this->select()->where('slug = ?', $slug);
        $tag   = $this->fetchRow($where);
        if(! $tag) {
            return false;
        }
        return $tag->getUrl();
    }
}
