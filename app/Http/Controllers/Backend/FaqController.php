<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\FaqRequest;
use Illuminate\Support\Str;
use DataTables;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	if ($request->ajax()) {
    		$data = Faq::all();
    		return DataTables::of($data)
    		->addIndexColumn()

            ->addColumn('description',function($row){
             return Str::limit(strip_tags($row->description ?? ''),100,'...');
            })

            ->addColumn('title',function($row){
            return Str::limit(strip_tags($row->title ?? ''),100,'...');
            })

            ->addColumn('page_type',function($row){
            return strtoupper($row->page_type);
            })

    		->addColumn('created_at', function($row){
    			return $row->created_at->format('Y-m-d H:i:s');
    		})
    		->filter(function ($instance) use ($request) {
    			if (!empty($request->get('search'))) {
    				$instance->where(function($w) use($request){
    					$search = $request->get('search');
    					$w->where('name', 'LIKE', "%$search%");
    				});
    			}
    		})
    		->addColumn('action', function($row){
    			$btn = '';
    			$btn .= '<a href="'.route("backend.faq.edit", $row->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-pencil"></i></a>';
    			
                $btn .= '<a href="javascript:;" data-url="'.route('backend.faq.destroy', $row->id).'" class="delete-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                
                $btn .= '<a href="'.route("backend.faq.show", $row->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>';
    			return $btn;
    		})

    		->rawColumns(['description', 'action','title'])
    		->make(true);
    	}
    	return view('backend.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('backend.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FaqRequest $request)
    {
    	try {
             
    		Faq::create([
    			'title' => json_encode($request->title),
                'slug' => Str::slug($request->slug),
                'page_type' => $request->page_type,
    			'description' => json_encode($request->description)
    		]);
    		return redirect()->route('backend.faq.index')->with(['status' => 'success', 'message' => 'Credit Faq created successfully.']);

    	} catch (\Exception $e) {
    		return redirect()->route('backend.faq.create')->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    	}
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
     $record = Faq::find($id);
     return view('backend.faq.show',['record'=>$record]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$record = Faq::find($id);
    	return view('backend.faq.edit', ['record' => $record]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(FaqRequest $request,$id)
    {
    	try {
    		$data = [
    			'title' => json_encode($request->get('title')),
                'slug' => Str::slug($request->get('slug')),
                'page_type' => $request->page_type,
    			'description' => json_encode($request->get('description'))
    		];

    		Faq::where('id', $id)->update($data);

    		return redirect()->route('backend.faq.index')->with(['status' => 'success', 'message' => 'Faq updated successfully.']);

    	} catch (\Exception $e) {
    		return redirect()->route('backend.faq.edit', $id)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    	}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	try{

    		$faq = Faq::find($id);

    		$faq->delete();

    		return response()->json(['status' => 'success', 'message' => 'Faq deleted successfully.']);
    	}catch(\Exception $e){
    		return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    	}
    }
}
