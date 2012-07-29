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
            if($c['table.url']->saveUrl($form->getValues())) {
                $this->_helper->redirector->gotoRouteAndExit(array(), 'default');
            }
        }
    }
    
    public function editAction()
    {
        $request = $this->getRequest();
        $id      = $request->getParam('id');
        $c       = Container::getContainer();
        $url     = $c['table.url']->fetchRow(array('id = ?' => $id));
        if(! $url) {
            $this->getResponse()->setHttpResponseCode(404);
            $this->view->errorMessage = sprintf("Url id '%s' tidak ditemukan.", $id);
            $this->render('tag');
        } else {
            $form    = $c['form.url'];
            $form->injectUrl($url);
            $this->view->form = $form;
            
            if($request->isPost() && $form->isValid($request->getPost())) {
                $data       = $form->getValues();
                $data['id'] = $id;
                
                if($c['table.url']->saveUrl($data)) {
                    $this->_helper->redirector->gotoRouteAndExit(array(), 'default');
                }
            }
            $this->render('add');
        }
    }
    
    public function deleteAction()
    {
        $id     = $this->_request->getParam('id');
        $slug   = $this->_request->getParam('slug');
        $md5    = $this->_request->getParam('md5');
        
        if($md5 !== md5($id.$slug)) {
            $this->getResponse()->setHttpResponseCode(403);
            $this->view->errorMessage = sprintf("Request delete tidak valid.");
            $this->render('tag');
        } else {
            $url = Container::get('table.url')->fetchRow(array('id = ?' => $id));
            if($url) {
                $this->_helper->layout->disableLayout();
                $this->_helper->viewRenderer->setNoRender();
                $delete = Container::get('table.url')->deleteUrl($url);
                if($delete) {
                    $this->_redirect($this->getRequest()->getHeader('referer'));
                }
            } else {
                $this->getResponse()->setHttpResponseCode(404);
                $this->view->errorMessage = sprintf("URL tidak ada.");
                $this->render('tag');
            }
        }
    }
}