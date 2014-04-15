<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../../../vendor/autoload.php';
use OpenCloud\Rackspace;
 
abstract class RS_Service {
    
    protected $service;
    protected $client;
    
    const RS_USERNAME = 'RACKSPACE_USERNAME';
    const RS_KEY =      'RACKSPACE_KEY';
    
    public function __construct() {
        $client = new Rackspace(Rackspace::US_IDENTITY_ENDPOINT, array(
            'username' => self::RS_USERNAME,
            'apiKey'   => self::RS_KEY
        ));
        $this->_setClient($client);
    }

    public function service() {
        return $this->service;
    }
    
    public function client() {
        return $this->client;
    }
    
    protected function _setService($s) {
        $this->service = $s;
    }
    
    protected function _setClient($c) {
        $this->client = $c;
    }
    
    public function auth_client() {
        return $this->client->authenticate();
    }
    
}