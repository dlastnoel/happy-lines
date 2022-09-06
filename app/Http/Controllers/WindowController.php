<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Window;
use App\Models\Transaction;

class WindowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('App/Windows/Index', [
            'windows' => Window::all()->map(fn ($window) => [
                'id' => $window->id,
                'name' => $window->name,
                'description' => $window->description,
                'transaction' => $window->transaction->type
            ])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selected = Window::all()->pluck('transaction_id');
        $transactions = Transaction::query()->whereNotIn('id', $selected)->get();
        return Inertia::render('App/Windows/Create', [
            'transactions' => $transactions->map(fn ($transaction) => [
                'id' => $transaction->id,
                'type' => $transaction->type,
            ]),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Window::create(
            $request->validate([
                'name' => ['required', 'unique:windows,name'],
                'transaction_id' => ['required', 'integer'],
                'description' => ['required'],
                'is_active' => ['sometimes', 'nullable', 'boolean'],
            ])
        );

        return redirect('/windows');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Window $window)
    {
        $selected = Window::all()->pluck('transaction_id');
        $transactions = Transaction::query()->whereNotIn('id', $selected)->get();
        return Inertia::render('App/Windows/Edit', [
            'transactions' => $transactions,
            'window' => [
                'id' => $window->id,
                'name' => $window->name,
                'transaction_id' => $window->transaction_id,
                'transaction_type' => $window->transaction->type,
                'description' => $window->description,
                'is_active' => $window->is_active ? true : false,
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
