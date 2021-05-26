<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerSelector as SelectorResource;
use App\Http\Resources\CustomerForShow as CustomerForShowResource;

use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Customer::all();
        return SelectorResource::collection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Customer::where([
            ['code', $request->item['code']]
        ])->count();
        if ($count) {
            return response()->json([
                'result' => false,
                'errorMessage' => 'コードは既に登録されています。'
            ]);
        }
        DB::transaction(function () use ($request) {
            $item = new Customer;
            $item->code = $request->item['code'];
            $item->name = $request->item['name'];
            $item->postal_code = $request->item['postal_code'];
            $item->address = $request->item['address'];
            $item->tel = $request->item['tel'];
            $item->fax = $request->item['fax'];
            $item->closing_day= $request->item['closing_day'];

            $item->save();
        });

        return response()->json([
            'result' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $item)
    {
        return new CustomerForShowResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $item)
    {
        $count = Customer::where([
            ['id', '<>', $item->id],
            ['code', $request->item['code']]
        ])->count();
        if ($count) {
            return response()->json([
                'result' => false,
                'errorMessage' => 'コードは既に登録されています。'
            ]);
        }
        DB::transaction(function () use ($request, $item) {
            $item->code = $request->item['code'];
            $item->name = $request->item['name'];
            $item->postal_code = $request->item['postal_code'];
            $item->address = $request->item['address'];
            $item->tel = $request->item['tel'];
            $item->fax = $request->item['fax'];
            $item->closing_day = $request->item['closing_day'];

            $item->save();
        });

        return response()->json([
            'result' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $item)
    {
        DB::transaction(function () use ($item) {
            $item->delete();
        });

        return response()->json([
            'result' => true,
        ]);
    }
}
