<?php

class Permission
{
    private $permId;
    private $permDesc;

    public function __construct($permId, $permDesc){
        $this->permId = $permId;
        $this->permDesc = $permDesc;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM permission');

        foreach($req->fetchAll() as $permission) {
            $list[] = new Permission($permission['permId'], $permission['permDesc']);
        }
        return $list;
    }

    public static function find($permId) {
        $db = DBConnection::getInstance();
        $permId = intval($permId);
        $req = $db->prepare('SELECT * FROM permission WHERE permId = :permId');
        $req->execute(array('permId' => $permId));
        $permission = $req->fetch();

        return new Permission($permission['permId'], $permission['permDesc']);
    }

    public static function delete($permId) {
        $db = Db::getInstance();
        $permId = intval($permId);
        $req = $db->prepare('DELETE FROM permission WHERE permId = :permId');
        $req->execute(array('permId' => $permId));
    }

    public function getPermId(){
        return $this->permId;
    }

    public function getPermDesc(){
        return $this->permDesc;
    }
}