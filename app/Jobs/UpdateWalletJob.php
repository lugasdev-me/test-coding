<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateWalletJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    protected $order;

    public function __construct($request, $order)
    {
        $this->request = $request;
        $this->order = $order;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->request['user_id']);

        if($user->wallet < $this->request['amount']) {
            $this->order->status = 2;
            $this->order->save();
            return;
        }

        $user->wallet = $user->wallet - $this->request['amount'];
        $user->save();

        $this->order->status = 1;
        $this->order->save();
    }
}
