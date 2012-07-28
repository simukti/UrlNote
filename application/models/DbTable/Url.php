<?php
/**
 * Description of Url
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
use Simukti\Utility\Sluggify;
use \Service_Container as Container;

class Model_DbTable_Url extends \Zend_Db_Table_Abstract
{
    protected $_name            = 'url';
    protected $_rowClass        = 'Model_Row_Url';
    protected $_dependentTables = array(
        'Model_DbTable_UrlTag'
    );
    
    public function findAllRecentUrl()
    {
        $select = $this->select()->order('createdAt DESC');
        return $this->fetchAll($select);
    }
    
    public function saveUrl(array $data)
    {
        $formData = array(
            'title' => ucwords($data['title']),
            'slug'  => Sluggify::create($data['title']),
            'url'   => $data['url'],
            'note'  => $data['note'],
        );
        
        if(! isset($data['id'])) {
            $this->insert($formData);
            $urlId  = $this->getAdapter()->lastInsertId();
        } else {
            $this->update($formData, array('id = ?' => $data['id']));
            $urlId  = $data['id'];
        }
        
        $tags = preg_split("/[,]+/", $data['tags']);
        Container::get('table.tag')->updateTags($urlId, $tags);
        
        return $urlId;
    }
    
    public function deleteUrl(\Model_Row_Url $url)
    {
        // delete urlTag first
        if(count($url->getTag()->toArray()) > 0) {
            Container::get('table.urlTag')->deleteUrlTag($url->id);
        }
        $delete = $this->delete('id = ' . $url->id);
        return $delete;
    }
}
