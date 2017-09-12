<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// we will use Mail namespace
use Mail;
use Redirect;

class MailController extends Controller
{
	 // first, we create function for send Basics email
    public function basic_email(){
        $data=['name'=>'YLMM'];
        Mail::send(['text'=>'mail'], $data, function($message){
            $message->to('sucri93@gmail.com','Susana Lares')->subject('YLMM - VALIDACIÓN DE EMAIL');
            $message->from('susana@trenders.com.ar','YLMM');
        });
        return Redirect::to('/?msg=Validá tu email');
      }

      public function html_email(){
      $data=['name'=>'YLMM'];
      Mail::send(['text'=>'mail'], $data, function($message){
          $message->to('sucri93@gmail.com','Susana Lares')->subject('YLMM - VALIDACIÓN DE EMAIL');
          $message->from('susana@trenders.com.ar','YLMM');
      });
      return Redirect::to('/?msg=Validá tu email');
    }

    //create new function to send mail with attachment Mail
      public function attachment_email(){
        $data=['name'=>'Harison matondang'];
        Mail::send(['text'=>'mail'], $data, function($message){
            $message->to('sucri93@gmail.com','Susana Lares')->subject('YLMM - VALIDACIÓN DE EMAIL');
            // add attach here
            // i have a image file on Laravel project
            $message->attach('C:serverhtdocshckrcompublicuploadsharison.jpg');
            $message->attach('C:serverhtdocshckrcompublicuploadssector-code.jpg');
            $message->from('susana@trenders.com.ar','YLMM');
        });
        echo 'HTML Email was sent!';
      }
}
