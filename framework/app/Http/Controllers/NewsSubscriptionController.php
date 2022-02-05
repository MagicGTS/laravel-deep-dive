<?php

namespace App\Http\Controllers;

use App\Models\NewsSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsSubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'regex:/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/'],
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors(['message' => "Что-то пошло не так."]);

        } else {
            $email = $request->input('email');
            $now = Carbon::now();
            $subscription = NewsSubscription::firstWhere('email', $email);
            $token = hash('sha256', $plainTextToken = Str::random(64));
            if ($subscription === null) {
                $subscription = NewsSubscription::create([
                    'email' => $email,
                    'last_verify_request_at' => $now,
                    'token' => $token,
                ]);
                Session::flash('message', "Запрос на подписку отправлен на ваш адрес: ${email}.");
                return Redirect::back();
            } elseif ($now->diffInHours($subscription->last_verify_request_at) > 2) {
                $subscription->last_verify_request_at = $now;
                $subscription->token = $token;
                $subscription->save();
                Session::flash('message', "Повторный запрос на подписку отправлен на ваш адрес: ${email}.");
                return Redirect::back();
            } else {
                return Redirect::back()->withErrors(['message' => "Недавно вы уже отправляли запрос, попробуйте позже."]);
            }
        }

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
     * @param  \App\Http\Requests\StoreNewsSubscriptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsSubscriptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\NewsSubscription  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function show(NewsSubscription $newsSubscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NewsSubscription  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsSubscription $newsSubscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsSubscriptionRequest  $request
     * @param  \App\Models\NewsSubscription  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNewsSubscriptionRequest $request, NewsSubscription $newsSubscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NewsSubscription  $newsSubscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsSubscription $newsSubscription)
    {
        //
    }
}
