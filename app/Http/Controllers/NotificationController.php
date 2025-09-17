<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationController extends Controller
{
    /**
     * Get notifications for the authenticated user
     */
    public function index(Request $request): JsonResponse
    {
        $user = auth()->user();
        $limit = $request->get('limit', 10);
        $type = $request->get('type', 'all'); // all, unread, read

        $query = $user->notifications()->with('creator');

        if ($type === 'unread') {
            $query->unread();
        } elseif ($type === 'read') {
            $query->read();
        }

        $notifications = $query->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();

        // Add color and icon to each notification for the frontend
        $notifications->transform(function ($notification) {
            $notification->color = $notification->getColor();
            $notification->icon = $notification->getIcon();
            return $notification;
        });

        $unreadCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
        ]);
    }

    /**
     * Get unread notification count
     */
    public function unreadCount(): JsonResponse
    {
        $user = auth()->user();
        $count = NotificationService::getUnreadCount($user->id);
        
        return response()->json(['count' => $count]);
    }

    /**
     * Mark a notification as read
     */
    public function markAsRead(Request $request, int $id): JsonResponse
    {
        $success = NotificationService::markAsRead($id, auth()->id());
        
        if ($success) {
            return response()->json([
                'success' => true,
                'message' => __('notifications.notification_marked_read')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('common.error_occurred')
        ], 404);
    }

    /**
     * Mark all notifications as read
     */
    public function markAllAsRead(): JsonResponse
    {
        $count = NotificationService::markAllAsRead(auth()->id());
        
        return response()->json([
            'success' => true,
            'message' => __('notifications.all_marked_read'),
            'count' => $count
        ]);
    }

    /**
     * Mark a notification as unread
     */
    public function markAsUnread(Request $request, int $id): JsonResponse
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notification) {
            $success = $notification->markAsUnread();
            
            if ($success) {
                return response()->json([
                    'success' => true,
                    'message' => __('notifications.notification_marked_unread')
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => __('common.error_occurred')
        ], 404);
    }

    /**
     * Delete a notification
     */
    public function destroy(int $id): JsonResponse
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if ($notification) {
            $notification->delete();
            
            return response()->json([
                'success' => true,
                'message' => __('notifications.notification_deleted')
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => __('common.error_occurred')
        ], 404);
    }

    /**
     * Show all notifications page
     */
    public function showAll(Request $request): View
    {
        $user = auth()->user();
        $filter = $request->get('filter', 'all');
        
        $query = $user->notifications()->with('creator');
        
        // Apply filter
        switch ($filter) {
            case 'unread':
                $query->unread();
                break;
            case 'read':
                $query->read();
                break;
            // 'all' - no additional filter
        }
        
        $notifications = $query->orderBy('created_at', 'desc')->paginate(20);

        // Add color and icon to each notification for the frontend
        $notifications->getCollection()->transform(function ($notification) {
            $notification->color = $notification->getColor();
            $notification->icon = $notification->getIcon();
            return $notification;
        });

        $unreadCount = $user->unreadNotifications()->count();

        return view('admin.notifications.index', [
            'notifications' => $notifications,
            'unread_count' => $unreadCount,
            'current_filter' => $filter,
        ]);
    }
}
