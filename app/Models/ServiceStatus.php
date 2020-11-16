<?php


namespace App\Models;


class ServiceStatus
{
    const STATUS_NEW = 10;
    const STATUS_DRAFT = 20;
    const STATUS_TO_SIGN = 30;
    const STATUS_PASSED = 40;
    const STATUS_RECIEVED = 50;
    const STATUS_CLOSED = 60;
    const STATUS_CANCELED = 70;
    const STATUS_REFUSED = 80;
    const STATUS_REFUND = 90;
    const STATUS_RETURNED_TO_CLIENT = 100;
    const STATUS_REFERENCE = 110;

}