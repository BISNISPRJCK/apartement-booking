<?php

namespace App\Swagger;

use OpenApi\Attributes as OA;

#[OA\Info(
    title: "Apartment Booking API",
    version: "1.0.0",
    description: "API Documentation for Apartment Booking"
)]

#[OA\Server(
    url: "http://localhost",
    description: "Local Server"
)]

class OpenApi
{
}