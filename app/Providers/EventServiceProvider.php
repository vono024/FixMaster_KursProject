<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\RepairStatusChanged;
use App\Events\RepairCompleted;
use App\Events\ReviewSubmitted;
use App\Listeners\SendNotificationToClient;
use App\Listeners\RequestReviewFromClient;
use App\Listeners\UpdateMasterRating;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        RepairStatusChanged::class => [
            SendNotificationToClient::class,
        ],
        RepairCompleted::class => [
            RequestReviewFromClient::class,
        ],
        ReviewSubmitted::class => [
            UpdateMasterRating::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
