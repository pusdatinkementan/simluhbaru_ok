<?php

namespace App\Models;

use CodeIgniter\Model;
use \Config\Database;

class RolemenuModel extends Model
{
    protected $table      = 'user_access_menu';

    protected $primaryKey = 'id';
    protected $returnType     = 'array';
    //protected $useSoftDeletes = true;

    protected $allowedFields = ['role_id', 'menu_id'];
    protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getUserRoleAll()
    {
        $query = $this->db->query("SELECT a.*, b.id as aksesid, b.menu_id, c.menu FROM user_role a join user_access_menu b on a.role_id = b.role_id join user_menu c on b.menu_id = c.id ORDER BY a.role ASC");
        $row = $query->getResultArray();
        return $row;
    }

    public function getRole()
    {
        $query = $this->db->query("SELECT * FROM user_role ORDER BY role_id");
        $row = $query->getResultArray();
        return $row;
    }

    public function getSubMenuAll()
    {
        $query = $this->db->query("SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id`");
        $row = $query->getResultArray();
        return $row;
    }

    public function getSubMenuById($id)
    {
        $query = $this->db->query("SELECT `user_sub_menu`.*, `user_menu`.`menu`
        FROM `user_sub_menu` JOIN `user_menu`
        ON `user_sub_menu`.`menu_id` = `user_menu`.`id` WHERE `user_sub_menu`.`id` = $id");
        $row = $query->getRow();
        return json_encode($row);
    }

    public function updateSubmenu($id, $data)
    {
        $db = db_connect();
        $builder = $db->table('user_sub_menu');
        $builder->where('id', $id)->update($data);
    }

    public function saveSubMenu($data)
    {
        $db = db_connect();
        $builder = $db->table('user_sub_menu');
        $builder->insert($data);
    }

    public function deleteSubMenu($id)
    {
        $db = db_connect();
        $builder = $db->table('user_sub_menu');
        $builder->where('id', $id)->delete();
        // $builder->delete($id);
    }

    public function getMenuById($id)
    {
        $query = $this->db->query("SELECT * FROM user_menu WHERE id = '" . $id . "'");
        $row = $query->getRow();
        return json_encode($row);
    }
}
