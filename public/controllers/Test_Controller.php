<?php
class Test_Controller extends Fusion\System\SystemController {

	public function index() {
		
		require_once(PLUGINS_DIR.'google-drive-api/src/Google/Client.php');
		require_once(PLUGINS_DIR.'google-drive-api/src/Google/Service.php');
		
		$client = new Google_Client();
		// Get your credentials from the console
		$client->setClientId('985655264456-k45madqbedn35ckv48f2prbhhphnttj4.apps.googleusercontent.com');
		$client->setClientSecret('oj8WvIxzh0bmgYESM32XKA9X');
		$client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
		$client->setScopes(array('https://www.googleapis.com/auth/drive'));
		
		$service = new Google_Service($client);
		
		$authUrl = $client->createAuthUrl();
		
		//Request authorization
		print "Please visit:\n$authUrl\n\n";
		print "Please enter the auth code:\n";
		$authCode = trim(fgets(STDIN));
		
		// Exchange authorization code for access token
		$accessToken = $client->authenticate($authCode);
		$client->setAccessToken($accessToken);
		
		//Insert a file
		$file = new Google_DriveFile();
		$file->setTitle('My document');
		$file->setDescription('A test document');
		$file->setMimeType('text/plain');
		
		$data = file_get_contents('document.txt');
		
		$createdFile = $service->files->insert($file, array(
			  'data' => $data,
			  'mimeType' => 'text/plain',
			));
		
		print_r($createdFile);

		
		$this->view('tests/index');
	}

	public function paginate() {
		$this->data['location'] = $this->model('welcome')->cities('zips');
		$data['main_content'] = $this->view('tests/paginate', $this->data);

	}

	public function xdebug() {
		$this->data['debug'] = '';
		$data['main_content'] = $this->view('tests/xdebug', $this->data);

	}

}