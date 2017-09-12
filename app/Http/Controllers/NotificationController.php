<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\Sponsors;
use Request;
use DB;
use Redirect;
use Auth;
use View;

class NotificationController extends Controller
{
    public function createnotification()
    {
    	return View('notifications.create');
    }

    public function seenNotifications()
    {
        if (Auth::check()) {
            

        $notification = DB::table('notifications')
            ->where('id_user', Auth::user()->id)
            ->where('seen', 'N')
            ->get();

            if (!is_null($notification)) {
                foreach ($notification as $not) {
                    DB::table('notifications')->where('id_user', Auth::user()->id)->update(['seen' => 'Y']);
                }

                return "done";
            }else{

                return "error";
            }


        }
    }

    public function seen()
    {
        if (strpos(Request::get('id'), ',') === false) {
            $comment = Notifications::find(Request::get('id'));
            $comment->seen = 'Y';
            $comment->save();
        } else {
            $ids = explode(',', Request::get('id'));
            $comments = Notifications::whereIn('id', $ids)->get();
            foreach ($comments as $comment) {
                $comment->seen = 'Y';
                $comment->save();
            }
            
        }
        return "Notificación vista";
    }

     public function takeSponsors()
    {
        return Sponsors::all();
    }

    public function notifications()
    {
        $queryvid = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'like')
        ->wherenotNull('id_video')
        ->orderBy('id_video', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        $querypost = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'post')
        ->wherenotNull('id_comment')
        ->orderBy('id_comment', 'desc')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryview = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'view')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryvotes = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'votes')
        ->orderBy('created_at', 'desc')
        ->get();

       $querytags = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'tag')
        ->orderBy('created_at', 'desc')
        ->get();

        $queryvideos = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->where('type', 'video')
        ->orderBy('created_at', 'desc')
        ->get();

        $notification = DB::table('notifications')
        ->where('id_user', Auth::user()->id)
        ->whereNull('type')
        ->orderBy('created_at', 'desc')
        ->get();

        $special = array();
        $special[] = $this->formatPostNoti($querypost);
        $special[] = $this->formatVideoNoti($queryvid);
        $special[] = $this->formatNoti($notification);
        $special[] = $this->formatNoti($querytags);
        $special[] = $this->formatVideoNot($queryvideos);
        $special[] = $this->formatViewNoti($queryview);
        $special[] = $this->formatVideoVote($queryvotes);
        
        $final = array();

        $merged = array();

        foreach ($special as $sp) {
            foreach ($sp as $val) {
                $final[$val['date']] = $val;
            }
        }
        
        krsort($final);

        foreach ($final as $sp) {
                $merged[] = $sp;

        }

        $sponsors = $this->takeSponsors();
        $comments = DB::table('comments')->get();
        $videos = DB::table('videos')->get();
        $musicians = DB::table('musicians')->get();

        return View::make('/notifications', array('sponsors' => $sponsors,'special' => $final, 'merged' => $merged, 'comments' => $comments, 'videos' => $videos, 'musicians' => $musicians));
    }

   private function formatVideoNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'video';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas les ha gustado tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatPostNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_comment) {
                $video[$vnoti->id_comment]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_comment]['date'] = $date;
                $count = 1;
                $reminder = $vnoti->id_comment;
                $video[$vnoti->id_comment]['type'] = 'post';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_comment]['seen'] = 'N';
            }
            
            $video[$vnoti->id_comment]['id'] = $vnoti->id_comment;
            if ($count > 1) {
                $video[$vnoti->id_comment]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_comment]['text'] = ''.$count.' personas han publicado en tu muro';
            } else {
                $video[$vnoti->id_comment]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_comment]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id) {
                $video[$vnoti->id]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id;
                $video[$vnoti->id]['type'] = '';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id]['seen'] = 'N';
            }
            
            $video[$vnoti->id]['id'] = $vnoti->id;
            $video[$vnoti->id]['id_noti'] = $vnoti->id;
            $video[$vnoti->id]['text'] = $vnoti->comment;
            $video[$vnoti->id]['href'] = $vnoti->href;

        }

        return $video;
    }

    private function formatViewNoti($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'view';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas han visto tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }

    private function formatVideoVote($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type'] = 'votes';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas han votado por tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }


        return $video;
    }

    private function formatVideoNot($noti)
    {
        $video = array();
        $count = 0;
        $reminder = '';
        foreach ($noti as $vnoti) {
            if ($reminder != $vnoti->id_video) {
                $video[$vnoti->id_video]['seen'] = 'Y';
                $date =str_replace([' ', ':', '-'] , '', $vnoti->created_at);
                $video[$vnoti->id_video]['date'] = $date; 
                $count = 1;
                $reminder = $vnoti->id_video;
                $video[$vnoti->id_video]['type']  = 'video';
                $video[$vnoti->id_video]['route'] = '/mobile_app/video_reproductor.html?id='.$vnoti->id_video.'';
            }
            if ($vnoti->seen == 'N') {
                $video[$vnoti->id_video]['seen'] = 'N';
            }
            
            $video[$vnoti->id_video]['id'] = $vnoti->id_video;
            if ($count > 1) {
                $video[$vnoti->id_video]['id_noti'] .= ','.$vnoti->id;
                $video[$vnoti->id_video]['text'] = 'A '.$count.' personas les ha gustado tu video';
            } else {
                $video[$vnoti->id_video]['id_noti'] = $vnoti->id;
                $video[$vnoti->id_video]['text'] = $vnoti->comment;
            }
            
            $count++;

        }
        return $video;
    }
}
