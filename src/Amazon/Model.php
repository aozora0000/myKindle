<?php
namespace Amazon;
class Model {
    protected $api;
    public function __construct(Api $api) {
        $this->api = $api;
    }

    public function getListAll() {
        return $this->api->get();
    }
}
