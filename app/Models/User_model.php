<?php

namespace App\Models;

/**
 * Description of User
 *
 * @author nitins
 */
class User_model
{

    protected $db = false;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * 
     * @return type
     */
    public function users()
    {
        $sql = "SELECT user_guid, first_name, last_name, email, phone FROM users";
        $query = $this->db->query($sql);
        $result = [];
        while ($row = $query->fetch_assoc())
        {
            $result[] = $row;
        }
        return $result;
    }

    /**
     * 
     * @param type $user_guid
     * @return type $user 
     */
    public function get_user_by_guid($user_guid)
    {

        $sql = "SELECT user_guid, first_name, last_name, email, phone FROM users WHERE user_guid='$user_guid'";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    /**
     * 
     * @param type $user_guid
     * @param type $first_name
     * @param type $last_name
     * @param type $email
     * @param type $phone
     * @return type
     */
    public function update_user_by_guid($user_guid, $first_name, $last_name, $email, $phone)
    {
        $sql = "UPDATE users SET first_name='$first_name', last_name='$last_name', email='$email', phone='$phone' WHERE user_guid='$user_guid'";
        $query = $this->db->query($sql);
        return $this->get_user_by_guid($user_guid);
    }

    /**
     * 
     * @param type $first_name
     * @param type $last_name
     * @param type $email
     * @param type $phone
     * @return type
     */
    public function create_user($first_name, $last_name, $email, $phone)
    {
        $user_guid = uniqid();
        $sql = "INSERT INTO users SET user_guid='$user_guid', first_name='$first_name', last_name='$last_name', email='$email', phone='$phone'";
        $query = $this->db->query($sql);
        return $this->get_user_by_guid($user_guid);
    }

    /**
     * 
     * @param type $user_guid
     * @return type $user 
     */
    public function delete_user_by_guid($user_guid)
    {
        $sql = "DELETE FROM users WHERE user_guid='$user_guid'";
        $query = $this->db->query($sql);
    }

}
