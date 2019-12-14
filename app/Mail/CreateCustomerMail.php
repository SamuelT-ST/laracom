<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateCustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $token, $customer;

    /**
     * Create a new message instance.
     *
     * @param string $token
     * @param array $customer
     */
    public function __construct(string $token, array $customer)
    {
        $this->token = $token;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.customer.newCustomer')
            ->from('noreply@lumo.sk')
            ->to($this->customer['email'])
            ->subject(__('Vitajte v eshope Lumo'));
    }
}
