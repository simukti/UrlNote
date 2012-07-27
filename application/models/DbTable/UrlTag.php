<?php
/**
 * Description of UrlTag
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
class Model_DbTable_UrlTag extends \Zend_Db_Table_Abstract
{
    protected $_name         = 'url_tag';
    protected $_referenceMap = array(
        'Url' => array(
            'columns' => 'url',
            'refTableClass' => 'Model_DbTable_Url',
            'refColumns' => 'id'
        ),
        'Tag' => array(
            'columns' => 'tag',
            'refTableClass' => 'Model_DbTable_Tag',
            'refColumns' => 'id'
        )
    );
}