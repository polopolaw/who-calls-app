<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use JsonException;
use NotificationChannels\Telegram\TelegramMessage;

class CommentCreated extends Notification
{
    use Queueable;

    protected Comment $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }


    public function via(object $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * @throws JsonException
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->content(__("New comment"))
            ->view('notifications.telegram-new-comment', ['comment' => $this->comment])
            ->button(__('Approve'), URL::temporarySignedRoute('telegram.comment.approve', now()->addWeek(), ['comment' => $this->comment->id]))
            ->button(__('Delete'), URL::temporarySignedRoute('telegram.comment.delete', now()->addWeek(), ['comment' => $this->comment->id]));
    }
}
