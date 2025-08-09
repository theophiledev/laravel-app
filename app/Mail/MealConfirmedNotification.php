<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\FoodTaken;

class MealConfirmedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $foodTaken;
    public $oldTimesTaken;
    public $oldTimesRemaining;
    public $oldPaymentAmount;
    public $mealCost;
    public $confirmationTime;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, FoodTaken $foodTaken, $oldTimesTaken, $oldTimesRemaining, $oldPaymentAmount = null, $mealCost = 5000)
    {
        $this->user = $user;
        $this->foodTaken = $foodTaken;
        $this->oldTimesTaken = $oldTimesTaken;
        $this->oldTimesRemaining = $oldTimesRemaining;
        $this->oldPaymentAmount = $oldPaymentAmount;
        $this->mealCost = $mealCost;
        $this->confirmationTime = now();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Meal Confirmed - Digital Meals System',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.meal-confirmed',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
} 