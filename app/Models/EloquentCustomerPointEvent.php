<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EloquentCustomerPointEvent extends Model
{
    protected $table = 'customer_point_events';

    public $timestamp = false;

    public function register(PointEvent $event)
    {
        $new = $this->newInstance();
        $new->customer_id = $event->getCustomerId();
        $new->event = $event->getEvent();
        $new->point = $event->getPoint();
        $new->created_at = $event->getCreatedAt()->toDateTimeString();
        $new->save();
    }
}
