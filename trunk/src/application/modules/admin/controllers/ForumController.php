<?php

/**
 * Admin_ForumController
 * Used for the management of the system forum 
 */
class Admin_ForumController extends Zend_Controller_Action
{
    protected $_session;
    
    /**
     * Admin_ForumController::linkAppend()
     * Used for adding the params of the last viewed page in Forum Manager.
     * @param mixed $d
     * @return
     */
    private function linkAppend($d = NULL){
        $link="";
        if($d){
            $link = "/?p=".$d['page']."&f=".$d['field']."&o=".$d['order'];
        };
        return $link;
    }

    /**
     * Admin_ForumController::init()
     * Executed for each request in order to update the session data.
     * @return
     */
    public function init(){
        $session = new Zend_Session_Namespace("ProdentalAdmin");
        $this->_session = $session;
        $this->view->session = $session;
        $this->_helper->layout->setLayout("dashboard");
        if(!isset($session->id)) $this->_redirect('admin');
    }

    /**
     * Admin_ForumController::indexAction()
     * Reserved for future development.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_ForumController::managerAction()
     * This is the action for the main forum manager. It display a table with the existing forums
     * and allows for search and other operations in the forum module.
     * @return
     */
    public function managerAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_forum);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['forums'])){
            foreach($_REQUEST['forums'] as $event) Model_Forums::changeState($event,$_REQUEST['deleted'],$_REQUEST['hidden']);              
        }
               
        $forums = Model_Forums::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'search_term'   => $r['search_term'],
                'account_id'    => $r['account_id'],               
                'hidden'        => $r['hidden'],
                'deleted'       => $r['deleted'],
                'date_from'     => $r['date_from'],
                'date_to'       => $r['date_to']
            );
            $this->_session->search_forum=$search_data;
            $forums = Model_Forums::getBySearchData($search_data)->toArray();
        }else{
            $forums = 
                isset($this->_session->search_forum)?
                    Model_Forums::getBySearchData($this->_session->search_forum)->toArray():
                    Model_Forums::getAll()->toArray();               
        }
              
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) 
            $a[$account['id']] = $account['first_name'].' '.$account['last_name'].' ('.$account['username'].')';
        foreach ($forums as $key=>$forum){
            $forums[$key]['author'] = $a[$forum['account_id']];
        }
        
        $this->view->forums = $forums;
        $this->view->authors = $a;
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->forum_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->forums= $sort->sort($this->view->forums,$field,$order);

    }
    
    /**
     * Admin_ForumController::switchForumAction()
     * Used for forum management. Switches the status of the given forum between "deleted" and "not deleted".
     * @return
     */
    public function switchForumAction(){
        $id = $this->_getParam('id');
        $forum = Model_Forums::getById($id)->toArray();
        $forum['deleted'] = 1-$forum['deleted'];
        Model_Forums::save($forum);
        $link = $this->linkAppend($this->_session->forum_display);
        $this->_redirect('admin/forum/manager'.$link);
    }
    
    /**
     * Admin_ForumController::switchPublicStatusAction()
     * * Used for forum management. Switches the status of the given forum between "visible" and "hidden".
     * @return
     */
    public function switchPublicStatusAction(){
        $id = $this->_getParam('id');
        $forum = Model_Forums::getById($id)->toArray();
        $forum['hidden'] = 1-$forum['hidden'];
        Model_Forums::save($forum);
        $link = $this->linkAppend($this->_session->forum_display);
        $this->_redirect('admin/forum/manager'.$link);
    }
    
    /**
     * Admin_ForumController::addForumAction()
     * Used for adding a new forum in the system.
     * @return
     */
    public function addForumAction(){
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) 
            if(!$account['hidden']) $a[$account['id']] = $account['first_name'].' '.$account['last_name'].' ('.$account['username'].')';
        
        $this->view->authors = $a;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'account_id'    => $r['account_id'],
                'title'         => stripslashes($r['title']),
                'description'   => stripslashes($r['description'])
            );
            Model_Forums::save($data);
            $link = $this->linkAppend($this->_session->forum_display);
            $this->_redirect('admin/forum/manager'.$link);
        }
    }
    
    /**
     * Admin_ForumController::editForumAction()
     * Used for editing an existing forum.
     * @return
     */
    public function editForumAction(){
        $id = $this->_getParam('id');
        $this->view->forum = Model_Forums::getById($id);
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        
        $this->view->authors = $a;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'id'            => $r['id'],
                'account_id'    => $r['account_id'],
                'title'         => stripslashes($r['title']),
                'description'   => stripslashes($r['description'])
            );
            Model_Forums::save($data);
            $link = $this->linkAppend($this->_session->article_display);
            $this->_redirect('admin/forum/manager'.$link);
        }
    }
    
    /**
     * Admin_ForumController::threadsAction()
     * Used for the management of the threads in an existing forum.
     * @return
     */
    public function threadsAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_thread);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['threads'])){
            foreach($_REQUEST['threads'] as $event) Model_Threads::changeState($event,$_REQUEST['deleted'],$_REQUEST['hidden']);              
        }
               
        $threads = Model_Threads::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'search_term'   => $r['search_term'],
                'tag'           => $r['tag'],
                'forum_id'      => $r['forum_id'],
                'account_id'    => $r['account_id'],               
                'hidden'        => $r['hidden'],
                'deleted'       => $r['deleted'],
                'date_from'     => $r['date_from'],
                'date_to'       => $r['date_to']
            );
            $this->_session->search_thread=$search_data;
            $threads = Model_Threads::getBySearchData($search_data)->toArray();
        }else{
            $threads = 
                isset($this->_session->search_thread)?
                    Model_Threads::getBySearchData($this->_session->search_thread)->toArray():
                    Model_Threads::getAll()->toArray();               
        }
              
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        foreach ($threads as $key=>$thread){
            $threads[$key]['author'] = $a[$thread['account_id']];
        }
        
        $forums = Model_Forums::getAll();
        $f = array();
        foreach ($forums as $forum) $f[$forum['id']] = $forum['title'];
        
        $this->view->threads = $threads;
        $this->view->authors = $a;
        $this->view->forums = $f;
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->thread_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->threads= $sort->sort($this->view->threads,$field,$order);
    }
    
    /**
     * Admin_ForumController::switchThreadAction()
     * Switch the status of a given thread between "deleted" and "not deleted".
     * @return
     */
    public function switchThreadAction(){
        $id = $this->_getParam('id');
        $thread = Model_Threads::getById($id)->toArray();
        $thread['deleted'] = 1-$thread['deleted'];
        Model_Threads::save($thread);
        $link = $this->linkAppend($this->_session->thread_display);
        $this->_redirect('admin/forum/threads'.$link);
    }
    
    /**
     * Admin_ForumController::switchThreadPublicStatusAction()
     * Switch the status of a given thread between "visible" and "hidden".
     * @return
     */
    public function switchThreadPublicStatusAction(){
        $id = $this->_getParam('id');
        $thread = Model_Threads::getById($id)->toArray();
        $thread['hidden'] = 1-$thread['hidden'];
        Model_Threads::save($thread);
        
        $link = $this->linkAppend($this->_session->thread_display);
        $this->_redirect('admin/forum/threads'.$link);
    }
    
    /**
     * Admin_ForumController::editThreadAction()
     * Used for editing an existing thread.
     * @return
     */
    public function editThreadAction(){
        $id = $this->_getParam('id');
        $this->view->thread = Model_Threads::getById($id);
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        
        $forums = Model_Forums::getAll();
        $f = array();
        foreach ($forums as $forum) $f[$forum['id']] = $forum['title'];
        
        $this->view->forums = $f;
        $this->view->authors = $a;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'id'            => $r['id'],
                'forum_id'      => $r['forum_id'],
                'account_id'    => $r['account_id'],
                'title'         => stripslashes($r['title']),
                'tags'          => stripslashes(strip_tags($r['tags'])),
                'description'   => stripslashes($r['description']),
                'sticky'        => isset($r['sticky']) ? 1 : 0 
            );
            Model_Threads::save($data);
            $link = $this->linkAppend($this->_session->thread_display);
            $this->_redirect('admin/forum/threads'.$link);
        }
    }
    
    /**
     * Admin_ForumController::addThreadAction()
     * Used for adding a new thread in a given forum.
     * @return
     */
    public function addThreadAction(){      
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        
        $forums = Model_Forums::getAll();
        $f = array();
        foreach ($forums as $forum) $f[$forum['id']] = $forum['title'];
        
        $this->view->forums = $f;
        $this->view->authors = $a;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'forum_id'      => $r['forum_id'],
                'account_id'    => $r['account_id'],
                'title'         => stripslashes($r['title']),
                'tags'          => stripslashes(strip_tags($r['tags'])),
                'description'   => stripslashes($r['description']),
                'sticky'        => isset($r['sticky']) ? 1 : 0,
                'view_count'    => 0,
                'post_count'    => 0 
            );
            Model_Threads::save($data);
            $link = $this->linkAppend($this->_session->thread_display);
            $this->_redirect('admin/forum/threads'.$link);
        }
    }
    
    /**
     * Admin_ForumController::postsAction()
     * Used for management of replies in a given thread.
     * @return
     */
    public function postsAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_post);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['posts'])){
            if($_REQUEST['hidden']==1)
                foreach($_REQUEST['posts'] as $post) Model_Replies::inactivate($post);
            else              
                foreach($_REQUEST['posts'] as $post) Model_Replies::activate($post);
        }
               
        $posts = Model_Replies::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'search_term'   => $r['search_term'],
                'thread_id'     => $r['thread_id'],
                'account_id'    => $r['account_id'],               
                'hidden'        => $r['hidden'],
                'date_from'     => $r['date_from'],
                'date_to'       => $r['date_to']
            );
            $this->_session->search_post=$search_data;
            $posts = Model_Replies::getBySearchData($search_data)->toArray();
        }else{
            $posts = 
                isset($this->_session->search_post)?
                    Model_Replies::getBySearchData($this->_session->search_post)->toArray():
                    Model_Replies::getAll()->toArray();               
        }
              
        
        $threads = Model_Threads::getAll();
        $t = array();
        foreach ($threads as $thread) $t[$thread['id']] = $thread['title'];
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        
        foreach ($posts as $key=>$post){
            $posts[$key]['author'] = $a[$post['account_id']];
            $posts[$key]['thread'] = $t[$post['threads_id']];
        }
        
        $this->view->threads = $t;
        $this->view->authors = $a;
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->post_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $posts= $sort->sort($posts,$field,$order);
            
        $this->view->posts = $posts;
    }
    
    
    /**
     * Admin_ForumController::switchPostStatusAction()
     * Used for sitching the status of a reply between "visible" and "hidden".
     * @return
     */
    public function switchPostStatusAction(){
        $id = $this->_getParam('id');
        $post = Model_Replies::getById($id)->toArray();
        $post['hidden'] = 1-$post['hidden'];
        Model_Replies::save($post);
        
        $link = $this->linkAppend($this->_session->post_display);
        $this->_redirect('admin/forum/posts'.$link);
    }
    
}