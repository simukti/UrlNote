<?php
/**
 * Description of GetJquery
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
use \Zend_View_Helper_Abstract as HelperAbstract;

class View_Helper_GetJquery extends HelperAbstract
{
    public function getJquery()
    {
        $this->view->headScript()->prependFile('/assets/js/jquery-1.7.1.min.js', 'text/javascript');
    }
}
