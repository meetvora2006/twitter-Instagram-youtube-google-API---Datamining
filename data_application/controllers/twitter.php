<?php
session_start();

/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 * Please note that this sample controller is just an example of how you can use the library.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Twitter extends CI_Controller
{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct(); 
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');
		// Loading twitter configuration.
		$this->config->load('twitter');
		
		$this->load->helper('url');
		
		
		if( isset($_SESSION['access_token'])&&isset( $_SESSION['access_token_secret']))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $_SESSION['access_token'],  $_SESSION['access_token_secret']);
		}
		elseif(isset($_SESSION['request_token']) && isset($_SESSION['request_token_secret']))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $_SESSION['request_token'], $_SESSION['request_token_secret']);
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
	}
	
	/**
	 * Here comes authentication process begin.
	 * @access	public
	 * @return	void
	 */
	public function auth()
	{
		if(isset($_SESSION['access_token']) && isset($_SESSION['access_token_secret']))
		{ 
			// User is already authenticated. Add your user notification code here.
			redirect(base_url('/'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('index.php/twitter/callback'));
			
			$_SESSION['request_token'] = $request_token['oauth_token'];
			$_SESSION['request_token_secret'] = $request_token['oauth_token_secret'];
			

			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		
		
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
		
			if ($this->connection->http_code == 200)
			{
				
				
				$_SESSION['access_token'] = $access_token['oauth_token'];
				$_SESSION['access_token_secret'] = $access_token['oauth_token_secret'];
				$_SESSION['twitter_user_id'] = $access_token['user_id'];
				$_SESSION['twitter_screen_name'] = $access_token['screen_name'];
				
				
				
                 unset($_SESSION['request_token']);
				 unset($_SESSION['request_token_secret']);
				
				$userdata = $this->connection->get('account/verify_credentials');
				
				$this->load->model('twitter_model');

				$userid=$this->twitter_model->userinfo_insert($userdata);
				$_SESSION['id'] = $userid;
				
				

				redirect(base_url('/'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/'));
			}
		
	}
	
	/**
	 * Reset session data
	 * @access	private
	 * @return	void
	 */
	public function reset_session()
	{
	session_destroy(); 
	redirect(base_url('/'));
	}
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */