<?php
class Role
{
    private $roleId;
    private $roleName;

    public function __construct($roleId, $roleName){
        $this->roleId = $roleId;
        $this->roleName = $roleName;
    }

    public static function all() {
        $list = [];
        $db = DBConnection::getInstance();
        $req = $db->query('SELECT * FROM role');

        foreach($req->fetchAll() as $role) {
            $list[] = new Role($role['roleId'], $role['roleName']);
        }
        return $list;
    }

    public static function find($roleId) {
        $db = DBConnection::getInstance();
        $accountId = intval($roleId);
        $req = $db->prepare('SELECT * FROM role WHERE roleId = :roleId');
        $req->execute(array('roleId' => $roleId));
        $roleId = $req->fetch();
        return new Role($roleId['roleId'], $roleId['roleName']);
    }

    public static function delete($roleId) {
        $db = Db::getInstance();
        $accountId = intval($roleId);
        $req = $db->prepare('DELETE FROM role WHERE roleId = :roleId');
        $req->execute(array('roleId' => $roleId));
    }

    public function getRoleId(){
        return $this->roleId;
    }

    public function getRoleName(){
        return $this->roleName;
    }
}
