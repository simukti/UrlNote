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
    
    public function insertUrl(array $data)
    {
        $url = $this->insert(array(
            'title' => ucwords($data['title']),
            'slug'  => Sluggify::create($data['title']),
            'url'   => $data['url'],
            'note'  => $data['note'],
        ));
        
        $c    = Container::getContainer();
        $tags = preg_split("/[,]+/", $data['tags']);
        
        foreach($tags as $value) {
            $tagsData = array();
            $name     = trim($value);
            $slug     = Sluggify::create($value);
            
            $tagsData['name'] = trim($name);
            $tagsData['slug'] = $slug;
            
            $tagExists = $c['table.tag']->findOneBySlug($slug);
            
            if(! $tagExists) {
                $tag = $c['table.tag']->insert($tagsData);
            } else {
                $tag = $tagExists['id'];
            }
            
            $c['table.urlTag']->insert(array(
                'url' => $url,
                'tag' => $tag
            ));
        }
        
        return $url;
    }
}
