<?php

use App\Models\ServiceStatus;

return [
    ServiceStatus::STATUS_NEW => "New",
    ServiceStatus::STATUS_DRAFT => "Draft",
    ServiceStatus::STATUS_TO_SIGN => "Waiting for sign",
    ServiceStatus::STATUS_PASSED => "Passed",
    ServiceStatus::STATUS_RECIEVED => "Recieved",
    ServiceStatus::STATUS_CLOSED => "Closed",
    ServiceStatus::STATUS_CANCELED => "Canceled",
    ServiceStatus::STATUS_REFUSED => "Refused",
    ServiceStatus::STATUS_REFUND => "Refund",
    ServiceStatus::STATUS_RETURNED_TO_CLIENT => "Returned to client",
    ServiceStatus::STATUS_REFERENCE => "Reference"
];