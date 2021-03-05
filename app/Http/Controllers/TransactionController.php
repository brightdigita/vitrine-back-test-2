<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Notchpay\Payment;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get plan
        $company = Company::whereUserId(auth()->id())->firstOrFail();
        $plan = $company->subSector->plan;

        //init notchpay checkout
        $notchpay = new Payment(config('services.notchpay.business_id'));

        try {

            $response = $notchpay->checkout([
                'amount' => $plan->price,
                'currency' => 'XAF',
                'description' => $plan->name . ' Plan Subscription',
                'email' => $company->user->email,
            ]);

            //save transaction
            $company->transactions()->create([
                'company_id' => $company->id,
                'plan_id' => $plan->id,
                'reference' => random_int(1111111111, 9999999999)
            ]);

            return response()->json(
                ['redirection_url' => $response->redirect_url]
            );
        } catch (\Throwable $th) {
            abort(500);
        }
    }


    public function handle(Request $request)
    {
        if ($request->reference) {
            try {
                // verify notchpay transaction
                $notchpay = new Payment(config('services.notchpay.business_id'));

                $response = $notchpay->verify($request->reference);

                if ($response->status == 'completed') {
                    //update transaction
                    $transaction = Transaction::whereReference($request->reference)->firstOrFail();
                    $transaction->status = 'success';
                    $transaction->save();

                    //subscribe
                    $transaction->company->newSubscription('main', $transaction->plan);
                    //make redirection
                }
            } catch (\Throwable $th) {
                abort(500);
            }
        }
    }
}
