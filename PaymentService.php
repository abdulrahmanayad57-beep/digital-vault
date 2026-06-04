<?php
namespace App\Services;
use App\Models\Subscription;
use GuzzleHttp\Client;

class PaymentService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.paymob.api_key');
    }

    public function createPaymentLink(Subscription $subscription)
    {
        $authToken = $this->authenticate();
        $orderId = $this->createOrder($authToken, $subscription);
        $paymentKey = $this->getPaymentKey($authToken, $orderId, $subscription);
        return "https://accept.paymob.com/api/acceptance/iframes/" . config('services.paymob.iframe_id') . "?payment_token=" . $paymentKey;
    }
    
    private function authenticate() { /* ... */ }
    private function createOrder($token, $sub) { /* ... */ }
    private function getPaymentKey($token, $orderId, $sub) { /* ... */ }
}
