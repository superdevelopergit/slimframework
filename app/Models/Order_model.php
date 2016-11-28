<?php

namespace App\Models;

/**
 * Description of User
 *
 * @author nitins
 */
class Order_model
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
    public function orders()
    {
        $sql = "SELECT order_guid, user_id, order_total, created_at, status FROM orders";
        $query = $this->db->query($sql);
        $result = [];
        while ($row = $query->fetch_assoc())
        {
            $row['user'] = $this->get_user_by_id($row['user_id']);
            unset($row['user_id']);
            $result[] = $row;
        }
        return $result;
    }

    /**
     * 
     * @param type $order_guid
     * @return type $order 
     */
    public function get_order_by_guid($order_guid)
    {
        $sql = "SELECT order_guid, user_id, order_total, created_at, status FROM orders WHERE order_guid='$order_guid'";
        $query = $this->db->query($sql);
        $order = $query->fetch_assoc();
        if (!is_null($order))
        {
            $order['user'] = $this->get_user_by_id($order['user_id']);
            unset($order['user_id']);
        }
        return $order;
    }

    /**
     * 
     * @param type $user_guid
     * @return type $user 
     */
    public function get_user_by_id($user_id)
    {

        $sql = "SELECT user_guid, first_name, last_name, email, phone FROM users WHERE user_id='$user_id'";
        $query = $this->db->query($sql);
        return $query->fetch_assoc();
    }

    public function create_order($user_guid, $order_total)
    {
        $order_guid = uniqid();
        $sql = "SELECT user_id FROM users WHERE user_guid='$user_guid'";
        $query = $this->db->query($sql);
        $user = $query->fetch_assoc();

        $sql = "INSERT INTO orders SET order_guid='$order_guid', user_id='" . $user['user_id'] . "',order_total='$order_total', created_at='" . gmdate('Y-m-d H:i:s') . "', status='ORDERED'";
        $query = $this->db->query($sql);
        return $this->get_order_by_guid($order_guid);
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
    public function update_order_by_guid($order_guid, $status)
    {
        $sql = "UPDATE orders SET status='$status' WHERE order_guid='$order_guid'";
        $query = $this->db->query($sql);
        return $this->get_order_by_guid($order_guid);
    }

    /**
     * 
     * @param type $user_guid
     * @return type $user 
     */
    public function delete_order_by_guid($order_guid)
    {
        $sql = "DELETE FROM orders WHERE order_guid='$order_guid'";
        $query = $this->db->query($sql);
    }

}
