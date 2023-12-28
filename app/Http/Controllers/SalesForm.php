<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DimsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class SalesForm extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // (new DimsCommon())->clearAllUserLocks();
//viewtblCustomers

       $sessionUserId = Auth::user()->UserID;

        return view('merchie/landing');
    }
    public function getThings($GroupId,$thing)
    {
        $things = 0;

        //$GroupId = Auth::user()->GroupId;
        $returnTrueOrFalse = DB::connection('sqlsrv3')
            ->select("select [dbo].[fnGetGroupThings](".$GroupId.",'".$thing."',0) as things");
        foreach ($returnTrueOrFalse as $val)
        {
            $things =  $val->things;
        }
        return $things;
    }
    public function hasAccessToEdit($orderid)
    {
        $canEditOrder = "Yes";
        $hasAccess = $this->getThings(Auth::user()->GroupId,'Has Access to Edit Planned Order');
        if ($hasAccess == "0")
        {
            $routetype = env("APP_ROUTE_PLAN_DEFUALT_ID");
            $checkifTheRouteIsPlanned = DB::connection('sqlsrv3')
                ->select("select * from tblOrders where Orderid = $orderid and LateOrder = $routetype and TreatAsQuotation <> 1");
            if(count($checkifTheRouteIsPlanned) < 1)
            {
                $canEditOrder = "NO";
            }else{
                $canEditOrder = "Yes";
            }
        }
        return $canEditOrder;
    }
    public function pl()
    {
        $marginType =  DB::connection('sqlsrv3')->table('tblCOMPANYREPORTS')->select('ReportType', 'Comment')->where('ReportName','marginCalculator')
            ->where('Function','1')
            ->get();

        $sessionUserId = Auth::user()->UserID;
        switch ($marginType[0]->ReportType)
        {
            case 'marginType1':
                $queryProducts= DB::connection('sqlsrv3')
                    ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
                break;
            case 'marginType2':
                $queryProducts= DB::connection('sqlsrv3')
                    ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
                break;
            case 'marginType3':
                $queryProducts= DB::connection('sqlsrv3')
                    ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
                break;
            case 'marginType4':
                $queryProducts= DB::connection('sqlsrv3')
                    ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
                break;
            case 'marginType5':
                $queryProducts= DB::connection('sqlsrv3')
                    ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
                break;

        }
        return view('dims/pricelookup')->with('products',$queryProducts);
    }

    public function getProducts()
    {
        $sessionUserId = Auth::user()->UserID;
        $queryProducts= DB::connection('sqlsrv3')
            ->select("Exec spActiveProductsWithVAT ".$sessionUserId);
        return response()->json($queryProducts);
    }
    public function getCustomers()
    {
        $queryCustomers =DB::connection('sqlsrv3')->table("tblCustomers" )->select('CustomerId','StoreName','CustomerPastelCode','CreditLimit','BalanceDue','UserField5','Email')->orderBy('CustomerPastelCode','ASC')->get();
        return response()->json($queryCustomers);
    }
    public function getProductsStopedBuyingJSon()
    {

         $getResults =DB::connection('sqlsrv3')
             ->select('exec spProductsStopedBuying  ?',
                 array(4)
             );
        return response()->json($getResults);
    }
    public function getProductsStopedBuying()
    {
        return view('dims/stopped_buying');
    }
