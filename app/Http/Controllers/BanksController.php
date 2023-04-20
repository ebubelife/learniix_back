<?php

namespace App\Http\Controllers;

use App\Models\Banks;
use Illuminate\Http\Request;

class BanksController extends Controller
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
        //

        $banks = array(
            "Access Bank Plc",
            "Fidelity Bank Plc",
            "First City Monument Bank Limited",
            "First Bank of Nigeria Limited",
            "Guaranty Trust Holding Company Plc",
            "Union Bank of Nigeria Plc",
            "United Bank for Africa Plc",
            "Zenith Bank Plc",
            "Citibank Nigeria Limited",
            "Ecobank Nigeria",
            "Heritage Bank Plc",
            "Keystone Bank Limited",
            "Polaris Bank Limited",
            "Stanbic IBTC Bank Plc",
            "Standard Chartered",
            "Sterling Bank Plc",
            "Titan Trust bank",
            "Unity Bank Plc",
            "Wema Bank Plc",
            "Globus Bank Limited",
            "Parallex Bank Limited",
            "PremiumTrust Bank Limited",
            "Providus Bank Limited",
            "SunTrust Bank Nigeria Limited",
            "Jaiz Bank Plc",
            "LOTUS BANK",
            "TAJBank Limited",
            "Coronation Merchant Bank",
            "FBNQuest Merchant Bank",
            "FSDH Merchant Bank",
            "Rand Merchant Bank",
            "Nova Merchant Bank",
            "SunTrust Bank Nigeria limited NIB",
            "Stanbic Ibtc NIB",
            "Mutual Trust Microfinance Bank",
            "Rephidim Microfinance Bank",
            "Shepherd Trust Microfinance Bank",
            "Empire Trust Microfinance Bank",
            "Finca Microfinance Bank Limited",
            "Fina Trust Microfinance Bank",
            "Accion Microfinance Bank",
            "Peace Microfinance Bank",
            "Infinity Microfinance Bank",
            "Pearl Microfinance Bank Limited",
            "Covenant Microfinance Bank Ltd",
            "Advans La Fayette Microfinance Bank",
            "Sparkle Bank",
            "Kuda Bank",
            "Moniepoint Microfinance Bank",
            "Opay",
            "Palmpay",
            "Rubies Bank",
            "VFD Microfinance Bank",
            "Mint Finex MFB",
            "Mkobo MFB",
            "Raven bank"
        );

        sort($banks);

        foreach ($banks as $bank) {

            $bank_list = new Banks();
            $bank_list->bank = $bank;
            $bank_list->save();
            
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function show(Banks $banks)
    {
        //
        $products = Banks::all();
        return response()->json($products);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function edit(Banks $banks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banks $banks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banks  $banks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banks $banks)
    {
        //
    }
}
