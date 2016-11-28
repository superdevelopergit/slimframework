<?php

namespace App\Controllers;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

/**
 * Description of User
 *
 * @author nitins
 */
class UserController
{

    public $c;

    public function __construct($c)
    {
        $this->c = $c;
    }

    public function index(Request $request, Response $response)
    {
        //load the modle class
        $users_model = new \App\Models\User_model($this->c->db);
        //call the function to get list of users
        $users = $users_model->users();
        $output['message'] = "success";
        $output['data'] = $users;
        return $response->withJson($output, 200);
    }

    public function show(Request $request, Response $response)
    {
        //retive the parameter from url
        $user_guid = $request->getAttribute('user_guid');
        //load the modle class
        $users_model = new \App\Models\User_model($this->c->db);
        $user = $users_model->get_user_by_guid($user_guid);
        if (is_null($user))
        {
            $output['message'] = "error";
            $output['data'] = [
                'user_guid' => "user guid is not valid"
            ];
            return $response->withJson($output, 403);
        }
        else
        {
            $output['message'] = "success";
            $output['data'] = $user;
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
            $users_model = new \App\Models\User_model($this->c->db);

            $first_name = $post['first_name'];
            $last_name = $post['last_name'];
            $email = $post['email'];
            $phone = $post['phone'];

            $user = $users_model->create_user($first_name, $last_name, $email, $phone);
            $output['message'] = "success";
            $output['data'] = $user;
            return $response->withJson($output, 200);
        }
    }

    public function update(Request $request, Response $response)
    {
        //retive the parameter from url
        $post = $request->getParsedBody();

        //retive the parameter from url
        $user_guid = $request->getAttribute('user_guid');
        //load the modle class
        $users_model = new \App\Models\User_model($this->c->db);
        $user = $users_model->get_user_by_guid($user_guid);
        if (empty($user_guid))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'user_guid' => "user guid is required"
                ],
            ];
            return $response->withJson($output, 403);
        }
        elseif (is_null($user))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'user_guid' => "user guid is not valid"
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
            $first_name = $post['first_name'];
            $last_name = $post['last_name'];
            $email = $post['email'];
            $phone = $post['phone'];

            $users_model->update_user_by_guid($user_guid, $first_name, $last_name, $email, $phone);
            $user = $users_model->get_user_by_guid($user_guid);
            $output = [
                'message' => "success",
                'data' => $user,
            ];
            return $response->withJson($output, 200);
        }
    }

    public function delete(Request $request, Response $response)
    {
        //retive the parameter from url
        $user_guid = $request->getAttribute('user_guid');
        //load the modle class
        $users_model = new \App\Models\User_model($this->c->db);
        $user = $users_model->get_user_by_guid($user_guid);
        if (empty($user_guid))
        {
            $output = [
                'message' => "error",
                'data' => [
                    'user_guid' => "user guid is required"
                ],
            ];
            return $response->withJson($output, 403);
        }
        elseif (is_null($user))
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
            $users_model->delete_user_by_guid($user_guid);
            $output = [
                'message' => "success",
                'data' => [],
            ];
            return $response->withJson($output, 200);
        }
    }

}
