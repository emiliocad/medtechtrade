<?php

/**
 * Admin_BlogController
 * Used for the management of the system blog
 */
class Admin_BlogController extends Zend_Controller_Action
{
    protected $_session;
    
    /**
     * Admin_BlogController::linkAppend()
     * Used for adding the params of the last viewed page in Blog Manager.
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
     * Admin_BlogController::init()
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
     * Admin_BlogController::indexAction()
     * Reserved for future development.
     * @return
     */
    public function indexAction(){
            
    }
    
    /**
     * Admin_BlogController::managerAction()
     * This is the action for the main blog manager. It display a table with the existing articles
     * and allows for search and other operations in the blog module. 
     * @return
     */
    public function managerAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_article);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['articles'])){
            foreach($_REQUEST['articles'] as $article) Model_Articles::changeState($article,$_REQUEST['deleted'],$_REQUEST['hidden']);              
        }
               
        $articles = Model_Articles::getAll()->toArray();
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST;
            $search_data = array(
                'search_term'   => $r['search_term'],
                'author_id'     => $r['author_id'],
                'category_id'   => $r['category_id'],
                'hidden'        => $r['hidden'],
                'deleted'       => $r['deleted'],
                'date_from'     => $r['date_from'],
                'date_to'       => $r['date_to']
            );
            $this->_session->search_article=$search_data;
            $articles = Model_Articles::getBySearchData($search_data)->toArray();
        }else{
            $articles = 
                isset($this->_session->search_article)?
                    Model_Articles::getBySearchData($this->_session->search_article)->toArray():
                    Model_Articles::getAll()->toArray();               
        }
              
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        $categories = Model_Categories::getAll();
        $c = array();
        foreach ($categories as $category) $c[$category['id']] = $category['name'];
        foreach ($articles as $key=>$article){
            $articles[$key]['author'] = $a[$article['account_id']];
            $articles[$key]['category'] = $c[$article['category_id']];
        }
        
        $this->view->articles = $articles;
        $this->view->authors = $a;
        $this->view->categories = $c;
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->article_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->articles= $sort->sort($this->view->articles,$field,$order);
        
    }
    
    /**
     * Admin_BlogController::switchArticleAction()
     * Used for switching the status of an article between "deleted" and "not deleted" 
     * @return
     */
    public function switchArticleAction(){
        $id = $this->_getParam('id');
        $article = Model_Articles::getById($id)->toArray();
        $article['deleted'] = 1-$article['deleted'];
        Model_Articles::save($article);
        $link = $this->linkAppend($this->_session->article_display);
        $this->_redirect('admin/blog/manager'.$link);
    }
    
    /**
     * Admin_BlogController::switchPublicStatusAction()
     * Used for switching the status of an article from "visible" to "hidden"
     * @return
     */
    public function switchPublicStatusAction(){
        $id = $this->_getParam('id');
        $article = Model_Articles::getById($id)->toArray();
        $article['hidden'] = 1-$article['hidden'];
        Model_Articles::save($article);
        $link = $this->linkAppend($this->_session->article_display);
        $this->_redirect('admin/blog/manager'.$link);
    }
    
    /**
     * Admin_BlogController::editArticleAction()
     * Used for editing an existing article.
     * @return
     */
    public function editArticleAction(){
        $id = $this->_getParam('id');
        $this->view->article = Model_Articles::getById($id);
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        $categories = Model_Categories::getAll();
        $c = array();
        foreach ($categories as $category) $c[$category['id']] = $category['name'];
        
        $this->view->authors = $a;
        $this->view->categories = $c;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'id'            => $r['id'],
                'account_id'    => $r['author_id'],
                'category_id'   => $r['category_id'],
                'title'         => stripslashes($r['title']),
                'summary'       => stripslashes(str_replace("\r\n","",$r['summary'])),
                'content'       => stripslashes(str_replace("\r\n","",$r['content']))
            );
            Model_Articles::save($data);
            $link = $this->linkAppend($this->_session->article_display);
            $this->_redirect('admin/blog/manager'.$link);
        }
        
    }
    
    /**
     * Admin_BlogController::addArticleAction()
     * Used for adding a new article.
     * @return
     */
    public function addArticleAction(){
        $id = $this->_getParam('id');
        
        $accounts = Model_Account::getAll();
        $a = array();
        foreach ($accounts as $account) $a[$account['id']] = $account['first_name'].' '.$account['last_name'];
        $categories = Model_Categories::getAll();
        $c = array();
        foreach ($categories as $category) $c[$category['id']] = $category['name'];
        
        $this->view->authors = $a;
        $this->view->categories = $c;
        
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'account_id'    => $r['account_id'],
                'category_id'   => $r['category_id'],
                'title'         => stripslashes($r['title']),
                'summary'       => stripslashes(str_replace("\r\n","",$r['summary'])),
                'content'       => stripslashes(str_replace("\r\n","",$r['content']))
            );
            Model_Articles::save($data);
            $link = $this->linkAppend($this->_session->article_display);
            $this->_redirect('admin/blog/manager'.$link);
        }
        
    }
    
    /**
     * Admin_BlogController::categoriesAction()
     * Used for the management of the existing categories in the blog
     * @return
     */
    public function categoriesAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($_REQUEST['p']);
        }

        $categories = Model_Categories::getAll()->toArray();
        
        $page = isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->category_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $this->view->categories= $sort->sort($categories,$field,$order);
    }
    
    /**
     * Admin_BlogController::editCategoryAction()
     * Used for editing an existing category in the blog.
     * @return
     */
    public function editCategoryAction(){
        $id = $this->_getParam('id');
        $this->view->category = Model_Categories::getById($id);
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'id'            => $r['id'],
                'name'          => stripslashes(strip_tags($r['name'])),
                'description'   => stripslashes(strip_tags($r['description']))
            );
            Model_Categories::save($data);
            $link = $this->linkAppend($this->_session->category_display);
            $this->_redirect('admin/blog/categories'.$link);
            
        }
    }
    
    /**
     * Admin_BlogController::addCategoryAction()
     * Used for adding a new category in the blog
     * @return
     */
    public function addCategoryAction(){
        if(isset($_REQUEST['save'])){
            $r = $_REQUEST;
            $data = array(
                'name'          => stripslashes(strip_tags($r['name'])),
                'description'   => stripslashes(strip_tags($r['description'])),
                'creation_date' => new Zend_Db_Expr('NOW()')
            );
            Model_Categories::save($data);
            $link = $this->linkAppend($this->_session->category_display);
            $this->_redirect('admin/blog/categories'.$link);
            
        }
    }
    
    /**
     * Admin_BlogController::manageCommentsAction()
     * Used for comments management for a given article.
     * @return
     */
    public function manageCommentsAction(){
        if(isset($_REQUEST['p']) && $_REQUEST['p']=="all") {
            unset($this->_session->search_comment);
            unset($_REQUEST['p']);
        }
        if(isset($_REQUEST['apply']) && !empty($_REQUEST['comments'])){
            foreach($_REQUEST['comments'] as $comment) Model_Comments::changeState($comment,$_REQUEST['deleted'],$_REQUEST['hidden']);              
        }
        
        $id = $this->_getParam('id'); //article id
        if(isset($_REQUEST['id'])) $id = $_REQUEST['id'];
        $comments = Model_Comments::getAllByArticle($id);
        
        if(isset($_REQUEST['search'])){
            $r = $_REQUEST; 
            $search_data = array(
                'article_id'    => $r['id'],
                'search_term'   => $r['search_term'],
                'author_id'     => $r['author_id'],
                'hidden'        => $r['hidden'],
                'deleted'       => $r['deleted'],
                'date_from'     => $r['date_from'],
                'date_to'       => $r['date_to']
            );
            $this->_session->search_comment=$search_data;
            $comments = Model_Comments::getBySearchData($search_data);
        }else{
            $comments = 
                isset($this->_session->search_comment)?
                    Model_Comments::getBySearchData($this->_session->search_comment):
                    Model_Comments::getAllByArticle($id);               
        }
        
        $authors = Model_Account::getAll();
        $a = array();
        foreach ($authors as $author) $a[$author['id']] = $author['first_name'].' '.$author['last_name'];
        
        foreach ($comments as $key=>$comment){
            $comment['comment']['author'] = $comment['account'];
            $comments[$key] = $comment['comment'];
        }
        
        $page =  isset($_REQUEST['p'])?$_REQUEST['p']:'1';
        $field = isset($_REQUEST['f'])?$_REQUEST['f']:'creation_date';
        $order = isset($_REQUEST['o'])?$_REQUEST['o']:'ASC';
        $this->_session->comment_display=array('page'=>$page,'field'=>$field,'order'=>$order);
        $sort = new A25_Array();
        if (isset($field))
            $comments= $sort->sort($comments,$field,$order);
        
        $this->view->authors = $a;
        $this->view->comments = $comments;
        $this->view->id = $id;
    }
    
    /**
     * Admin_BlogController::switchCommentAction()
     * Used for moderating comments. The status of the given comment is switched between "deleted" and "not deleted".
     * @return
     */
    public function switchCommentAction(){
        $id = $this->_getParam('id');
        $comment = Model_Comments::getById($id)->toArray();
        $comment['deleted'] = 1-$comment['deleted'];
        Model_Comments::save($comment);
        $link = $this->linkAppend($this->_session->comment_display);
        $this->_redirect('admin/blog/manage-comments/'.$link.'&id='.$comment['articles_id']);
    }
    
    /**
     * Admin_BlogController::switchCommentPublicStatusAction()
     * Used for moderating comments. The status of the given comment is switched between "visible" and "hidden".
     * @return
     */
    public function switchCommentPublicStatusAction(){
        $id = $this->_getParam('id');
        $comment = Model_Comments::getById($id)->toArray();
        $comment['hidden'] = 1-$comment['hidden'];
        Model_Comments::save($comment);
        $link = $this->linkAppend($this->_session->comment_display);
        $this->_redirect('admin/blog/manage-comments/'.$link.'&id='.$comment['articles_id']);
    }
    
    
}