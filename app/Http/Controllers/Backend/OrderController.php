<?php
namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OrderController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('actual_order_id', function($row){
                return $row->actual_orderid." - <a href='".route('order', $row->orderid)."' target='_blank'>Track</a>";
            })
            
            ->addColumn('exchange', function($row){
                return $row->from_amount.' '.$row->from_currency.' => '.$row->to_amount.' '.$row->to_currency;
            })

            ->addColumn('order_at', function($row){
                return Carbon::parse($row->created_at)->format('Y-m-d h:i:s A');
            })

            ->addColumn('user_ip', function($row){
                return (!empty($row->obj_user_order) ? $row->obj_user_order->last_login_ip : '');
            })
            
            ->addColumn('user_agent', function($row){
                return (!empty($row->obj_user_order) ? $row->obj_user_order->user_agent : '');
            })

            ->addColumn('status', function($row){
                return (!empty($row->state) ? $row->state : '');
            })

            ->addColumn('exchange_api', function($row){
                return get_exchange_api($row->order_generated_from);
            })

            ->filter(function ($instance) use ($request) {
                if (!empty($request->get('search'))) {
                    $instance->where(function($w) use($request){
                        $search = $request->get('search');
                        $w->where('orderid', 'LIKE', "%$search%");
                        $w->orWhere('actual_orderid', 'LIKE', "%$search%");
                    });
                }
                if ($request->get('status') != '') {
                    $instance->where('state', $request->get('status'));
                }
            })
            ->rawColumns(['actual_order_id', 'status','exchange_api'])
            ->make(true);
        }
        return view('backend.orders');
    }
}
?>