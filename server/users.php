<?php
/**
This php script implements

PHP Version 5+
@Author: Abayomi Apetu
*/
require 'DbHandlers.php';

class User
{
    /**
Object(class) properties.
Object(class) public properties.
     */
    public $id;
    public $username;
    public $name;
    public $email;
    public $mobile_phone;
    public $password;
    public $date_registered;
    public $role;
    public $status;

    public function _construct()
    {
        /* Todo, add code for system initialization here!*/
    }

    public function save()
    {
        $db = new DbHandlers();
        $sql = 'INSERT INTO users(';
        if (isset($this->id) && $this->id !== '') {
            $sql .= 'id';
        }
        if (isset($this->username) && $this->username !== '') {
            $sql .= ',username';
        }
        if (isset($this->name) && $this->name !== '') {
            $sql .= ',name';
        }
        if (isset($this->email) && $this->email !== '') {
            $sql .= ',email';
        }
        if (isset($this->mobile_phone) && $this->mobile_phone !== '') {
            $sql .= ',mobile_phone';
        }
        if (isset($this->password) && $this->password !== '') {
            $sql .= ',password';
        }
        if (isset($this->date_registered) && $this->date_registered !== '') {
            $sql .= ',date_registered';
        }
        if (isset($this->role) && $this->role !== '') {
            $sql .= ',role';
        }
        if (isset($this->status) && $this->status !== '') {
            $sql .= ',status';
        }
        $sql .= ') VALUES (';
        if (isset($this->id) && $this->id !== '') {
            $sql .= "'{$this->id}'";
        }
        if (isset($this->username) && $this->username !== '') {
            $sql .= ",'{$this->username}'";
        }
        if (isset($this->name) && $this->name !== '') {
            $sql .= ",'{$this->name}'";
        }
        if (isset($this->email) && $this->email !== '') {
            $sql .= ",'{$this->email}'";
        }
        if (isset($this->mobile_phone) && $this->mobile_phone !== '') {
            $sql .= ",'{$this->mobile_phone}'";
        }
        if (isset($this->password) && $this->password !== '') {
            $sql .= ",md5('{$this->password}')";
        }
        if (isset($this->date_registered) && $this->date_registered !== '') {
            $sql .= ",'".str_replace('.000Z', '', str_replace('T', ' ', $this->date_registered))."'";
        }
        if (isset($this->role) && $this->role !== '') {
            $sql .= ",'{$this->role}'";
        }
        if (isset($this->status) && $this->status !== '') {
            $sql .= ",'{$this->status}'";
        }
        $sql .= ')';
        $sql = str_replace('(,', '(', $sql);
        $savein = $db->executeQuery($sql);

        return $savein;
    }

    public function update($pvcol, $pval)
    {
        $db = new DbHandlers();
        $sql = 'UPDATE users SET ';
        if (isset($this->id) && $this->id !== '') {
            $sql .= " id = '{$this->id}'";
        }
        if (isset($this->username) && $this->username !== '') {
            $sql .= ", username = '{$this->username}'";
        }
        if (isset($this->name) && $this->name !== '') {
            $sql .= ", name = '{$this->name}'";
        }
        if (isset($this->email) && $this->email !== '') {
            $sql .= ", email = '{$this->email}'";
        }
        if (isset($this->mobile_phone) && $this->mobile_phone !== '') {
            $sql .= ", mobile_phone = '{$this->mobile_phone}'";
        }
        if (isset($this->password) && $this->password !== '') {
            $sql .= ", password = '{$this->password}'";
        }
        if (isset($this->date_registered) && $this->date_registered !== '') {
            $sql .= ", date_registered = '".str_replace('.000Z', '', str_replace('T', ' ', $this->date_registered))."'";
        }
        if (isset($this->role) && $this->role !== '') {
            $sql .= ", role = '{$this->role}'";
        }
        if (isset($this->status) && $this->status !== '') {
            $sql .= ", status = '{$this->status}'";
        }
        $sql .= " WHERE $pvcol = '$pval'";
        $sql = str_replace('SET ,', 'SET ', $sql);
        $upd = $db->executeQuery($sql);

        return $upd;
    }

    public function view($critcol = null, $critval = null)
    {
        $db = new DbHandlers();
        if (is_null($critcol)) {
            $sql = 'SELECT * from users order by id DESC';
        } else {
            $sql = "SELECT * from users WHERE $critcol ='{$critval}'";
        }
        $datasource = $db->getRowAssoc($sql);

        return $datasource;
    }

    public function signin($username, $passwd)
    {
        $db = new DbHandlers();
        $uend = strlen($username) - 1;
        if (strpos($username, '@') > -1 && strpos($username, '.') > -1) {
            $sql = "SELECT * FROM users WHERE email='".$username."' AND password=md5('".$passwd."')";
        } else {
            $sql = "SELECT * FROM users WHERE username='".$username."' AND password=md5('".$passwd."')";
        }

        $user = $db->getRowAssoc($sql);

        return $user;
    }

    public function delete($critcol, $critval)
    {
        $db = new DbHandlers();
        $sql = "DELETE FROM users WHERE $critcol ='{$critval}'";
        $d_out = $db->executeQuery($sql);

        return $d_out;
    }
}
