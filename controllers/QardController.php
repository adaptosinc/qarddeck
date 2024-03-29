<?php

namespace app\controllers;

use Yii;
use app\models\Qard;

use app\models\User;
use app\models\UserProfile as Profile;
use app\models\Theme;
use app\models\Deck;
use app\models\QardDeck;
use app\models\QardBlock as Block;
use app\models\search\SearchQard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\db\Query;
use yii\db\Command;
use yii\db\Connection;
use lib\GrabzItClient;
use yii\web\ForbiddenHttpException;


use app\models\Tag;

/**
 * QardController implements the CRUD actions for Qard model.
 */
class QardController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors(){
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['publish','activity','edit','my-qards'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['publish','activity','edit','my-qards'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
	
    /**
     * Lists all Qard models.
     * @return mixed
     */
    public function actionIndex($page=null,$type=null,$search=''){ 
		if(!$type)
			$type = 'both';
		$limit = 6;
		if(!$page)
			$page = 0;
		$offset = $page*$limit;
		
		   $limit2 = 4;
		 if(!$page)
			$page = 0;					
		$offset2 = $page*$limit2;	
			
		if(!empty($search))
		{		
			
		  $tagval = Tag::find()
			->select(['name'])
			->where(['tag_id'=>$search])
			->asArray()
			->one();	
			
			$searchval = $tagval['name'];	
			Yii::$app->getSession()->setFlash('searchval',$searchval);
			Yii::$app->getSession()->setFlash('searchid',$search);
				
			$qards = $this->getQardsfeedsearch($offset,$limit,$type,$search);
								
			$decks =  $this->getDecksfeedsearch($offset2,$limit2,$search);
			
		}
		else {			
			$qards = $this->getQardsfeed($offset,$limit,$type);								
			$decks =  $this->getDecksfeed($offset2,$limit2);		
		}
	
		if($type == 'both'){
			//joining the dec+qard array
			array_splice($qards, count($qards), 0, $decks);
			shuffle($qards);			
		}
		if($type == 'decks'){
			$qards = $decks;			
		}
			//print_r($qards);die;
		$feed = '';
		foreach($qards as $html){
			$feed .= $html;
		}
		if(!$page || $page == 0){
			if($this->isMobile()){
				$this->layout = "mobile";
				return $this->render('mobile/qard_stream',[
					'feed' => $feed,
					'type' => $type
				]);					
			}
			else
				return $this->render('qard_stream',[
					'feed' => $feed,
					'type' => $type,					
				]);		
		}
		else{
			return $feed;		
		}

	 }
    /**
     * Generate the qards feed html for a request.
     * @param integer $offset and $limit
     * @return html
     */
    public function getQardsfeed($offset,$limit,$type){
		$feed = [];
		$Query = new Query;
		$Query->select(['*'])
			->from('qard')
			->where(['status'=>1])
			->limit($limit)
			->offset($offset)
			->orderBy(['last_updated_at' => SORT_DESC]);	
		$command = $Query->createCommand();
		$qards = $command->queryAll();
		//get html feed
		foreach($qards as $qard){
			$model = Qard::findOne([$qard['qard_id']]);
			$modelFeed = $model->getQardHtml($type);
			if( $modelFeed != '')
				$feed []= $modelFeed;
		}
		return	$feed;
	}
	/**
	 * Deck feed function
	 * @param integer $offset,$limit
	 * @return html
	 */	
	public function getDecksfeed($offset,$limit){
		$feed = [];
		$Query = new Query;
		$Query->select(['*'])
			->from('deck')
			->limit($limit)
			->offset($offset)
			->orderBy(['created_at' => SORT_DESC]);	
		$command = $Query->createCommand();
		$decks = $command->queryAll();
		//get html feed
		foreach($decks as $deck){
			$model = Deck::findOne([$deck['deck_id']]);
			$modelFeed = $model->getDeckHtml();
			if( $modelFeed != '')
				$feed []= $modelFeed;
		}
		return $feed;		
	}
    /**
     * Lists all Qard models.
     * @return mixed
     */
    public function actionMyQards($page=null,$type=null,$id=null){ 

	if(!$id)
		$id=Yii::$app->user->id;
		
		if(!$type)
			$type = 'both';
		$limit = 5;
		if(!$page)
			$page = 0;
		$offset = $page*$limit;
		$qards = $this->getMyQardsfeed($offset,$limit,$type,$id);
		//	print_r($feed);die;
		
		$limit2 = 2;
		 if(!$page)
			$page = 0;					
		$offset2 = $page*$limit2;		
			
		$decks =  $this->getMyDecksfeed($offset2,$limit2,$id);
		$user = User::findOne($id);
		if(!$user)
			return $this->redirect(['index']); 
		
		
		$qardcount = $user->getUserqardCount();		
		$likecount = $user->getUserlikeCount();		
		$bookmarkcount = $user->getUserbookmarkCount();		
		$sharecount = $user->getUsershareCount();
		$followercount = $user->getFollowerCount();
		$followingcount = $user->getFollowingCount();
		$followerid = $id;			
		$follow = $user->getFindfollowuser($followerid);
		
		
		if($type == 'both'){
			//joining the dec+qard array
			array_splice($qards, count($qards), 0, $decks);
			shuffle($qards);			
		}
		if($type == 'decks'){
			$qards = $decks;
		}
			//print_r($qards);die;
		$feed = '';
		foreach($qards as $html){
			$feed .= $html;
		}
		if(!$page || $page == 0){
			if($this->isMobile()){
				$this->layout = "mobile";
				return $this->render('mobile/my_qards',[
					'feed' => $feed,
					'type' => $type,
					'qardcount'=>$qardcount,
					'sharecount'=>$sharecount,
					'bookmarkcount'=>$bookmarkcount,
					'likecount'=>$likecount,
					'followercount'=>$followercount,
					'followingcount'=>$followingcount,
					'user'=>$user,
					'follow'=>$follow,
				]);
			}
			else	
				return $this->render('my_qards',[
					'feed' => $feed,
					'type' => $type,
					'qardcount'=>$qardcount,
					'sharecount'=>$sharecount,
					'bookmarkcount'=>$bookmarkcount,
					'likecount'=>$likecount,
					'followercount'=>$followercount,
					'followingcount'=>$followingcount,
					'user'=>$user,
					'follow'=>$follow,
				]);		
		}
		else{
			return $feed;		
		}

	 }	 
    /**
     * Generate the qards feed html for a request.
     * @param integer $offset and $limit
     * @return html
     */
    public function getMyQardsfeed($offset,$limit,$type,$id){
		$feed = [];
		$Query = new Query;
		$Query->select(['*'])
			->from('qard')
			->where(['user_id'=>$id])
			->andWhere(['<>','status', 2])
			->andWhere(['<>','status', 9])
			->limit($limit)
			->offset($offset)
			->orderBy(['last_updated_at' => SORT_DESC]);	
		$command = $Query->createCommand();
		$qards = $command->queryAll();
		//get html feed
		foreach($qards as $qard){
			$model = Qard::findOne([$qard['qard_id']]);
			$modelFeed = $model->getQardHtml($type);
			if( $modelFeed != '')
				$feed []= $modelFeed;
		}
		return	$feed;
	}
	/**
	 * Deck feed function
	 * @param integer $offset,$limit
	 * @return html
	 */	
	public function getMyDecksfeed($offset,$limit,$id){
		$feed = [];
		$Query = new Query;
		$Query->select(['*'])
			->from('deck')
			->where(['user_id'=>$id])
			->limit($limit)
			->offset($offset)
			->orderBy(['created_at' => SORT_DESC]);	
		$command = $Query->createCommand();
		$decks = $command->queryAll();
		//get html feed
		foreach($decks as $deck){
			$model = Deck::findOne([$deck['deck_id']]);
			$modelFeed = $model->getDeckHtml();
			if( $modelFeed != '')
				$feed []= $modelFeed;
		}
		return $feed;		
	}	
    /**
     * Displays a single Qard model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$this->layout = "plain";
		$model = $this->findModel($id);
		$single = true;
		$modelFeed = $model->getQardHtmlSingle();	
		
		//print_r($modelFeed);die;
        return $this->render('view', [
            'model' => $modelFeed,
        ]);
    }

	/**
	 * Action for selecting the template
	 * params null
	 * @return mixed
	 */
	public function actionSelectTemplate($selected=null){
		$adminuserid = "";
		$qards ="";
		$userrole = "";
		if(\Yii::$app->user->id)
		{
			$userid = \Yii::$app->user->id;
			$user = User::findOne($userid);
			$userrole = $user->role;
			if($userrole == 'admin')
				$ch_status = 5;
			else 
				$ch_status = 3;
			
			$qards = Qard::find()->where(['status'=>$ch_status,'user_id'=>$userid])->orderBy(['qard_id' => SORT_DESC])->all();
		}
		
		
		$adminuser = User::find()->where(['role'=>'admin'])->all();		
		
		foreach($adminuser as $tmp)
		{
			if(!isset($userid))
				$adminuserid[] = $tmp->id;
			else if($tmp->id != $userid)
				$adminuserid[] = $tmp->id;
			
		}
		
		$adminqards = Qard::find()->where(['in', 'user_id', $adminuserid])->andWhere('status = :status',[':status' => 5])->orderBy(['qard_id' => SORT_DESC])->all();
		
		if($selected){
			//selected template
			if($selected == "blank")
				return $this->redirect(['create']);
			$template = Qard::findOne($selected);
			if(!isset($template))
				return $this->redirect(['select-template']);
			//LOAD TEMPLATE
			$qard = new Qard();
			$qard->attributes = $template->attributes;
			$qard->status = 0;
			$qard->user_id = NULL;
			$qard->title = '';
			if(\Yii::$app->user->id)
				$qard->user_id = \Yii::$app->user->id;
			$qard->save(false);
			//print_r($qard->qard_id);die;
			$blocks = $template->blocks;
			foreach($blocks as $block){
				$qard_block = new Block();
				//$block = Block::findOne($block->block_id);
				$qard_block->attributes = $block->attributes;
				//print_r($qard_block);die;
				$qard_block['qard_id'] = $qard->qard_id;
					$theme = $block->theme;
						$block_theme = new Theme();
						$block_theme->attributes = $theme->attributes;
						$block_theme->save(false);
					
				$qard_block['theme_id'] = $block_theme->theme_id;
				//print_R($qard_block);die;
				$qard_block->save(false);
			}
			return $this->redirect(['theme/select-theme','qard_id'=>$qard->qard_id]);
		}
        return $this->render('template', [
            'qards' => $qards,'adminqards' =>$adminqards,'userrole'=>$userrole
        ]);		
	}
    /**
     * Creates a new Qard model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($theme_id=null)
    {
        $model = new Qard();
		if(!$this->isMobile()){ 
			if(!$theme_id){
				//go and select a theme and then come back
				return $this->redirect(['theme/select-theme']);
			}
			else{
				$theme = Theme::findOne($theme_id);
				if(!$theme){
					\Yii::$app->getSession()->setFlash('error', 'Please select a theme');
					return $this->redirect(['theme/select-theme']);
				}
			}
		}
        if ($model->load(Yii::$app->request->post())) {
			
			$model->save(false);
			if(!\Yii::$app->user->id){
				//save false here with out user id and status as draft
				//$model->save(false);
				//aftersave take the qard-id as a param and send to login page
				\Yii::$app->session['qard']= $model->qard_id;
				return $this->redirect(['user/login','qard_id'=>$q_id]);
				//at login/sign-up,check if qard-id is there,if yes assign the user to the same qard once logged in
			}
            return $this->redirect(['view', 'id' => $model->qard_id]);
        } else {
			
			$tags=\app\models\Tag::find()->all();
            if(!$this->isMobile()){ 
                return $this->render('create', [
                    'model' => $model,
					'theme' => $theme,
					'tags'=>$tags
                ]);
            }else{
                $this->layout = 'mobile';
                return $this->render('mobile/create', [
                    'model' => $model,
                ]);                
            }
	    
        }
	
    }
	public function actionEdit($id,$theme_id=null){

		$switch_theme = false;
		$model = $this->findModel($id);
		if(is_null($model->user_id) && $id == \Yii::$app->session['qard_id']){
			//save the qard with current user
			$model->user_id = \Yii::$app->user->id;
			$model->save(false);
		}
		if($model->user_id != \Yii::$app->user->id){
			//throw new NotFoundHttpException();
			throw new ForbiddenHttpException();
		}
		if($theme_id)
			$switch_theme = true;
		if(!$theme_id)
			$theme_id = $model->qard_theme;
		$theme = Theme::findOne($theme_id);
        if ($model->load(Yii::$app->request->post())) {
			
			$model->save(false);
			if(!\Yii::$app->user->id){
				//save false here with out user id and status as draft
				//$model->save(false);
				//aftersave take the qard-id as a param and send to login page
				\Yii::$app->session['qard']= $model->qard_id;
				return $this->redirect(['user/login','qard_id'=>$q_id]);
				//at login/sign-up,check if qard-id is there,if yes assign the user to the same qard once logged in
			}
            return $this->redirect(['view', 'id' => $model->qard_id]);
        } else {
			
			
			$tags=\app\models\Tag::find()->all();
            if(!$this->isMobile()){ 
			
                return $this->render('edit', [
                    'model' => $model,
					'theme' => $theme,
					'switch_theme' => $switch_theme,
					'tags'=>$tags
                ]);
            }else{			
                $this->layout = 'mobilelayout';
                return $this->render('mobile/create', [
                    'model' => $model,
                ]);                
            }
	    
        }
	}
	public function actionEditTemplate($id,$theme_id=null){

		$switch_theme = false;
		$model = $this->findModel($id);
		if(is_null($model->user_id) && $id == \Yii::$app->session['qard_id']){
			//save the qard with current user
			$model->user_id = \Yii::$app->user->id;
			$model->save(false);
		}
		if($model->user_id != \Yii::$app->user->id){
			//throw new NotFoundHttpException();
			throw new ForbiddenHttpException();
		}
		if($theme_id)
			$switch_theme = true;
		if(!$theme_id)
			$theme_id = $model->qard_theme;
		$theme = Theme::findOne($theme_id);
        if ($model->load(Yii::$app->request->post())) {
			
			$model->save(false);
			if(!\Yii::$app->user->id){
				//save false here with out user id and status as draft
				//$model->save(false);
				//aftersave take the qard-id as a param and send to login page
				\Yii::$app->session['qard']= $model->qard_id;
				return $this->redirect(['user/login','qard_id'=>$q_id]);
				//at login/sign-up,check if qard-id is there,if yes assign the user to the same qard once logged in
			}
            return $this->redirect(['view', 'id' => $model->qard_id]);
        } else {
			
			
			$tags=\app\models\Tag::find()->all();
            if(!$this->isMobile()){ 
			
                return $this->render('edit', [
                    'model' => $model,
					'theme' => $theme,
					'switch_theme' => $switch_theme,
					'tags'=>$tags
                ]);
            }else{			
                $this->layout = 'mobilelayout';
                return $this->render('mobile/create', [
                    'model' => $model,
                ]);                
            }
	    
        }
	}	
	/**
	 * To preview the qard while creating/editing
	 * Idea is to reload the saved/drafed qard with the selected theme
	 * @param integer qard_id, theme_id
	 * @return mixed
	 */
	 public function actionPreviewQard($qard_id,$theme_id=null){
		 
		$user = "";
		$qard = $this->findModel($qard_id);
		$theme = $qard->qardTheme;
		$blocks = $qard->blocks;
	
		
		if(empty($qard->user_id))
		{
			\Yii::$app->session['qard_id']= $qard_id;	
			$user = Profile::find()->where(['user_id' =>\Yii::$app->user->id])->one();			
		}else
		{
			$user = User::find()->where(['id' =>\Yii::$app->user->id])->one();
		}
			
		//print_r($theme);die;
		return $this->render('preview', [
			'model' => $qard,
			'theme' => $theme,
			'blocks' => $blocks,
			'user' => $user,
			
		]); 		
	 }
	 
	/**
	 * To consume the qard after creation
	 * @param integer qard_id, theme_id
	 * @return mixed
	 */
	 public function actionConsume($qard_id){
		
		$qard = $this->findModel($qard_id);
		$deckrel  = $qard->qardDecks;
		
		$deck ="";
		$deckcount = "";
		$nextpostion ="";
		$prevpostion ="";
		$curpostion ="";
		$viewcurrent ="";
		$results = "";
		
		if(isset($deckrel) && !empty($deckrel))
		{			
			$deck = Deck::findOne($deckrel->deck_id);
			$deckcount  = $deck->getDeckqardCount();
			
			$results  = $qard->getQardDeckCount($deck->deck_id,$deck->user_id);
			/* $connection = Yii::$app->getDb(); 
			
			$command = $connection->createCommand('SELECT q.qard_id FROM `qard_deck` qd, `qard` q where qd.`deck_id` = '.$deck->deck_id.' and qd.`qard_id`= q.`qard_id` and q.`status` != 2 ORDER BY q.`qard_id` ASC');
			
			$results = $command->queryAll();  */
		
			foreach( $results as $key=>$tmp)
			{
				if($tmp['qard_id'] ==  $qard_id )
				{				
					 $viewcurrent = 1 + $curr = $key;
						$curpostion=$results[$curr]["qard_id"];	
					 
					 $prev = $key - 1;
					if($prev >= 0)
						$prevpostion=$results[$prev]["qard_id"];
										
					 $next = $key + 1;					
					if($next < count($results))
						$nextpostion= $results[$next]["qard_id"];
				
					break;
					
				}
			}
			
		}
		$userid = \Yii::$app->user->id;
		$followerid = $qard->user_id;	
		
		$user = User::findOne($userid);
	if(!$user)
		$follow = "2";
	else
		$follow = $user->getFindfollowuser($followerid);
	
		$theme = $qard->qardTheme;
		$blocks = $qard->blocks;

		$this->metaTags($qard);
		if(!$this->isMobile()){
			return $this->render('consume', [
				'model' => $qard,
				'theme' => $theme,
				'blocks' => $blocks,
				'deck' => $deck,
				"deckcount"=>$deckcount,
				"nextpostion"=>$nextpostion,
				"curpostion"=>$curpostion,
				"prevpostion"=>$prevpostion,
				"viewcurrent"=>$viewcurrent,
				"qards" => $results,	
				"follow"=> $follow,	
			]);
		}else{
			$this->layout = "mobile";
			return $this->render('consume-mobile', [
				'model' => $qard,
				'theme' => $theme,
				'blocks' => $blocks,
				'deck' => $deck,
				"deckcount"=>$deckcount,
				"nextpostion"=>$nextpostion,
				"curpostion"=>$curpostion,
				"prevpostion"=>$prevpostion,
				"viewcurrent"=>$viewcurrent,
				"qards" => $results,
				"follow"=> $follow,					
			]);
		}		
	 }	 

	 public function metaTags($qard){
		\Yii::$app->view->registerMetaTag([
			'property' => 'og:image',
			'content' => 'http://wordpressmonks.com'.Yii::$app->homeUrl.'uploads/qards/'.$qard->qard_id.".png",
		]);
		\Yii::$app->view->registerMetaTag([
			'property' => 'og:title',
			'content' => 'QardDeck',
		]);
		\Yii::$app->view->registerMetaTag([
			'name' => 'description',
			'content' => 'Check the awesome Qard created by '.$qard->userProfile->fullname.' !Share what you love,think and know. Easily.',
		]);		
		\Yii::$app->view->registerMetaTag([
			'property' => 'twitter:image',
			'content' => 'http://wordpressmonks.com'.Yii::$app->homeUrl.'uploads/qards/'.$qard->qard_id.".png",
		]);
	 }
    /**
     * Updates an existing Qard model to the status published.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
	public function actionPublish($q_id=null,$status=0){
		
		if($q_id){
			//handle this as ajax request from share qard button, preview page
			$model = Qard::findOne($q_id);
			$model->status = $status;
			$model->user_id = \Yii::$app->user->id;
			$model->qard_image_url = $this->actionGenerateQardImage($q_id);
			
			if($model->save(false)){
				return true;
			}else{
				return false;
			}
			exit;
		}
			
		$id = Yii::$app->session['qard'];
		$model = Qard::findOne($id);
		
		if ($model== null)
			return $this->redirect(['site/index']);
		$model->status = $status;
		$model->user_id = \Yii::$app->user->id;
		$model->qard_image_url = $this->actionGenerateQardImage($id);
		
		
		if($model->save(false)){
			//generate the qard image here
			unset(\Yii::$app->session['qard']);
			return $this->redirect(['preview-qard','qard_id' => $model->qard_id]); //change this to consume window
		}
			
	} 
	public function actionChangeStyle($qard_style, $qard_id){
		$model = Qard::findOne($qard_id);
		if($model){
			$model->qard_style = $qard_style;
			$model->save(false);
		}
		return true;
	}


    /**
     * Deletes an existing Qard model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {	
         $this->findModel($id)->delete();
        return $this->redirect(['index']); 
    }
	/**
	 * To record the user activity for a qard
	 * @return mixed
	 */
	public function actionActivity($id,$type,$sharetype){

		$query = new Query;
		//see if the row already exists or not
		$query->select(['*'])
			->from('qard_user_activity')
			->where(['activity_type' => $type,
					'qard_id' => $id,
					'user_id'=> \Yii::$app->user->id]);
		$command = $query->createCommand();
		$activities = $command->queryAll();
		if(empty($activities)){
			//$connection = new Connection;
			$command = \Yii::$app->db->createCommand()->insert('qard_user_activity', [
				'activity_type' => $type,
				'qard_id' => $id,
				'user_id'=> \Yii::$app->user->id,
				'share_type'=>$sharetype,
			]);
			if($command->execute())
				return $type."ed";			
		}
		else{
		
			 if($type != 'share'){
				//do an unlike,do an unfollow or an un-bookmark
				$command = \Yii::$app->db->createCommand()->delete('qard_user_activity',[				
				'activity_type' => $type,
				'qard_id' => $id,
				'user_id'=> \Yii::$app->user->id]);
					if($command->execute())
							return 'Un'.$type."ed";	
			}
			else  
			if($type == 'share'){
				
				$command = \Yii::$app->db->createCommand()->insert('qard_user_activity', [
					'activity_type' => $type,
					'qard_id' => $id,
					'user_id'=> \Yii::$app->user->id,
					'share_type'=>$sharetype,
				]);
				
				
				if($command->execute())
					return $type."ed";				
			}

		}

	}
	/**
	 * Fetch the h2 and image from a url 
	 * For url preview
	 * @param string $url
	 * @return mixed
	 */
	public function actionUrlPreview($url,$block_id=null){
			$output_array = [];
			//$url = $_POST['url'];		
			$c = curl_init($url);			
			$options = array(
				CURLOPT_RETURNTRANSFER => true,     // return web page
				CURLOPT_HEADER         => false,    // don't return headers
				CURLOPT_FOLLOWLOCATION => true,     // follow redirects
				CURLOPT_ENCODING       => "",       // handle all encodings
				CURLOPT_USERAGENT      => "spider", // who am i
				CURLOPT_AUTOREFERER    => true,     // set referer on redirect
				CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
				CURLOPT_TIMEOUT        => 120,      // timeout on response
				CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
				CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
			);
			curl_setopt_array( $c, $options );
			$html = curl_exec($c);
		
			$mimeType = curl_getinfo($c, CURLINFO_CONTENT_TYPE);
		
			
			if($mimeType == 'application/pdf') {
				$output_array['type'] = 'PDF';
				echo json_encode($output_array);
				die;
			}
                        if($mimeType == 'application/msword') {
							$output_array['type'] = 'DOC';
							echo json_encode($output_array);
							die;
			}
                        if($mimeType == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
				$output_array['type'] = 'DOCX';
				echo json_encode($output_array);
				die;
			}
             
			
			//echo $html;
			/******************************/
			if (curl_error($c))
			$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
			curl_close($c);	
			$doc = new \DOMDocument();
			@$doc->loadHTML($html);
			/******************************/
			$img_array = [];
			$content = false;
			$title =false;
			$image = false;
			/******************************/
			//h2's first
			
			$titles = $doc->getElementsByTagName('title');
			if($titles->length > 0){ 
				foreach($titles as $title){
					$title = $title->textContent;
				}
			}
			/******************************/
			//get image and content from meta
			$metas = $doc->getElementsByTagName('meta');
			
			if($metas->length > 0){
				foreach($metas as $meta){
					if($meta->getAttribute('property') == 'og:image' && $meta->getAttribute('content')!= '')
						$img_array[] = $meta->getAttribute('content');
					if($meta->getAttribute('name') && $meta->getAttribute('name')=='description')
						$content = $meta->getAttribute('content');
				}				
			}
			//if no image from meta
			if(count($img_array) == 0 ){
				$images = $doc->getElementsByTagName('img');
				if($images->length > 0){
					foreach($images as $img){
						if($img->getAttribute('src')!='')
							$img_array[] = $img->getAttribute('src');
					}
				}				
			}
			if(isset($img_array[0]))
				$image = $img_array[0];
			//if no content from meta
			if(!$content){
				$ps = $doc->getElementsByTagName('p');
				if($ps->length > 0)
					$i=0;
					foreach($ps as $p){
						//we need only the first P
						if($i==0)
							$content = $p->textContent;
						$i++;
					}
			}
			/******************************/
			$parse = parse_url($url);
			$domain = $parse['scheme'] . '://' . $parse['host'] . '/';
			$base_url = '';	
			// singlebyte strings
			$first =  substr($image, 0, 1);
			$result = substr($image, 0, 2);
			if($first == '/' && $result != '//')
				$image = $domain.$image;
			//echo $domain;echo $result;
			$preview_html = '<div id="review-qard-id" class="review-qard row" id="">';
			if($this->isFrameAllowed($url)){
				$preview_html .= '<iframe sandbox="" src="'.$url.'" style="border:none"  width="100%" height="500px" ></iframe>';
				$framecheck =1;
			}else{ 
				$framecheck =2;
				$preview_html .= '
				<div class="img-preview col-sm-3 col-md-3">';
				if($image)
					$preview_html .= '<img src="'.$image.'" alt="">';
				else
					$preview_html .= '<i class="fa fa-file-image-o" style="font-size: 12em;" aria-hidden="true"></i>';
/* 				$preview_html .= '<button id="url_img_remove" onClick="changePic(this)" class="btn btn-default btn-remove">Remove</button></div><div class="col-sm-9 col-md-9" id="title_desc_url"><div class="url-content"><h4><input name="url_title" type="text" class="form-control" value="'.$title.'" /></h4><div class="url-text"><p><textarea name="url_content" class="form-control">'.$content.'</textarea></p></div></div></div></div> ';	 */		
				$preview_html .= '</div><div class="col-sm-9 col-md-9" id="title_desc_url"><div class="url-content"><h4><a href='.$url.' target="blank">'.$title.'</a></h4><div class="url-text"><p>'.$content.'</p></div></div></div>';	
			}
			$preview_html .= '</div>';
			
			/**/
			//echo '<div> <h3>Consume Preview</h3>';
			//$title = explode('.',$title);
			/******************************/
			//FORMAT THE OUTPUT IN JSON
			$link_icon = '<span class="icon-mark pull-right previewLink" id="previewLink" data-open="same" contenteditable="false" onclick = "displayLink(this);" data-url="'.$url.'"><img src="'.Yii::$app->request->baseUrl.'/images/link_icon.png" alt=""></span>';
			
			$output_array['preview_html'] = $preview_html;
			$output_array['work_space_link_only'] = $link_icon;
			$output_array['framecheck'] = $framecheck;
		
			//$output_array['work_space_text'] ='<span>'.substr($title,0,150).'...</span>'.$link_icon;
			$output_array['work_space_text'] = '<span>'.$title.'</span>'.$link_icon;
			
			//link_icon with onclick function
			
			$output_array['type'] = 'web_page';
			/*****************************/
			$output_array['url_title'] = '';
			$output_array['url_description'] = '';

			if($block_id && $block_id !=0 ){ 
				$block = Block::findOne($block_id);
				$data = [];
				if($block){
						$output_array['url_title'] = $block->link_title;
						$output_array['url_description'] = $block->link_description;				
				}
		//return json_encode($data);		
			}		
			echo json_encode($output_array);					
	}
	
	/**
	 * Deprecated method
	 * Used to generate the web page content as a whole
	 * Written as a work-around for x-frame-options:deny or sameorigin
	 */
	public function actionRenderFrame($url){
		$parse = parse_url($url);
		$domain = $parse['scheme'] . '://' . $parse['host'] . '/';
		$content = file_get_contents($url);
		$base_url = '';
		$content = str_replace('', $base_url . '', $content);
		$content = str_replace('src="/', 'src="' . $domain, $content);
		$content = str_replace('href="/', 'href="' . $domain, $content);

		echo $content;
	}
	
	/**
	 * Method to check whether framing is allowed for a url
	 * @return boolean
	 */	
	public function isFrameAllowed($url){
		$h = get_headers($url,1);
		//print_r($h);die;
		if(isset($h['X-FRAME-OPTIONS']))
			$option = $h['X-Frame-Options'] = $h['X-FRAME-OPTIONS'];
			
		if(isset($h['X-Frame-Options'])){		
			if($h['X-Frame-Options'] == 'sameorigin' || $h['X-Frame-Options'] =='SAMEORIGIN' ||  $h['X-Frame-Options'] == 'DENY' || $h['X-Frame-Options'] == 'deny')
				return false;
			else
				return true;
		} 
		else
		 return true;
	}
	
	/**
	 * Method to get the preview image of an embed code
	 * @param html $embed_code
	 * @return mixed
	 */	
	public function actionEmbedUrl(){
		//get the src url
		//fetch the meta image from the url response
		$embed_code = \Yii::$app->request->post()['embed_code'];
		$video_array = [];
		$doc = new \DOMDocument();
		@$doc->loadHTML($embed_code);
		$src = $doc->getElementsByTagName('iframe')->item(0)->getAttribute('src');
		$c = curl_init($src);			
		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
			CURLOPT_SSL_VERIFYPEER => false     // Disabled SSL Cert checks
		);
		curl_setopt_array( $c, $options );
		$html = curl_exec($c);
		
		$doc2 = new \DOMDocument();
		@$doc2->loadHTML($html);
		$title =false;
		$titles = $doc2->getElementsByTagName('title');
		if($titles->length > 0){ 
			foreach($titles as $title){
				$title = $title->textContent;
			}
		}
		$embed_code1 = $src;
		//Youtube code
		if (strpos($src, 'youtube') !== false) {
			$videoid = str_replace("https://www.youtube.com/embed/",'',$src);
			$video_link = $title.'https://youtu.be/'.$videoid.'<span class="icon-mark pull-right" id="embedHide" data-value="'.$src.'" onclick="embedCode(this);"><img src="'.Yii::$app->homeUrl.'images/video_icon.png" alt=""></span>';
			$video_link_only = '<span class="icon-mark pull-right" id="embedHide" data-value="'.$src.'" onclick="embedCode(this);"><img src="'.Yii::$app->homeUrl.'images/video_icon.png" alt=""></span>';
		}else{
			$videoid = str_replace("https://player.vimeo.com/video/",'',$src);
			$video_link = $title.'https://vimeo.com/'.$videoid.'<span class="icon-mark pull-right" id="embedHide" data-value="'.$src.'" onclick="embedCode(this);"><img src="'.Yii::$app->homeUrl.'images/video_icon.png" alt=""></span>';
			$video_link_only = '<span class="icon-mark pull-right" id="embedHide" data-value="'.$src.'" onclick="embedCode(this);"><img src="'.Yii::$app->homeUrl.'images/video_icon.png" alt=""></span>';
		}
		$video_array['video_img'] = $video_link;
		$video_array['iframelink'] = $embed_code;
		$video_array['video_link_only'] = $video_link_only;
		/****** youtube code ends *****/
		echo json_encode($video_array);		
	}
	public function actionEmbeddisplayUrl($embed_code){
		//get the src url
		//fetch the meta image from the url response
		$video_array = [];
		$iframelink = '<iframe src="'.$embed_code.'" width="510" height="320" frameborder="0" allowfullscreen></iframe>';
		$video_array['iframelink'] = $iframelink;
		echo json_encode($video_array);		
	}
	
	/**
	 * Save a screenshot of the qard
	 * Using html2canvas
	 * Saves to uploads/qards folder
	 * Returns filename or error
	 */
	public function actionSaveBlob(){

		define('UPLOAD_DIR', 'uploads/qards/');
		$post_body = file_get_contents('php://input');
		$img = $_POST['img'];
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = 'uploads/qards/' . uniqid() . '.png';
		$success = file_put_contents($file, $data);
		print $success ? $file : 'Unable to save the file.';
	
	}
	
    /**
     * Finds the Qard model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Qard the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Qard::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }     
    public function actionTest() {	
		return $this->render('test');	
    }
    public function actionWyiswyg() {	
		return $this->render('wyiswyg');	
    }
     public function isMobile(){
         return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    public function beforeAction($action)
    {            
	if ($action->id == 'url' ) {
	    $this->enableCsrfValidation = false;
	}

	return parent::beforeAction($action);
    }
    
 
    /**
     * Uploads the document
     * @return uploaded file name
     */    
        public function actionUrl(){
           
                if (Yii::$app->request->isAjax) {  
                     $uploaded = array(); 
                     if(isset($_FILES['files']['tmp_name'])){
                        
                        // Number of uploaded files
                        $num_files = count($_FILES['files']['tmp_name']);
                        $upload_dir = Yii::$app->basePath.'/web/uploads/docs/';
                        /** loop through the array of files ***/
                        for($i=0; $i < $num_files;$i++)
                        {
                           
                           // copy the file to the specified dir 
                             $file =  str_replace(' ', '_',  $_FILES["filename"]['name']);
                             $temp = explode(".", $_FILES["filename"]["name"]);
                            $newfilename = $file;
                           if(move_uploaded_file($_FILES['filename']['tmp_name'],$upload_dir.'/'.$newfilename))
                                {
                               
                                     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                                        return [
                                           'code' => $file,//$_FILES['filename']['name'],
                                        ];
                                   
                                }
                               
                            
                        }
                    }                    
               }
        }
     /**
     * Uploads the document
     * @return uploaded file name
     */ 
        public function actionSimple(){ 
           if (Yii::$app->request->isAjax) {                 
                  if($_FILES["file"]['name']){

                            $move = Yii::$app->basePath.'/web/uploads/docs/';    
                            $file =  str_replace(' ', '_',  $_FILES["file"]['name']);
                            $moveto = $move.$_FILES["file"]['name'];
                            $temp = explode(".", $_FILES["file"]["name"]);
                            $newfilename = $file;
                            $_FILES["file"]['tmp_name'];
                            $_FILES["file"]['size'];
                            $_FILES['file']['error'];
                                 if(file_exists($move.$_FILES["file"]['name'])) {
                                      //chmod($move.$_FILES["file"]['name'],0755); //Change the file permissions if allowed
                                      unlink($move.$_FILES["file"]['name']); //remove the file
                                  }
                            move_uploaded_file($_FILES['file']['tmp_name'], $move.$newfilename);
                            $prof_img_path =  $_FILES["file"]['name'];
//         //                   $profile->temp_image = "uploads/".$prof_img_path; 
//         //                   $profile->save(false);
                             \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                             return [
                                 'code' => $file,//$_FILES["file"]['name'],
                             ];
     }}
           }
           
    public function actionGenerateQardImage($qard_id){
		
		include("lib/GrabzItClient.class.php");
		$grabzIt = new GrabzItClient("NWFkMzlhNTExMGVmNDQ2MzkxZjIxZTA4ZDVhYjQxZTc=", "Jn0kaWU/QD8MFGNOaw8/Gmg/Pz8/BT8SMj8hHj8/U2Y=");
		
		// To take a image screenshot		//$grabzIt->SetImageOptions("http://wordpressmonks.com/works/qarddeck/web/qard/create?theme_id=2",null,-1,-1,null,null,'jpg',0,'add-block'); 	
		
		
		$url = 'http://wordpressmonks.com/works/qarddeck/web/qard/view?id='.$qard_id;
		
		$grabzIt->SetImageOptions($url, $customId = null, $browserWidth = 400, $browserHeight = 800, $width = null, $height = null, $format = 'png', $delay = null, $targetElement = 'qard'.$qard_id, $requestAs = 0, $customWaterMarkId = null, $quality = 100, $country = null); 
	
		
		/* Arivazhagan Change Base Url Testing $grabzIt->SetImageOptions('http://wordpressmonks.com/works/qarddeck/web/qard/view?id='.$qard_id, $customId = null, $browserWidth = 400, $browserHeight = 800, $width = null, $height = null, $format = 'png', $delay = null, $targetElement = 'qard'.$qard_id, $requestAs = 0, $customWaterMarkId = null, $quality = 100, $country = null); 
		 */
		//$grabzIt->SetImageOptions('http://wordpressmonks.com/works/qarddeck/web/qard/view?id='.$qard_id, $customId = null, $browserWidth = 400, $browserHeight = 800);
		
		$directory = \Yii::$app->basePath."/web/uploads/qards";

		$filepath = $directory."/".$qard_id.".png";
		$grabzIt->SaveTo($filepath);
		return $filepath;
	} 
	
 public function actionDeleteQard($id)
    {	
     $qard = $this->findModel($id);
	 
	  if($qard)
	  {
		  $qard->status = 2;
		  $qard->save(false);
	  }	  
	  if(\Yii::$app->user->id)
			return $this->redirect(['my-qards']); 
	  else
			return $this->redirect(['index']); 
    }
	
	
	   /**
     * Generate the qards feed html for a request.
     * @param integer $offset and $limit
     * @return html
     */
    public function getQardsfeedsearch($offset,$limit,$type,$search){
		$feed = [];

			 if(!empty($offset))
				$offval =" OFFSET ".$offset;
			else
				$offval ="";
			
		$connection = Yii::$app->getDb(); 
		$command = $connection->createCommand('SELECT * FROM `qard` q, `qard_tags` qt WHERE q.qard_id = qt.qard_id and q.`status`=1 and qt.`tag_id`='.$search.' ORDER BY q.`last_updated_at` DESC limit '.$limit.$offval);
		$qards = $command->queryAll(); 
	
		//get html feed
		foreach($qards as $qard){
			$model = Qard::findOne([$qard['qard_id']]);									 
			$modelFeed = $model->getQardHtml($type);				
			if( $modelFeed != '')
				$feed[] = $modelFeed;
		}
		
		return	$feed;
	}
	/**
	 * Deck feed function
	 * @param integer $offset,$limit
	 * @return html
	 */	
	public function getDecksfeedsearch($offset,$limit,$search){
		$feed = [];

			 if(!empty($offset))
				$offval =" OFFSET ".$offset;
			else
				$offval =""; 
		
		$connection = Yii::$app->getDb(); 						
		$command = $connection->createCommand('SELECT * FROM `deck` d, `deck_tags` dt where d.`deck_id` = dt.`deck_id` and dt.`tag_id`='.$search.' ORDER BY d.`created_at` DESC limit '.$limit.$offval);
		$decks = $command->queryAll(); 
						
		//get html feed
		foreach($decks as $deck){
			$model = Deck::findOne([$deck['deck_id']]);
			$modelFeed = $model->getDeckHtml();
			if( $modelFeed != '')
				$feed []= $modelFeed;
		}
		return $feed;		
	}
  
	 /**
     * Follow the User
     * @return mixed
     */
	
	public function actionFollowuser()
    {			
	
	 $userid = $_POST['userid'];
	 $followerid = $_POST['followuserid'];
		if(!empty($userid) && !empty($followerid))
		{
		$connection = Yii::$app->getDb();
		
		$connection->createCommand()
		->insert('follower', [
				'user_id' => $userid,
				'follower_id' =>$followerid,])
		->execute();
			return true;
		}		
    }
	
	  /**
     * Unfollow the User
     * @return mixed
     */
	 
	public function actionUnfollowuser()
    {			
	
	 $userid = $_POST['userid'];
	 $followerid = $_POST['followuserid'];
		if(!empty($userid) && !empty($followerid))
		{
		$connection = Yii::$app->getDb();		
		$connection	->createCommand()
			->delete('follower',  [
				'user_id' => $userid,
				'follower_id' =>$followerid,] )
			->execute();
			return true;
		}		
    }
	
	public function actionRemoveQardDeck()
    {			
	
	 $qard_deck_id = $_POST['qard_deck_id'];
	 if(!empty($qard_deck_id))
		{
		$connection = Yii::$app->getDb();		
		$connection	->createCommand()
			->delete('qard_deck',  [
				'qd_id' => $qard_deck_id,
				] )
			->execute();
			return true;
		}	 
    }
	
	public function actionCreateDeckQard($deck_id)
    {					
		return $this->redirect(['theme/select-theme?deck_id='.$deck_id]);
    }
	
	public function actionDeckQardTheme($deck_id,$theme_id)
    {							
		$user_id = \Yii::$app->user->id;
		$deck_id = $deck_id;
		$theme_id = $theme_id;
	
		if($user_id)
		{
			$model = new Qard;
			$model->qard_theme = $theme_id;
			$model->user_id = $user_id;
			$model->status = 9;
			$model->qard_privacy = 1;	
			$model->save();  
			$qard_id = $model->qard_id;			
			$model2 = new QardDeck;
			$model2->qard_id = $qard_id;
			$model2->deck_id = $deck_id;
			$model2->save();			
			return $this->redirect(['qard/edit?id='.$qard_id]); 						
		} else 
		{
			return $this->redirect(['deck/manage?id='.$deck_id]);
		}				
    }
	
	public function actionTempdelete()
    {	
		 $id = Yii::$app->request->post('qardid');
		 $qard = $this->findModel($id);		
		if($qard)
		{
		  $qard->status = 2;
		  $qard->save(false);
		 
		}	   
		 echo "Deleted Successfully!!!."; 
    }
	
}