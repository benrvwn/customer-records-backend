<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::orderBy('id', 'DESC')->get();

        return response()->json([
            'data' => $customers
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());

        return response()->json([
            'message' => 'Successfully added!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Customer::find($id);

        if (!$data) {
            return response()->json(['error' => 'Customer not found'], 404);
        }

        return response()->json([
            'data' => $data
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->update($request->all());
            return response()->json([
                'message' => 'Customer details have been updated successfully'
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->delete();
            return response()->json([
                'message' => 'The customer has been successfully removed'
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }
}
