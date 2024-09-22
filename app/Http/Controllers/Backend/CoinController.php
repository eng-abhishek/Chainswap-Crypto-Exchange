<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coin;
use DataTables;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Coin::select('*');
    		return DataTables::of($data)
    		->addIndexColumn()
    		->addColumn('coin_desc', function($row){
    			return \Str::limit(strip_tags(html_entity_decode($row->coin_desc)), 50);
    		})
            ->addColumn('action', function($row){
                $btn = '';
                $btn .= '<a href="'.route("backend.coins.edit", $row->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-pencil"></i></a>';
                return $btn;
            })
            ->filter(function ($instance) use ($request) {
             if (!empty($request->get('search'))) {
                $instance->where(function($w) use($request){
                    $search = $request->get('search');
                    $w->where('symbol', 'LIKE', "%$search%");
                    $w->orWhere('coin_name', 'LIKE', "%$search%");
                });
            }
        })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.coin.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$record = Coin::find($id);

    	return view('backend.coin.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    	try {

    		Coin::where('id', $id)->update([
                'coin_desc' => $request->get('coin_desc'),
                'coin_whitepaper_url' => $request->get('coin_whitepaper_url'),
                'coin_officialsite_url' => $request->get('coin_officialsite_url')
            ]);

    		return redirect()->route('backend.coins.index')->with(['status' => 'success', 'message' => 'Coin info updated successfully.']);

    	} catch (\Exception $e) {
    		return redirect()->route('backend.coins.edit', $id)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    	}
    }
}
