<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DimsCommon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MerchieController extends Controller
{
    public function merchieOrders()
    {
        return view ('merchie/orders');
    }
    public function getMerchieOrders(Request $request)
    {
        $dateFrom = $request->get('DateFrom');
        $dateTo = $request->get('DateTo');
      $returnMerchieOrders= DB::connection('sqlsrv3')
      ->select("Exec spGetMerchieOrders ?,?",
      array($dateFrom,$dateTo));
  return response()->json($returnMerchieOrders);
    }
    public function getMerchieOrderLines(Request $request)
    {
        $ID = $request ->get('ID');
        $returnMerchieLines= DB::connection('sqlsrv3')
          ->select("Exec spGetMerchieOrderLines ?",
          array($ID));
      return response()->json($returnMerchieLines);
    }
    public function merchieStocktakes()
    {

    }
    public function merchieVisits()
    {

    }  public function deleteMerchie(Request $request){
        $merchieDelete = $request->get('merchieDelete');
        DB::connection('sqlsrv3')->table('tblMerchies')
            ->where('intAutoId',$merchieDelete)
            ->delete();
    }
    public function displaymerchgrid()
    {
        
        $merchies= DB::connection('webstore')
        ->table('tblMerchies')->select('intAutoId','strCustomerCode','strRepCode','strMerchieCode','dteLatChanged','blnIsSaleRep')->get();
        $customercodes= DB::connection('webstore')
        ->table('tblCustomers')->select('CustomerPastelCode')->get();
        $merchieCodes= DB::connection('webstore')
        ->table('users')->select('merchiecode')->get();
        return view('dims/merchiegrid')->with ('merchies',$merchies)->with('customercode',$customercodes)
        ->with('merchiecodes',$merchieCodes);
    }
	 public function cutOffTimeGrid()
    {
        
        $cutoff= DB::connection('webstore')
        ->table('tblCutoffTimes')->select('ID','strDayOfWeek','strCutOffTime')->get();
     
        return view('merchie/cutofftime')->with ('cutoff',$cutoff);
    }
	public function updateCutoffTime(Request $request)
    {
        
        $ID =$request->get('ID');
        $Cutoff =$request->get('Cutoff');
		
		
      $response= DB::connection('webstore')
            ->select('exec spUpdateCutoffTime ?,?',
            array($ID,$Cutoff));
			
            return response()->json($response);
    }
	
	public function updateClockInOutTime(Request $request)
    {
        $ID =$request->get('ID');
        $Time =$request->get('NewTime');
		$response= DB::connection('webstore')->select('exec spUpdateClockInOutTime ?,?',array($ID,$Time));
        return response()->json($response);
    }
	
	public function deleteClockInOutRecord(Request $request)
    {
        $ID =$request->get('ID');
		$response= DB::connection('webstore')->select('exec spDeleteClockInOutRecord ?',array($ID));
        return response()->json($response);
    }
	
	public function insertClockInOutRecord(Request $request)
    {
        $User =$request->get('User');
		$Type =$request->get('Type');
		$Time =$request->get('Time');
		//dd($User, $Type, $Time);
		$response= DB::connection('webstore')->statement('exec spInsertClockInOutRecord ?,?,?',array($User,$Type,$Time));
        return response()->json($response);
    }
	
	
	public function getClockInOutGrid (Request $request)
	{
		
        $clockinout= DB::connection('webstore')
        ->table('tblClockInAndOut')->select('intClockInOutID','strUserName','strType','dteSaved','strCoordinates')->get();
		$merchieCodes= DB::connection('webstore')
        ->table('users')->select('merchiecode')->get();
        return view('merchie/clockinout')->with ('clockinout',$clockinout)->with ('merchiecodes',$merchieCodes);
		
	}
	
	public function userclockingreport (Request $request)
	{
        return view('merchie/userclockingreport');
		
	}
    public function insertNewMerchie(Request $request)
    {
        $CustCode =$request->get('CustCode');
        $RepCode =$request->get('RepCode');
        $MerchCode =$request->get('MerchieCode');
        $IsSalesRep =$request->get('IsRep');
        DB::connection('webstore')
        ->statement('exec spInsertMerch ?,?,?,?',
        array($CustCode,$RepCode,$MerchCode,$IsSalesRep));
        
    }
    public function insertNewUserMerchie(Request $request)
    {
        $MerchieCodePincode =$request->get('MerchieCodePincode');
        $MerchieName =$request->get('MerchieName');
        $MerchieCode =$request->get('MerchieCode');
        $RepCode =$request->get('RepCode');
        DB::connection('webstore')
        ->statement('exec spInsertMerchieUser ?,?,?,?',
        array($RepCode,$MerchieCodePincode,$MerchieName,$MerchieCode));
    }
    public function updateMerch(Request $request)
    {
            $ID =$request->get('ID');
            $CustomerCode = $request->get('CustomerCode'); 
            $RepCode = $request->get('RepCode'); 
            $MerchieCode = $request->get('MerchieCode'); 
            $IsSalesRep = $request->get('IsSalesRep'); 
            $response= DB::connection('webstore')
            ->select('exec spUpdateMerchie ?,?,?,?,?',
            array($ID,$CustomerCode,$RepCode,$MerchieCode,$IsSalesRep));
            return response()->json($response);
    }
    public function merchieorderid($id)
    {
        $returnMerchieLines= DB::connection('sqlsrv3')
            ->select("Exec spGetMerchieOrderLines ?",
                array($id));
        $returnMerchieH= DB::connection('sqlsrv3')
            ->select("Exec spGetMerchieOrderHeader ?",
                array($id));
        return view ('merchie/orderlines')
            ->with('lines',$returnMerchieLines)
            ->with('header',$returnMerchieH);
    }
    public function merchiecustomername($customercode,$delvdate)
    {
        $returnMerchieHeaders= DB::connection('sqlsrv3')
            ->select("Exec spGetMerchieOrdersCustomerCode ?,?",
                array($customercode,$delvdate));

        return view ('merchie/orderheaders')->with('header',$returnMerchieHeaders);
    }
    public function getTodayOrders($userID)
    {
        $returnMerchieHeaders= DB::connection('sqlsrv3')
            ->select("Exec spGetMerchieTodayOrders ?",
                array($userID));

        return view ('merchie/today')->with('header',$returnMerchieHeaders);
    }
	
	public function specials(){
        return view('merchie/specials');
    }
	
	public function getSpecialsHeaders(Request $request){       
        $headers = DB::connection('ecommerce')->select("select * from viewCustomerSpecialsToExport");
        return response()->json($headers);
    }

    public function getSpecialsLines(Request $request){
        $ID = $request->get('ID');
		$lines= DB::connection('ecommerce')->select("Exec spCustomerSpecialLinesExport ?",array($ID));
        return response()->json($lines);
    }
	
	public function exportToExcel(Request $request){
        $ID = $request->get('ID');
		$lines= DB::connection('ecommerce')->select("Exec spExportExcelLines ?",array($ID));
        return response()->json($lines);
    }
	
	public function userLoggingReport(){
        return view('merchie/userLoggingReport');
    }

    public function getUserLoggingReport(Request $request){
        $DateFrom = $request->get('dateFrom');
        $DateTo = $request->get('dateTo');
		$data= DB::connection('sqlsrv3')->select("Exec spGetUserClockingReport ?,?",array($DateFrom, $DateTo));
        return response()->json($data);
    }

}
