<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BackOrders extends Controller
{
    public function remoteorders()
    {
        return view('dims/remote_orders');
    }
    public function getFreshOrderHeaders()
    {
        $orderheaders= DB::connection('linxbriefcase')
            ->select("Select * from  viewFreshOrderHeaders  order by OrderDate,CustomerStoreName");
        return response()->json($orderheaders);
    }

    public function getOrderLines($ID)
    {
        $orderlines= DB::connection('linxbriefcase')
            ->select("Select * from  viewOrderLines where ID='$ID'  order by strDesc");
        return response()->json($orderlines);
    }
    public function Xmlcommitremoteorder(Request $request)
    {

        $orderDetails = $request->get('value');
        $custCode = $request->get('custCode');
        $orderdate = $request->get('orderdate');
        $deldate = $request->get('deldate');
        $ordernumber = $request->get('ordernumber');
        $username = $request->get('username');
        $notes = $request->get('notes');
        $addressID = $request->get('addressID');
        $orderdiscount = $request->get('orderdiscount');
        $userid = Auth::user()->UserID;

        $orderDetailsxml = $this->toxml($orderDetails, "xml", array("result"));


        $getcommitorder = DB::connection('sqlsrv3')
            ->select('exec spXmlCommitOnlineOrder ?,?,?,?,?,?,?,?,?,?',
                array($orderDetailsxml,$custCode,$orderdate,$deldate,$ordernumber,$username,$notes,$addressID,$userid,$orderdiscount)
            );


        /* $getcommitorder = DB::connection('linxbriefcase')
             ->select("Select DIMSOrderDetailID,strPartNumber,Price,Quantity,'SUCCESS' as Result  from  OrderLines where ID = '1575456536r9ZkgHxmeR'");*/
        // $getcommitorder['Result']="SUCCESS";
        //$outPut['result'] = $getcommitorder;
        return response()->json($getcommitorder);

    }
    public function outstandingorders()
    {
        return view('dims/outstandingorders');
    }
    public function getFreshOrderHeadersOutstanding()
    {
        $orderheaders= DB::connection('linxbriefcase')
            ->select("Select * from  viewFreshOrderHeadersOutstanding order by OrderDate,CustomerStoreName");
        return response()->json($orderheaders);
    }
    public function updateOnlineLinesAndHeaders(Request $request)
    {
        $Orderid = $request->get('Orderid');
        $ID = $request->get('ID');
        $orderlines = DB::connection('sqlsrv3')
            ->select("Select PastelCode,OrderDetailId from  tblOrderDetails inner join viewtblProducts on viewtblProducts.ProductId = tblOrderdetails.ProductId where Orderid = $Orderid ");

        foreach ($orderlines as $val)
        {
            DB::connection('linxbriefcase')->table('OrderLines')->where('ID', $ID)->where('strPartNumber',$val->PastelCode)->update(['DIMSOrderDetailID' => $val->OrderDetailId]);
        }
        DB::connection('linxbriefcase')->table('OrderHeaders')->where('ID', $ID)->update(['DimsOrderID' =>  $Orderid ,'ExportedToDims'=>1]);
        $returnedOrderlines= DB::connection('linxbriefcase')
            ->select("Select DIMSOrderDetailID,strPartNumber,Price,Quantity  from  OrderLines where ID = '$ID'");

        $token = $request->get('token');
        $returnExternalOrderLines = DB::connection('linxbriefcase')
            ->select("EXEC spGetExternalOrders '$ID'" );

        $cat = array();
        $priceInfo = array();
        $priceInfosummary = array();
        $prods = array();
        $main = array();
        $jObject = array();
        $count = 0;
        $id = '';

        foreach ($returnExternalOrderLines as $value)
        {
            if ($count < 1){
                $id = $value->externalOrderId;
                $count++;
            }
            $priceInfo['ean'] = $value->BarCode;
            $priceInfo['quantity'] = (int)$value->Quantity;
            $main[] =$priceInfo;
        }


        $priceInfosummary['transactionId'] = $id;
        $priceInfosummary['lineItems'] = $main;


        return response()->json($priceInfosummary);

    }
    public function deleteRemoteOrder(Request $request)
    {
        $ID = $request->get('ID');
        $userName = Auth::user()->UserName;
        $returnmet = DB::connection('linxbriefcase')->table('OrderHeaders')->where('ID', $ID)->update(['DimsOrderID' =>  -9999 ,'ExportedToDims'=>1]);

        $getHeader = DB::connection('linxbriefcase')
            ->select("Select RepEmail,DIMSUser,DeliveryDate,CustomerCode from OrderHeaders 
                        left outer join Users on Users.UserName = OrderHeaders.UserName
                        where ID='".$ID."'");

        $getRouteProducts =DB::connection('sqlsrv3')
            ->statement('exec spDeletedRemoteOrder ?,?,?,?,?,?',
                array($ID,$userName,$getHeader[0]->RepEmail,$getHeader[0]->CustomerCode,$getHeader[0]->DeliveryDate,$getHeader[0]->DIMSUser)
            );

        return $returnmet;
    }
    public function onlineOrderHistory($date1,$date2)
    {

    }
    public function testAPI(Request $request)
    {
        $lists = $request->get('lists');
        $ID = $request->get('ID');
        $lists = $request->get('lists');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            // CURLOPT_URL => "http://stage-sifu.ufs.com:80/ecom/order/feedback/",
            CURLOPT_URL => "https://sifu.unileversolutions.com/ecom/order/feedback/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>json_encode($lists)/*'{"transactionId":"6b223ffe-a42a-479f-9833-ef9d83db2eb9","liteApiEnabled":false,"lineItems":[{"ean":"6001087307604","quantity":1}]}'*/,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                //"x-api-key: 11mG1mr1JwsOXM5DpxKZJGXSkJK7TrmuoyPO0ns5"
                "x-api-key: 11mG1mr1JwsOXM5DpRoDJGXSkJK7TrmuoyPO0ns5"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        return view('dims/testblade');
    }

    private static function getTabs($tabcount)
    {
        $tabs = '';
        for($i = 0; $i < $tabcount; $i++)
        {
            $tabs .= "\t";
        }
        return $tabs;
    }

    private static function asxml($arr, $elements = Array(), $tabcount = 0)
    {
        $result = '';
        $tabs = self::getTabs($tabcount);
        foreach($arr as $key => $val)
        {
            $element = isset($elements[0]) ? $elements[0] : $key;
            $result .= $tabs;
            $result .= "<" . $element . ">";
            if(!is_array($val))
                $result .= $val;
            else
            {
                $result .= "\r\n";
                $result .= self::asxml($val, array_slice($elements, 1, true), $tabcount+1);
                $result .= $tabs;
            }
            $result .= "</" . $element . ">\r\n";
        }
        return $result;
    }

    public static function toxml($arr, $root = "xml", $elements = Array())
    {
        $result = '';
        $result .= "<" . $root . ">\r\n";
        $result .= self::asxml($arr, $elements, 1);
        $result .= "</" . $root . ">\r\n";
        return $result;
    }
}
