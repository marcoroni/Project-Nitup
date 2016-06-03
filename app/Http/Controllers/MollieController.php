<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MollieController extends Controller
{
    public function paymentRequest() {

        require_once 'https://api.mollie.nl/v1/payments';

        $mollie = new Mollie_API_Client;
        $mollie->setApiKey('test_dHar4XY7LxsDOtmnkVtjNVWXLSlXsM');

        try
        {
            $payment = $mollie->payments->create(
                array(
                    'amount'      => 00.00,
                    'description' => 'My first payment',
                    'redirectUrl' => '/games',
                    'metadata'    => array(
                        'order_id' => '12345'
                    )
                )
            );

            /*
             * Send the customer off to complete the payment.
             */
            header("Location: " . $payment->getPaymentUrl());
            exit;
        }
        catch (Mollie_API_Exception $e)
        {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
            echo " on field " . htmlspecialchars($e->getField());
        }
    }
}
