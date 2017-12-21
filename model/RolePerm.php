<?php
class RolePerm
{
    private $roleId;
    private $permId;

    public function __construct($roleId, $permId){
        $this->roleId = $roleId;
        $this->permId = $permId;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM role_perm');

        foreach($req->fetchAll() as $role_perm) {
            $list[] = new RolePerm($role_perm['roleId'], $role_perm['permId']);
        }
        return $list;
    }

    public static function find($roleId, $permId) {
        $db = DBConnection::getInstance();
        $roleId = intval($roleId);
        $permId = intval($permId);
        $req = $db->prepare('SELECT * FROM role WHERE roleId = :roleId AND permId = :permId');
        $req->execute(array('roleId' => $roleId, 'permId' => $permId));
        $role_perm = $req->fetch();

        return new RolePerm($role_perm['roleId'], $role_perm['permId']);
    }

    public static function delete($roleId, $permId) {
        $db = Db::getInstance();
        $roleId = intval($roleId);
        $permId = intval($permId);
        $req = $db->prepare('DELETE FROM role WHERE roleId = ::roleId AND permId = :permId');
        $req->execute(array('roleId' => $roleId, 'permId' => $permId));
    }

    public function getRoleId(){
        return $this->roleId;
    }

    public function getPermId(){
        return $this->permId;
    }
}