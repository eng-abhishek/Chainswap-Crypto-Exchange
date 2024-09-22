<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ExchangeRequest;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Exchange;
use App\Models\Coin;

class ExchangeController extends Controller
{

	public function index(Request $request){

		if ($request->ajax()) {
			$data = Exchange::select('*');
			return Datatables::of($data)
			->addIndexColumn()

			->addColumn('from_coin', function($row){
				return strtolower($row->from_coin_symbol);
			})

			->addColumn('to_coin', function($row){
				return strtolower($row->to_coin_symbol);
			})

			->addColumn('action', function($row){
				$btn = '';
				$btn .= '<a href="'.route("backend.exchange.edit", $row->id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';

				$btn .= '<a href="javascript:;" data-url="'.route('backend.exchange.destroy', $row->id).'" class="delete-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';

				return $btn;
			})

			->addColumn('updated_at', function($row){
				return ($row->updated_at != '')?Carbon::parse($row->updated_at)->format('Y-m-d h:i:s'):'';
			})

			->filter(function ($instance) use ($request) {
				if (!empty($request->get('search'))) {
					$instance->where(function($w) use($request){
						$search = $request->get('search');
						$w->where('slug', 'LIKE', "%$search%");
						$w->orWhere('from_coin_symbol', 'LIKE', "%$search%");
						$w->orWhere('to_coin_symbol', 'LIKE', "%$search%");
					});
				}
			})

			->rawColumns(['action','from_coin','to_coin'])
			->make(true);
		}

		return view('backend.exchange.index');
	}

	public function create()
	{
		$coins = Coin::select('id', 'symbol', \DB::raw("CONCAT(`symbol`,' (',`coin_name`,')' ) as name"))->get()->pluck('name', 'symbol');

		return view('backend.exchange.create', ['coins' => $coins]);
	}

	public function store(ExchangeRequest $request)
	{
		try {

			if(strtoupper($request->get('from_coin_symbol')) == strtoupper($request->get('to_coin_symbol'))){
				return redirect()->route('backend.exchange.create')->with(['status' => 'danger', 'message' => '"To Coin" should be different.'])->withInput();
			}

			$exchange_exist = Exchange::where('from_coin_symbol', strtoupper($request->get('from_coin_symbol')))
			->where('to_coin_symbol', strtoupper($request->get('to_coin_symbol')))->first();
			if($exchange_exist){
				return redirect()->route('backend.exchange.create')->with(['status' => 'danger', 'message' => 'Pair ('.$request->get('from_coin_symbol').' - '.$request->get('to_coin_symbol').') already exist.'])->withInput();
			}

			$record = Exchange::create([
				'from_coin_symbol' => strtoupper($request->get('from_coin_symbol')),
				'to_coin_symbol' => strtoupper($request->get('to_coin_symbol')),
				'slug' => strtolower($request->get('from_coin_symbol')).'-to-'.strtolower($request->get('to_coin_symbol')),
      // 'from_coin_des' => $request->get('from_coin_des'),
      // 'to_coin_des' => $request->get('to_coin_des'),
      // 'from_coin_whitepaper_url' => $request->get('from_coin_whitepaper_url'),
      // 'to_coin_whitepaper_url' => $request->get('to_coin_whitepaper_url'),
      // 'from_coin_officialsite_url' => $request->get('from_coin_officialsite_url'),
      // 'to_coin_officialsite_url' => $request->get('to_coin_officialsite_url'),
	
		  //       'from_coin_des' => $request->get('from_coin_des'),
				// 'to_coin_des' => $request->get('to_coin_des'),
				// 'from_coin_whitepaper_url' => $request->get('from_coin_whitepaper_url'),
				// 'to_coin_whitepaper_url' => $request->get('to_coin_whitepaper_url'),
				// 'from_coin_officialsite_url' => $request->get('from_coin_officialsite_url'),
				// 'to_coin_officialsite_url' => $request->get('to_coin_officialsite_url'),
				// 'meta_title' => json_encode($request->meta_title),
    //             'meta_description' => json_encode($request->meta_description),
			]);

    // return redirect()->route('backend.exchange.index')->with(['status' => 'success', 'message' => 'Exchange created successfully.']);
			return redirect()->route('backend.exchange.edit', $record->id)->with(['status' => 'success', 'message' => 'Exchange pair created successfully, Please fill following details.']);

		} catch (\Exception $e) {
			return redirect()->route('backend.exchange.create')->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
		}
	}


	public function edit($id)
	{

		$record = Exchange::with('get_from_symbol', 'get_to_symbol')->find($id);

		$from_coin_info = \App\Models\Coin::where('symbol', $record->from_coin_symbol)->first();
		$to_coin_info = \App\Models\Coin::where('symbol', $record->to_coin_symbol)->first();

		if($from_coin_info){
			if(is_null($record->from_coin_des)){
				$record->from_coin_des = $from_coin_info->coin_desc;
			}
			if(is_null($record->from_coin_whitepaper_url)){
				$record->from_coin_whitepaper_url = $from_coin_info->coin_whitepaper_url;
			}
			if(is_null($record->from_coin_officialsite_url)){
				$record->from_coin_officialsite_url = $from_coin_info->coin_officialsite_url;
			}
		}

		if($to_coin_info){
			if(is_null($record->to_coin_des)){
				$record->to_coin_des = $to_coin_info->coin_desc; 
			}
			if(is_null($record->to_coin_whitepaper_url)){
				$record->to_coin_whitepaper_url = $to_coin_info->coin_whitepaper_url; 
			}
			if(is_null($record->to_coin_officialsite_url)){
				$record->to_coin_officialsite_url = $to_coin_info->coin_officialsite_url; 
			}
		}

		return view('backend.exchange.edit',['record' => $record]);

	}

	public function update(ExchangeRequest $request,$id)
	{
		try {
			$data = [
				'from_coin_des' => $request->get('from_coin_des'),
				'to_coin_des' => $request->get('to_coin_des'),
				'from_coin_whitepaper_url' => $request->get('from_coin_whitepaper_url'),
				'to_coin_whitepaper_url' => $request->get('to_coin_whitepaper_url'),
				'from_coin_officialsite_url' => $request->get('from_coin_officialsite_url'),
				'to_coin_officialsite_url' => $request->get('to_coin_officialsite_url'),
				'meta_title' => json_encode($request->meta_title),
                'meta_description' => json_encode($request->meta_description),
			];

			Exchange::where('id', $id)->update($data);

			return redirect()->route('backend.exchange.index')->with(['status' => 'success', 'message' => 'Exchange updated successfully.']);

		} catch (\Exception $e) {
			return redirect()->route('backend.exchange.edit', $id)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
		}
	}

	public function destroy($id)
	{
		try{

			$faq = Exchange::find($id);

			$faq->delete();

			return response()->json(['status' => 'success', 'message' => 'Exchange deleted successfully.']);
		}catch(\Exception $e){
			return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
		}
	}

}
?>