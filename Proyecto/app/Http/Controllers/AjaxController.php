<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

 class AjaxController extends Controller {
     /**
      * Display a listing of the resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function index(Request $dato)
     {
       
        dd($dato);
        //return Response::json(array('data' => $dato)); 
        return response()->json($dato);
        //return['success'=>true, 'data'=> $dato];

        }
 } 