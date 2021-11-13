<?php

namespace App\Controllers;

use PDO;
use App\Models\Post;

class ApiController extends Controller
{
    public function index()
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        $post = new Post();
        $result = $post->getAllApi();

        if($result != 0) {
            header("Status: 200 OK");
            echo json_encode($result);
        } else {
            header("Status: 404 Not Found");
            echo json_encode(['message' => 'Pas de posts']);
        }

        // $count = $result->rowCount();

        // if($count > 0) {
        //     $result_array = [];
        //     $result_array['data'] = [];

        //     while($row = $result->fetch(PDO::FETCH_ASSOC)){
        //         extract($row);
        //         $row_item = [
        //             'id' => $id,
        //             'title' => $title,
        //             'content' => $content,
        //             'created_at' => $created_at
        //         ];

        //         array_push($result_array['data'], $row_item);
        //     }

        //     echo json_encode($result_array);
        // } else {
        //     echo json_encode(['message' => 'Pas de posts']);
        // }

    }
}