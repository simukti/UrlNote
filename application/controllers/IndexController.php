<?php
/**
 * Description of IndexController
 *
 * @author Sarjono Mukti Aji <me@simukti.net>
 */
use \Zend_Controller_Action as ControllerAction;
use \Service_Container as Container;

class IndexController extends ControllerAction
{
    public function indexAction()
    {
        $c         = Container::getContainer();
        $paginator = $c['paginator'](
                        $c['paginator.adapter.iterator'](
                            $c['table.url']->findAllRecentUrl()
                        )
                     );
        $paginator->setItemCountPerPage(10)
                  ->setPageRange(18)
                  ->setCurrentPageNumber($this->_getParam('page'));
        
        $this->view->headTitle(sprintf("Home - Page %s", $this->_getParam('page')));
        $this->view->navigation()->findById('default')->setActive(true);
        $this->view->paginator = $paginator;
    }
    
    public function tagsAction()
    {
        $this->view->headTitle('Tags List');
        $this->view->tags = Container::get('table.tag')->findAllTags();
    }
    
    public function tagAction()
    {
        $slug     = $this->_request->getParam('slug');
        $c        = Container::getContainer();
        $tag      = $c['table.tag']->findOneBySlug($slug);
        
        if($tag) {
            $urls = $c['table.tag']->findUrlByTagSlug($slug);
            if($urls) {
                $paginator = $c['paginator']($c['paginator.adapter.iterator']($urls));
                $paginator->setItemCountPerPage(10)
                          ->setPageRange(18)
                          ->setCurrentPageNumber($this->_getParam('page'));
                
                $this->view->paginator = $paginator;
                $this->view->headTitle(sprintf("Tag '%s' - Page %s", $slug, $this->_getParam('page')));
                $this->view->navigation()->findById('tags')->setActive(true);
            }
            $this->view->slug = $slug;
        } else {
            $this->getResponse()->setHttpResponseCode(404);
            $this->view->errorMessage = sprintf("Tag '%s' tidak ditemukan.", $slug);
        }
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        $c       = Container::getContainer();
        $form    = $c['form.url'];
        
        $this->view->form = $form;
        
        if($request->isPost() && $form->isValid($request->getPost())) {
            if($c['table.url']->insertUrl($form->getValues())) {
                $this->_helper->redirector->gotoRouteAndExit(array(), 'default');
            }
        }
    }
}