public function getCustomerStoppedBuyingJSon()
    {

         $getResults =DB::connection('sqlsrv3')
             ->select('exec spCustomerStopped'
             );
        return response()->json($getResults);
    }
    public function getCustomerStoppedBuying()
    {
        return view('dims/customer_stopped_buying_odp');
    }
    public function returns()
    {
        (new DimsCommon())->clearAllUserLocks();
        $queryCustomers =DB::connection('sqlsrv3')->table("vwTestTblCustomers" )->select('CustomerId','StoreName','CustomerPastelCode','CreditLimit','BalanceDue','UserField5','Email','Routeid','Discount','OtherImportantNotes','strRoute')->where('StatusId',1)->orderBy('CustomerPastelCode','ASC')->get();
        $queryCustomersDontCareStatus =DB::connection('sqlsrv3')->table("vwTestTblCustomers" )->select('CustomerId','StoreName','CustomerPastelCode','CreditLimit','BalanceDue','UserField5','Email','Routeid','Discount','OtherImportantNotes','strRoute')->orderBy('CustomerPastelCode','ASC')->get();
        $deliverTypes = DB::connection('sqlsrv3')->table('tblOrderTypes')->select('OrderTypeId','OrderType')->get();
        $getDeliveryDates = DB::connection('sqlsrv3')->table('vwDistinctDelvDates')->select('DeliveryDate')->orderBy('DeliveryDate', 'desc')->get();
        $getRoutes =  DB::connection('sqlsrv3')->table('tblRoutes')->select('Routeid', 'Route')->where('NotInUse','0')->orderBy('Route', 'asc')->get();

        $marginType =  DB::connection('sqlsrv3')->table('tblCOMPANYREPORTS')->select('ReportType', 'Comment')->where('ReportName','marginCalculator')
            ->where('Function','1')
            ->get();


        switch ($marginType[0]->ReportType)
        {
            case 'marginType1':
                $queryProducts =DB::connection('sqlsrv3')->table("viewActiveProductWithVat" )->select('ProductId','PastelCode','PastelDescription','UnitSize','Tax','Cost','QtyInStock','Margin','Alcohol','Available')->orderBy('PastelCode','ASC')->distinct()->get();
                break;
            case 'marginType2':
                $queryProducts =DB::connection('sqlsrv3')->table("viewActiveProductWithVat" )->select('ProductId','PastelCode','PastelDescription','UnitSize','Tax','Cost','QtyInStock','Margin','Alcohol','Available')->orderBy('PastelCode','ASC')->distinct()->get();
                break;
            case 'marginType3':
                $queryProducts =DB::connection('sqlsrv3')->table("viewActiveProductWithVat" )->select('ProductId','PastelCode','PastelDescription','UnitSize','Tax','Cost','QtyInStock','Margin','Alcohol','Available')->orderBy('PastelCode','ASC')->distinct()->get();
                break;
            case 'marginType4':
                $queryProducts =DB::connection('sqlsrv3')->table("viewActiveProductWithVat" )->select('ProductId','PastelCode','PastelDescription','UnitSize','Tax','Cost','QtyInStock','Margin','Alcohol','Available')->orderBy('PastelCode','ASC')->distinct()->get();
                break;
            case 'marginType5':
                $queryProducts =DB::connection('sqlsrv3')->table("viewActiveProductWithVat" )->select('ProductId','PastelCode','PastelDescription','UnitSize','Tax','Cost','QtyInStock','Margin','Alcohol','Available')->distinct()->orderBy('PastelCode','ASC')->get();
                break;

        }

        $trueFalse =  DB::connection('sqlsrv3')->table('tblCOMPANYREPORTS')->select('ReportType', 'ReportName')->where('ReportName','True')
            ->orwhere('ReportName','False')
            ->get();
        $getLastInserted= DB::connection('sqlsrv3')
            ->select("Select * from viewGetLastInsertedOrderIdAndDeliveryDate");

        return view('dims/returns')->with('products',$queryProducts)
            ->with('trueOrFalse',$trueFalse)
            ->with('LastInserted',$getLastInserted)
            ->with('customers',$queryCustomers)
            ->with('customersDontcareStatus',$queryCustomersDontCareStatus)
            ->with('margin',$marginType[0]->ReportType)
            ->with('orderTypes',$deliverTypes)
            ->with('delivDates',$getDeliveryDates)
            ->with('routesNames',$getRoutes);
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
    public function edit($id)
    {
        //
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

    }
}
