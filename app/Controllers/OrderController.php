<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Description of User
 *
 * @author nitins
 */
class OrderController
{

    public $c;

    public function __construct($c)
    {
        $this->c = $c;
    }

    public function index(Request $request, Response $response)
    {
        //load the modle class
        $orders_model = new \App\Models\Order_model($this->c->db);
        //call the function to get list of users
        $orders = $orders_model->orders();
        $output['message'] = "success";
        $output['data'] = $orders;
        return $response->withJson($output, 200);
    }

    public function show(Request $request, Response $response)
    {
        //die('show');
        //retive the parameter from url
        $order_guid = $request->getAttribute('order_guid');
        //load the modle class
        $orders_model = new \App\Models\Order_model($this->c->db);
        $order = $orders_model->get_order_by_guid($order_guid);
        if (is_null($order))
        {
            $output['message'] = "error";
            $output['data'] = [
                'order_guid' => "order guid is not valid"
            ];
            return $response->withJson($output, 403);
        }
        else
        {
            $output['message'] = "success";
            $output['data'] = $order;
            return $response->withJson($output, 200);
        }
    }

    public function create(Request $request, Response $response)
    {
        $post = $request->getParsedBody();
        if ($request->getAttribute('has_errors'))
        {
            $errors = $request->getAttribute('errors');
            $output['message'] = "error";
            $output['data'] = $errors;
            return $response->withJson($output, 403);
        }
        else
        {
            //load the modle class
            $user_model = new \App\Models\User_model($this->c->db);
            $order_model = new \App\Models\Order_model($this->c->db);

            $user_guid = $post['user_guid'];
            $order_total = $post['order_total'];
            $user = $user_model->get_user_by_guid($user_guid);
            if (is_null($user))
            {
                $output = [
                    'message' => "error",
                    'data' => [
                        'user_guid' => "user guid is not valid"
                    ],
                ];
                return $response->withJson($output, 403);
            }
            else
            {
                $order = $order_model->create_order($user_guid, $order_total);
                $output['message'] = "success";
                $output['data'] = $order;
                return $response->withJson($output, 200);
            }
        }
    }

    public function update(Request $request, Response $response)
    {
        //retive the parameter from url
        $post = $request->getParsedBody();

        //retive the parameter from url
        $order_guid = $request->getAttribute('order_guid');
        //load the modle class
        $order_model = new \App\Models\Order_model($this->c->db);
        $order = $order_model->get_order_by_guid($order_guid);
        if (empty($order_guid))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'order_guid' => "order guid is required"
                ],
            ];
            return $response->withJson($output, 403);
        }
        elseif (is_null($order))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'order_guid' => "order guid is not valid"
                ],
            ];
            return $response->withJson($output, 403);
        }
        elseif ($request->getAttribute('has_errors'))
        {
            $errors = $request->getAttribute('errors');
            $output['message'] = "error";
            $output['data'] = $errors;
            return $response->withJson($output, 403);
        }
        else
        {
            $status = $post['status'];

            $order = $order_model->update_order_by_guid($order_guid, $status);
            $output = [
                'message' => "success",
                'data' => $order,
            ];
            return $response->withJson($output, 200);
        }
    }

    public function delete(Request $request, Response $response)
    {
        //retive the parameter from url
        $order_guid = $request->getAttribute('order_guid');
        //load the modle class
        $order_model = new \App\Models\Order_model($this->c->db);
        $order = $order_model->get_order_by_guid($order_guid);
        if (empty($order_guid))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'order_guid' => "order guid is required"
                ],
            ];
            return $response->withJson($output, 403);
        }
        elseif (is_null($order))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'order_guid' => "order guid is not valid"
                ],
            ];
            return $response->withJson($output, 403);
        }
        else
        {
            $order_model->delete_order_by_guid($order_guid);
            $output = [
                'message' => "success",
                'data' => [],
            ];
            return $response->withJson($output, 200);
        }
    }

}
