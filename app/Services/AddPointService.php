<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\EloquentCustomerPointEvent;
use App\Models\EloquentCustomerPoint;
use App\Models\PointEvent;
use Illuminate\Database\Connection;
use Throwable;

final class AddPointService
{
  /** @var EloquentCustomerPointEvnet */
  private $eloquentCustomerPointEvent;
  /** @var EloquentCustomerPoint */
  private $eloquentCustomerPoint;
  /** @var Connection */
  private $db;

  public function __construct(
    EloquentCustomerPointEvent $eloquentCustomerPointEvent,
    EloquentCustomerPoint $eloquentCustomerPoint
  )
  {
    $this->eloquentCustomerPointEvent = $eloquentCustomerPointEvent;
    $this->eloquentCustomerPoint = $eloquentCustomerPoint;
    $this->db = $eloquentCustomerPointEvent->getConnection();
  }

  /**
   *
   * @param PointEvent $event
   * @throws Throwable
   * @return void
   */
  public function add(PointEvent $event)
  {
    $this->db->transaction(
      function () use ($event) {
        // ポイントイベント保存
        $this->eloquentCustomerPointEvent->register($event);
        // 保有ポイント更新
        $this->eloquentCustomerPoint->addPoint(
          $event->getCustomerId(),
          $event->getPoint()
        );
      }
    );
  }
}
