<?php

namespace App\Services;

use App\Services\Contracts\NotificationContract;
use App\Models\Notification;
use Yajra\DataTables\Facades\DataTables;

class NotificationService implements NotificationContract {

	public function getData()
	{
		$notifications = Notification::select(['user_id', 'type', 'title', 'message','is_read', 'notifications.created_at'])->with('user');
            return Datatables::of($notifications)
                    ->addColumn('user', function($notifications){
                        if(isset($notifications->user)) {
                            return $notifications->user->name;
                        }
                        return "";
                    })
                    ->editColumn('type', function($notifications) {
                        if($notifications->type == 1) return 'Custom';
                    })
                     ->editColumn('is_read', function($notifications) {
                        return ($notifications->is_read == 1) ? 'read':'unread';
                    })
                    ->make(true);
	}

    public function storeData($data){
        return Notification::insert($data);
    }
}