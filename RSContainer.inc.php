<?php
use OpenCloud\Common\Constants\Size;

class RSContainer extends RS_CloudFilesService {
    
    protected $container = null;
    protected $objects = null;
    protected $context = null;
    
    public function __construct() {
        parent::__construct();
    }

    public function create($n) {
        $this->_setContainer($this->service->createContainer($n));
        return $this->end();
    }
    
    public function load($n) {
        $this->_setContainer($this->service->getContainer($n));
        return $this->end();
    }
    
    public function get() {
        return $this->_getContainer();
    }
    
    public function delete($delete_all = true) {
        $this->_getContainer()->delete($delete_all);
        $this->_setContainer(null);
        return $this->end();
    }
    
    public function emptyContainer() {
        $this->_getContainer()->deleteAllObjects();
        return $this->end();
    }
    
    public function setSizeGB($s) {
        $this->_setSizeGB($s);
        return $this->end();
    }
    
    public function sizeGB() {
        return $this->_getSizeGB();
    }
    
    public function setMetadata($d) {
        $this->_setMetadata($d);
        return $this->end();
    }
    
    public function getMetadata() {
        return $this->_getMetadata();
    }
    
    public function bytesUsed() {
        return $this->_bytesUsed();
    }
    
    public function objects() {
        $this->objects = $this->_getContainer()->objectList();
        return $this->objects;
    }
    
    public function qobjects($a) {
        $this->objects = $this->_getContainer()->listObjects($a);
        return $this->objects;
    }
    
    public function upload($rs_fn, $obj_data, $meta_data = null) {
        return $this
            ->_getContainer()
                ->uploadObject($rs_fn, $obj_data, $meta_data);
    }
    
    /* =======================
        OBJECT CONTEXT
    ========================== */
    
    public function o($n) {
        $obj = $this->_getContainer()->getObject($n);
        $this->context = $obj;
        return $this->end(false);
    }
    
    public function oBody() {
        return $this->context->getContent();
    }
    
    public function oName() {
        return $this->context->getName();
    }
    
    public function oSize() {
        return $this->context->getContentLength();
    }
    
    public function oMetadata() {
        return $this->context->getMetadata();
    }
    
    public function oDelete() {
        $this->context->delete();
        return $this->end();
    }
    
    public function end($back = true) {
        if ($back) {
            $this->context = null;
        }
        return $this;
    }
    
    /* ==========================
        PROTECTED
    ========================== */
    
    /* Container */
    protected function _setContainer($c) {
        $this->container = $c;
    }
    
    protected function _getContainer() {
        return $this->container;
    }
    
    /* Size */
    protected function _setSizeGB($s) {
        $this->container->setBytesQuota($s * Size::GB);
    }
    
    protected function _getSizeGB() {
        return $this->container->getBytesQuota();
    }
    
    /* Metadata */
    protected function _setMetadata($d) {
        $this->container->saveMetadata($d);
    }
    
    protected function _getMetadata() {
        return $this->container->getMetadata();
    }
    
    protected function _bytesUsed() {
        return $this->container->getMetadata()->getProperty("bytes-used");
    }
    
}