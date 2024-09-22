<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\EnquiryRequest;
use DataTables;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ContactUs::all();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('message', function($row){
                return $row->message;
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
                $btn .= '<a href="'.route("backend.enquiry.show", $row->id).'" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-eye"></i></a>';

                $btn .= '<a href="javascript:;" data-url="'.route('backend.enquiry.destroy', $row->id).'" class="delete-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
                
                return $btn;
            })

            ->addColumn('delCheckbox',function($row){

                $delCheckbox = '<div class="form-check"><input type="checkbox" class="form-check-input enquiry_checkbox" name="enquiry_checkbox[]"" value="'.$row->id.'"></div>';
                return $delCheckbox;
            })

            ->rawColumns(['delCheckbox','description', 'action'])
            ->make(true);
        }
        return view('backend.enquiry.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.enquiry.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnquiryRequest $request)
    {
      try {

        ContactUs::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'order_id' => $request->get('order_id'),
            'message' => $request->get('message'),
        ]);

        return redirect()->route('backend.enquiry.index')->with(['status' => 'success', 'message' => 'Enquiry created successfully.']);

    } catch (\Exception $e) {
        return redirect()->route('backend.enquiry.create')->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $record = ContactUs::find($id);
       return view('backend.enquiry.show',['record'=>$record]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContactUs  $contactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

            $faq = ContactUs::find($id);

            $faq->delete();

            return response()->json(['status' => 'success', 'message' => 'Enquiry deleted successfully.']);
        }catch(\Exception $e){
            return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
        }
    }


    public function removeall(Request $request){

        try{

            ContactUs::whereIn('id',$request->id)->delete();
            return response()->json(['status'=>'success','message'=>'Inquries has deleted successfully.']);

        }catch(\Exception $e){

            return response()->json(['status'=>'error','message'=>'Oop`s! something wents worng.']);
        }
    }
}
