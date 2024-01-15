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
     public function addSquadBanks(Request $request){


        $banks = array(
            array("code" => "000001", "bank" => "Sterling Bank", "country" => "NGN"),
            array("code" => "000002", "bank" => "Keystone Bank", "country" => "NGN"),
            array("code" => "000003", "bank" => "FCMB", "country" => "NGN"),
            array("code" => "000004", "bank" => "United Bank for Africa", "country" => "NGN"),
            array("code" => "000005", "bank" => "Diamond Bank", "country" => "NGN"),
            array("code" => "000006", "bank" => "JAIZ Bank", "country" => "NGN"),
            array("code" => "000007", "bank" => "Fidelity Bank", "country" => "NGN"),
            array("code" => "000008", "bank" => "Polaris Bank", "country" => "NGN"),
            array("code" => "000009", "bank" => "Citi Bank", "country" => "NGN"),
            array("code" => "000010", "bank" => "Ecobank Bank", "country" => "NGN"),
            array("code" => "000011", "bank" => "Unity Bank", "country" => "NGN"),
            array("code" => "000012", "bank" => "StanbicIBTC Bank", "country" => "NGN"),
            array("code" => "000013", "bank" => "GTBank Plc", "country" => "NGN"),
            array("code" => "000014", "bank" => "Access Bank", "country" => "NGN"),
            array("code" => "000015", "bank" => "Zenith Bank Plc", "country" => "NGN"),
            array("code" => "000016", "bank" => "First Bank of Nigeria", "country" => "NGN"),
            array("code" => "000017", "bank" => "Wema Bank", "country" => "NGN"),
            array("code" => "000018", "bank" => "Union Bank", "country" => "NGN"),
            array("code" => "000019", "bank" => "Enterprise Bank", "country" => "NGN"),
            array("code" => "000020", "bank" => "Heritage", "country" => "NGN"),
            array("code" => "000021", "bank" => "Standard Chartered", "country" => "NGN"),
            array("code" => "000022", "bank" => "Suntrust Bank", "country" => "NGN"),
            array("code" => "000023", "bank" => "Providus Bank", "country" => "NGN"),
            array("code" => "000024", "bank" => "Rand Merchant Bank", "country" => "NGN"),
            array("code" => "000025", "bank" => "Titan Trust Bank", "country" => "NGN"),
            array("code" => "000026", "bank" => "Taj Bank", "country" => "NGN"),
            array("code" => "000027", "bank" => "Globus Bank", "country" => "NGN"),
            array("code" => "000028", "bank" => "Central Bank of Nigeria", "country" => "NGN"),
            array("code" => "000029", "bank" => "Lotus Bank", "country" => "NGN"),
            array("code" => "000031", "bank" => "Premium Trust Bank", "country" => "NGN"),
            array("code" => "000033", "bank" => "eNaira", "country" => "NGN"),
            array("code" => "000034", "bank" => "Signature Bank", "country" => "NGN"),
            array("code" => "000036", "bank" => "Optimus Bank", "country" => "NGN"),
            array("code" => "050002", "bank" => "FEWCHORE FINANCE COMPANY LIMITED", "country" => "NGN"),
            array("code" => "050003", "bank" => "SageGrey Finance Limited", "country" => "NGN"),
            array("code" => "050005", "bank" => "AAA Finance", "country" => "NGN"),
            array("code" => "050006", "bank" => "Branch International Financial Services", "country" => "NGN"),
            array("code" => "050007", "bank" => "Tekla Finance Limited", "country" => "NGN"),
            array("code" => "050009", "bank" => "Fast Credit", "country" => "NGN"),
            array("code" => "050010", "bank" => "Fundquest Financial Services Limited", "country" => "NGN"),
            array("code" => "050012", "bank" => "Enco Finance", "country" => "NGN"),
            array("code" => "050013", "bank" => "Dignity Finance", "country" => "NGN"),
            array("code" => "050013", "bank" => "Trinity Financial Services Limited", "country" => "NGN"),
            array("code" => "400001", "bank" => "FSDH Merchant Bank", "country" => "NGN"),
            array("code" => "060001", "bank" => "Coronation Merchant Bank", "country" => "NGN"),
            array("code" => "060002", "bank" => "FBNQUEST Merchant Bank", "country" => "NGN"),
            array("code" => "060003", "bank" => "Nova Merchant Bank", "country" => "NGN"),
            array("code" => "060004", "bank" => "Greenwich Merchant Bank", "country" => "NGN"),
            array("code" => "070007", "bank" => "Omoluabi savings and loans", "country" => "NGN"),
            array("code" => "090001", "bank" => "ASOSavings & Loans", "country" => "NGN"),
            array("code" => "090005", "bank" => "Trustbond Mortgage Bank", "country" => "NGN"),
            array("code" => "090006", "bank" => "SafeTrust", "country" => "NGN"),
            array("code" => "090107", "bank" => "FBN Mortgages Limited", "country" => "NGN"),
            array("code" => "100024", "bank" => "Imperial Homes Mortgage Bank", "country" => "NGN"),
            array("code" => "100028", "bank" => "AG Mortgage Bank", "country" => "NGN"),
            array("code" => "070009", "bank" => "Gateway Mortgage Bank", "country" => "NGN"),
            array("code" => "070010", "bank" => "Abbey Mortgage Bank", "country" => "NGN"),
            array("code" => "070011", "bank" => "Refuge Mortgage Bank", "country" => "NGN"),
            array("code" => "070012", "bank" => "Lagos Building Investment Company", "country" => "NGN"),
            array("code" => "070013", "bank" => "Platinum Mortgage Bank", "country" => "NGN"),
            array("code" => "070014", "bank" => "First Generation Mortgage Bank", "country" => "NGN"),
            array("code" => "070015", "bank" => "Brent Mortgage Bank", "country" => "NGN"),
            array("code" => "070016", "bank" => "Infinity Trust Mortgage Bank", "country" => "NGN"),
            array("code" => "070019", "bank" => "MayFresh Mortgage Bank", "country" => "NGN"),
            array("code" => "090003", "bank" => "Jubilee-Life Mortgage Bank", "country" => "NGN"),
            array("code" => "070017", "bank" => "Haggai Mortgage Bank Limited", "country" => "NGN"),
            array("code" => "070021", "bank" => "Coop Mortgage Bank", "country" => "NGN"),
            array("code" => "070023", "bank" => "Delta Trust Microfinance Bank", "country" => "NGN"),
            array("code" => "070024", "bank" => "Homebase Mortgage Bank", "country" => "NGN"),
            array("code" => "070025", "bank" => "Akwa Savings & Loans Limited", "country" => "NGN"),
            array("code" => "070026", "bank" => "FHA Mortgage Bank", "country" => "NGN"),
            array("code" => "090108", "bank" => "New Prudential Bank", "country" => "NGN"),
            array("code" => "070001", "bank" => "NPF MicroFinance Bank", "country" => "NGN"),
            array("code" => "070002", "bank" => "Fortis Microfinance Bank", "country" => "NGN"),
            array("code" => "070006", "bank" => "Covenant MFB", "country" => "NGN"),
            array("code" => "070008", "bank" => "Page Financials", "country" => "NGN"),
            array("code" => "090004", "bank" => "Parralex Microfinance bank", "country" => "NGN"),
            array("code" => "090097", "bank" => "Ekondo MFB", "country" => "NGN"),
            array("code" => "090110", "bank" => "VFD MFB", "country" => "NGN"),
            array("code" => "090111", "bank" => "FinaTrust Microfinance Bank", "country" => "NGN"),
            array("code" => "090112", "bank" => "Seed Capital Microfinance Bank", "country" => "NGN"),
            array("code" => "090114", "bank" => "Empire trust MFB", "country" => "NGN"),
            array("code" => "090115", "bank" => "TCF MFB", "country" => "NGN"),
            array("code" => "090116", "bank" => "AMML MFB", "country" => "NGN"),
            array("code" => "090117", "bank" => "Boctrust Microfinance Bank", "country" => "NGN"),
            array("code" => "090118", "bank" => "IBILE Microfinance Bank", "country" => "NGN"),
            array("code" => "090119", "bank" => "Ohafia Microfinance Bank", "country" => "NGN"),
            array("code" => "090120", "bank" => "Wetland Microfinance Bank", "country" => "NGN"),
            array("code" => "090121", "bank" => "Hasal Microfinance Bank", "country" => "NGN"),
            array("code" => "090122", "bank" => "Gowans Microfinance Bank", "country" => "NGN"),
            array("code" => "090123", "bank" => "Verite Microfinance Bank", "country" => "NGN"),
            array("code" => "090124", "bank" => "Xslnce Microfinance Bank", "country" => "NGN"),
            array("code" => "090125", "bank" => "Regent Microfinance Bank", "country" => "NGN"),
            array("code" => "090126", "bank" => "Fidfund Microfinance Bank", "country" => "NGN"),
            array("code" => "090127", "bank" => "BC Kash Microfinance Bank", "country" => "NGN"),
            array("code" => "090128", "bank" => "Ndiorah Microfinance Bank", "country" => "NGN"),
            array("code" => "090129", "bank" => "Money Trust Microfinance Bank", "country" => "NGN"),
            array("code" => "090130", "bank" => "Consumer Microfinance Bank", "country" => "NGN"),
            array("code" => "090131", "bank" => "Allworkers Microfinance Bank", "country" => "NGN"),
            array("code" => "090132", "bank" => "Richway Microfinance Bank", "country" => "NGN"),
            array("code" => "090133", "bank" => "AL-Barakah Microfinance Bank", "country" => "NGN"),
            array("code" => "090134", "bank" => "Accion Microfinance Bank", "country" => "NGN"),
            array("code" => "090135", "bank" => "Personal Trust Microfinance Bank", "country" => "NGN"),
            array("code" => "090136", "bank" => "Microcred Microfinance Bank", "country" => "NGN"),
            array("code" => "090137", "bank" => "PecanTrust Microfinance Bank", "country" => "NGN"),
            array("code" => "090138", "bank" => "Royal Exchange Microfinance Bank", "country" => "NGN"),
            array("code" => "090139", "bank" => "Visa Microfinance Bank", "country" => "NGN"),
            array("code" => "090140", "bank" => "Sagamu Microfinance Bank", "country" => "NGN"),
            array("code" => "090141", "bank" => "Chikum Microfinance Bank", "country" => "NGN"),
            array("code" => "090142", "bank" => "Yes Microfinance Bank", "country" => "NGN"),
            array("code" => "090143", "bank" => "Apeks Microfinance Bank", "country" => "NGN"),
            array("code" => "090144", "bank" => "CIT Microfinance Bank", "country" => "NGN"),
            array("code" => "090145", "bank" => "Fullrange Microfinance Bank", "country" => "NGN"),
            array("code" => "090146", "bank" => "Trident Microfinance Bank", "country" => "NGN"),
            array("code" => "090147", "bank" => "Hackman Microfinance Bank", "country" => "NGN"),
            array("code" => "090148", "bank" => "Bowen Microfinance Bank", "country" => "NGN"),
            array("code" => "090149", "bank" => "IRL Microfinance Bank", "country" => "NGN"),
            array("code" => "090150", "bank" => "Virtue Microfinance Bank", "country" => "NGN"),
            array("code" => "090151", "bank" => "Mutual Trust Microfinance Bank", "country" => "NGN"),
            array("code" => "090152", "bank" => "Nagarta Microfinance Bank", "country" => "NGN"),
            array("code" => "090153", "bank" => "FFS Microfinance Bank", "country" => "NGN"),
            array("code" => "090154", "bank" => "CEMCS Microfinance Bank", "country" => "NGN"),
            array("code" => "090155", "bank" => "Advans La Fayette Microfinance Bank", "country" => "NGN"),
            array("code" => "090156", "bank" => "e-Barcs Microfinance Bank", "country" => "NGN"),
            array("code" => "090157", "bank" => "Infinity Microfinance Bank", "country" => "NGN"),
            array("code" => "090158", "bank" => "Futo Microfinance Bank", "country" => "NGN"),
            array("code" => "090159", "bank" => "Credit Afrique Microfinance Bank", "country" => "NGN"),
            array("code" => "090160", "bank" => "Addosser Microfinance Bank", "country" => "NGN"),
            array("code" => "090161", "bank" => "Okpoga Microfinance Bank", "country" => "NGN"),
            array("code" => "090162", "bank" => "Stanford Microfinance Bak", "country" => "NGN"),
            array("code" => "090164", "bank" => "First Royal Microfinance Bank", "country" => "NGN"),
            array("code" => "090165", "bank" => "Petra Microfinance Bank", "country" => "NGN"),
            array("code" => "090166", "bank" => "Eso-E Microfinance Bank", "country" => "NGN"),
            array("code" => "090167", "bank" => "Daylight Microfinance Bank", "country" => "NGN"),
            array("code" => "090168", "bank" => "Gashua Microfinance Bank", "country" => "NGN"),
            array("code" => "090169", "bank" => "Alpha Kapital Microfinance Bank", "country" => "NGN"),
            array("code" => "090171", "bank" => "Mainstreet Microfinance Bank", "country" => "NGN"),
            array("code" => "090172", "bank" => "Astrapolaris Microfinance Bank", "country" => "NGN"),
            array("code" => "090173", "bank" => "Reliance Microfinance Bank", "country" => "NGN"),
            array("code" => "090174", "bank" => "Malachy Microfinance Bank", "country" => "NGN"),
            array("code" => "090175", "bank" => "HighStreet Microfinance Bank", "country" => "NGN"),
            array("code" => "090176", "bank" => "Bosak Microfinance Bank", "country" => "NGN"),
            array("code" => "090177", "bank" => "Lapo Microfinance Bank", "country" => "NGN"),
            array("code" => "090178", "bank" => "GreenBank Microfinance Bank", "country" => "NGN"),
            array("code" => "090179", "bank" => "FAST Microfinance Bank", "country" => "NGN"),
            array("code" => "090180", "bank" => "Amju Unique Microfinance Bank", "country" => "NGN"),
            array("code" => "090186", "bank" => "Girei Microfinance Bank", "country" => "NGN"),
            array("code" => "090188", "bank" => "Baines Credit Microfinance Bank", "country" => "NGN"),
            array("code" => "090189", "bank" => "Esan Microfinance Bank", "country" => "NGN"),
            array("code" => "090190", "bank" => "Mutual Benefits Microfinance Bank", "country" => "NGN"),
            array("code" => "090191", "bank" => "KCMB Microfinance Bank", "country" => "NGN"),
            array("code" => "090192", "bank" => "Midland Microfinance Bank", "country" => "NGN"),
            array("code" => "090193", "bank" => "Unical Microfinance Bank", "country" => "NGN"),
            array("code" => "090194", "bank" => "NIRSAL Microfinance Bank", "country" => "NGN"),
            array("code" => "090195", "bank" => "Grooming Microfinance Bank", "country" => "NGN"),
            array("code" => "090196", "bank" => "Pennywise Microfinance Bank", "country" => "NGN"),
            array("code" => "090197", "bank" => "ABU Microfinance Bank", "country" => "NGN"),
            array("code" => "090198", "bank" => "RenMoney Microfinance Bank", "country" => "NGN"),
            array("code" => "090205", "bank" => "New Dawn Microfinance Bank", "country" => "NGN"),
            array("code" => "090251", "bank" => "UNN MFB", "country" => "NGN"),
            array("code" => "090252", "bank" => "Yobe Microfinance Bank", "country" => "NGN"),
            array("code" => "090254", "bank" => "Coalcamp Microfinance Bank", "country" => "NGN"),
            array("code" => "090258", "bank" => "Imo State Microfinance Bank", "country" => "NGN"),
            array("code" => "090259", "bank" => "Alekun Microfinance Bank", "country" => "NGN"),
            array("code" => "090260", "bank" => "Above Only Microfinance Bank", "country" => "NGN"),
            array("code" => "090261", "bank" => "Quickfund Microfinance Bank", "country" => "NGN"),
            array("code" => "090262", "bank" => "Stellas Microfinance Bank", "country" => "NGN"),
            array("code" => "090263", "bank" => "Navy Microfinance Bank", "country" => "NGN"),
            array("code" => "090264", "bank" => "Auchi Microfinance Bank", "country" => "NGN"),
            array("code" => "090265", "bank" => "Lovonus Microfinance Bank", "country" => "NGN"),
            array("code" => "090266", "bank" => "Uniben Microfinance Bank", "country" => "NGN"),
            array("code" => "090267", "bank" => "Kuda Microfinance Bank", "country" => "NGN"),
            array("code" => "090268", "bank" => "Adeyemi College Staff Microfinance Bank", "country" => "NGN"),
            array("code" => "090269", "bank" => "Greenville Microfinance Bank", "country" => "NGN"),
            array("code" => "090270", "bank" => "AB Microfinance Bank", "country" => "NGN"),
            array("code" => "090271", "bank" => "Lavender Microfinance Bank", "country" => "NGN"),
            array("code" => "090272", "bank" => "Olabisi Onabanjo University Microfinance Bank", "country" => "NGN"),
            array("code" => "090273", "bank" => "Emeralds Microfinance Bank", "country" => "NGN"),
            array("code" => "090274", "bank" => "Prestige Microfinance Bank", "country" => "NGN"),
            array("code" => "090276", "bank" => "Trustfund Microfinance Bank", "country" => "NGN"),
            array("code" => "090277", "bank" => "Al-Hayat Microfinance Bank", "country" => "NGN"),
            array("code" => "090278", "bank" => "Glory Microfinance Bank", "country" => "NGN"),
            array("code" => "090279", "bank" => "Ikire Microfinance Bank", "country" => "NGN"),
            array("code" => "090280", "bank" => "Megapraise Microfinance Bank", "country" => "NGN"),
            array("code" => "090281", "bank" => "MintFinex Microfinance Bank", "country" => "NGN"),
            array("code" => "090282", "bank" => "Arise Microfinance Bank", "country" => "NGN"),
            array("code" => "090283", "bank" => "Nnew Women Microfinance Bank", "country" => "NGN"),
            array("code" => "090285", "bank" => "First Option Microfinance Bank", "country" => "NGN"),
            array("code" => "090286", "bank" => "Safe Haven Microfinance Bank", "country" => "NGN"),
            array("code" => "090287", "bank" => "AssetMatrix Microfinance Bank", "country" => "NGN"),
            array("code" => "090289", "bank" => "Pillar Microfinance Bank", "country" => "NGN"),
            array("code" => "090290", "bank" => "FCT Microfinance Bank", "country" => "NGN"),
            array("code" => "090291", "bank" => "Halal Credit Microfinance Bank", "country" => "NGN"),
            array("code" => "090292", "bank" => "Afekhafe Microfinance Bank", "country" => "NGN"),
            array("code" => "090293", "bank" => "Brethren Microfinance Bank", "country" => "NGN"),
            array("code" => "090294", "bank" => "Eagle Flight Microfinance Bank", "country" => "NGN"),
            array("code" => "090295", "bank" => "Omiye Microfinance Bank", "country" => "NGN"),
            array("code" => "090296", "bank" => "Polyunwana Microfinance Bank", "country" => "NGN"),
            array("code" => "090297", "bank" => "Alert Microfinance Bank", "country" => "NGN"),
            array("code" => "090298", "bank" => "FedPoly Nasarawa Microfinance Bank", "country" => "NGN"),
            array("code" => "090299", "bank" => "Kontagora Microfinance Bank", "country" => "NGN"),
            array("code" => "090303", "bank" => "Purplemoney Microfinance Bank", "country" => "NGN"),
            array("code" => "090304", "bank" => "Evangel Microfinance Bank", "country" => "NGN"),
            array("code" => "090305", "bank" => "Sulspap Microfinance Bank", "country" => "NGN"),
            array("code" => "090307", "bank" => "Aramoko Microfinance Bank", "country" => "NGN"),
            array("code" => "090308", "bank" => "Brightway Microfinance Bank", "country" => "NGN"),
            array("code" => "090310", "bank" => "EdFin Microfinance Bank", "country" => "NGN"),
            array("code" => "090315", "bank" => "U & C Microfinance Bank", "country" => "NGN"),
            array("code" => "090317", "bank" => "PatrickGold Microfinance Bank", "country" => "NGN"),
            array("code" => "090318", "bank" => "Federal University Dutse Microfinance Bank", "country" => "NGN"),
            array("code" => "090320", "bank" => "KadPoly Microfinance Bank", "country" => "NGN"),
            array("code" => "090321", "bank" => "MayFair Microfinance Bank", "country" => "NGN"),
            array("code" => "090322", "bank" => "Rephidim Microfinance Bank", "country" => "NGN"),
            array("code" => "090323", "bank" => "Mainland Microfinance Bank", "country" => "NGN"),
            array("code" => "090324", "bank" => "Ikenne Microfinance Bank", "country" => "NGN"),
            array("code" => "090325", "bank" => "Sparkle", "country" => "NGN"),
            array("code" => "090326", "bank" => "Balogun Gambari Microfinance Bank", "country" => "NGN"),
            array("code" => "090327", "bank" => "Trust Microfinance Bank", "country" => "NGN"),
            array("code" => "090328", "bank" => "Eyowo", "country" => "NGN"),
            array("code" => "090551", "bank" => "FairMoney Microfinance Bank", "country" => "NGN"),
            array("code" => "100002", "bank" => "Paga", "country" => "NGN"),
            array("code" => "100004", "bank" => "Opay Digital Services LT", "country" => "NGN"),
            array("code" => "100007", "bank" => "Stanbic IBTC @ease wallet", "country" => "NGN"),
            array("code" => "100008", "bank" => "Ecobank Xpress Account", "country" => "NGN"),
            array("code" => "100009", "bank" => "GTMobile", "country" => "NGN"),
            array("code" => "100010", "bank" => "TeasyMobile", "country" => "NGN"),
            array("code" => "100011", "bank" => "Mkudi", "country" => "NGN"),
            array("code" => "100012", "bank" => "VTNetworks", "country" => "NGN"),
            array("code" => "100013", "bank" => "AccessMobile", "country" => "NGN"),
            array("code" => "100014", "bank" => "FBNMobile", "country" => "NGN"),
            array("code" => "100036", "bank" => "Kegow (Chamsmobile)", "country" => "NGN"),
            array("code" => "100016", "bank" => "FortisMobile", "country" => "NGN"),
            array("code" => "100017", "bank" => "Hedonmark", "country" => "NGN"),
            array("code" => "100018", "bank" => "ZenithMobile", "country" => "NGN"),
            array("code" => "100030", "bank" => "EcoMobile", "country" => "NGN"),
            array("code" => "100031", "bank" => "FCMB Easy Account", "country" => "NGN"),
            array("code" => "100032", "bank" => "Contec Global Infotech Limited (NowNow)", "country" => "NGN"),
            array("code" => "100033", "bank" => "PalmPay Limited", "country" => "NGN"),
            array("code" => "100034", "bank" => "Zenith Eazy Wallet", "country" => "NGN"),
            array("code" => "100052", "bank" => "Access Yello", "country" => "NGN"),
            array("code" => "100019", "bank" => "Fidelity Mobile", "country" => "NGN"),
            array("code" => "100035", "bank" => "M36", "country" => "NGN"),
            array("code" => "100039", "bank" => "TitanPaystack", "country" => "NGN"),
            array("code" => "080002", "bank" => "Taj_Pinspay", "country" => "NGN"),
            array("code" => "100027", "bank" => "Intellifin", "country" => "NGN"),
            array("code" => "110001", "bank" => "PayAttitude Online", "country" => "NGN"),
            array("code" => "110002", "bank" => "Flutterwave Technology Solutions Limited", "country" => "NGN"),
            array("code" => "110003", "bank" => "Interswitch Limited", "country" => "NGN"),
            array("code" => "110004", "bank" => "First Apple Limited", "country" => "NGN"),
            array("code" => "110005", "bank" => "3line Card Management Limited", "country" => "NGN"),
            array("code" => "110006", "bank" => "Paystack Payment Limited", "country" => "NGN"),
            array("code" => "110007", "bank" => "Teamapt Limited", "country" => "NGN"),
            array("code" => "999999", "bank" => "NIP Virtual Bank", "country" => "NGN"),
            array("code" => "120001", "bank" => "9Payment Service Bank", "country" => "NGN"),
            array("code" => "120002", "bank" => "HopePSB", "country" => "NGN"),
            array("code" => "120003", "bank" => "MoMo PSB", "country" => "NGN"),
            array("code" => "120004", "bank" => "SmartCash PSB", "country" => "NGN"),

        
        
        );


       // $jsonbanks = json_decode($banks);
    
        // return  count($banks->data);
  
        for ($i = 0; $i < count($banks); $i++) {
 
                $bank_list = new Banks();       
  
                $bank_list->bank= $banks[$i]["bank"];
                $bank_list->code= $banks[$i]["code"];
                $bank_list->country= $banks[$i]["country"];
 
                $bank_list->save();
 
  
                
  
        }
     }



    public function addNigerianBanks(Request $request)
    {
        //
       $url = "https://api.paystack.co/bank?currency=NGN";
       $accessToken ="sk_live_9e99c504399b16cf066e5d5a3eb0edfeb2f7de06";
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Set authentication headers
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            // Add any other required headers
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        // Set any additional cURL options if needed
    
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($statusCode !== 200) {
            // Handle error if needed
            return null;
        }
    
        curl_close($ch);
    
       // $ban = json_decode($response, true);

       //return $response;

       $banks = json_decode($response);
    
       // return  count($banks->data);
 
       for ($i = 0; $i < count($banks->data); $i++) {

               $bank_list = new Banks();       
 
               $bank_list->bank= $banks->data[$i]->name;
               $bank_list->code= $banks->data[$i]->code;
               $bank_list->country= "NGN";

               $bank_list->save();

 
               
 
       }
    
      
    }



    public function addGhanaBanks(Request $request)
    {
        //
       $url = "https://api.paystack.co/bank?currency=GHS";
       $accessToken ="sk_live_9e99c504399b16cf066e5d5a3eb0edfeb2f7de06";
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Set authentication headers
        $headers = [
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/json',
            // Add any other required headers
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        // Set any additional cURL options if needed
    
        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
        if ($statusCode !== 200) {
            // Handle error if needed
            return null;
        }
    
        curl_close($ch);
    
       // $ban = json_decode($response, true);

       //return $response;

       $banks = json_decode($response);
    
       // return  count($banks->data);
 
       for ($i = 0; $i < count($banks->data); $i++) {

               $bank_list = new Banks();       
 
               $bank_list->bank= $banks->data[$i]->name;
               $bank_list->code= $banks->data[$i]->code;
               $bank_list->country= "GHS";

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
        $banks = Banks::all();
        return response()->json($banks);
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
