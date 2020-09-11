<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentsController extends Controller
{
    public function show()
    {
        $items = \DB::table('comments')->orderBy('id', 'desc')->get();
        
        return $items;
    }
    public function create()
    {
        $author = request('author');
        $text = request('text');

        $comment = ['author' => $author, 'text' => $text, 'time' => date("H:i"), 'date' => date("d.m.Y")];

        \DB::table('comments')->insert($comment);

        return $comment;
    }
}
