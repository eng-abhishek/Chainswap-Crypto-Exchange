<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Trusted;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\TrustedByRequest;
use DataTables;
use Carbon\Carbon;

class TrustedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     if ($request->ajax()) {
        $data = Trusted::select('*');
        return DataTables::of($data)
        ->addIndexColumn()

        ->addColumn('image',function($row){
          return '<img id="view-logo-image" src="'.$row->trusted_img.'" style="margin-top:5px;width:140px;">';
         })

        ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a href="'.route("backend.trusted-logo.edit", $row->id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';
            $btn .= '<a href="javascript:;" data-url="'.route('backend.trusted-logo.destroy', $row->id).'" class="delete-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Delete"><i class="la la-trash"></i></a>';
            return $btn;
        })

        ->addColumn('created_at', function($row){
            return ($row->created_at != '')?Carbon::parse($row->created_at)->format('Y-m-d h:i:s'):'';
        })

        ->rawColumns(['action','image'])
        ->make(true);
    }
    return view('backend.cms.home.index');
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     return view('backend.cms.home.create');
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = ['alt' => $request->get('alt'),'url' => $request->get('url')];

     //Upload image

            if($request->hasFile('image')){

                $document_path = 'trust_logo';
                if (!\Storage::exists($document_path)) {
                    \Storage::makeDirectory($document_path, 0777);
                }

                $filename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME).'-'.time().'.'.$request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs($document_path, $filename);
                $data['image'] = $filename;
            }

        
            Trusted::Create($data);

            return redirect()->route('backend.trusted-logo.index')->with(['status' => 'success', 'message' => 'Trusted logo added successfully.']);

        }catch(\Exception $e){
         return redirect()->route('backend.trusted-logo.create')->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
     }
 }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trusted  $Trusted
     * @return \Illuminate\Http\Response
     */
    public function show(Trusted $Trusted)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trusted  $Trusted
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $data['record'] = Trusted::find($id);
      return view('backend.cms.home.edit',$data);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trusted  $Trusted
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
         $record = Trusted::find($id);

         $data = ['alt' => $request->get('alt'),'url' => $request->get('url')];
                  //Upload image
         if($request->hasFile('image')){

            $document_path = 'trust_logo';
            if (!\Storage::exists($document_path)) {
                \Storage::makeDirectory($document_path, 0777);
            }

                //Remove old image
            if ($record->image != '' && \Storage::exists($document_path.'/'.$record->image)) {
                \Storage::delete($document_path.'/'.$record->image);
            }

            $filename = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME).'-'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs($document_path, $filename);

            $data['image'] = $filename;
        }
        Trusted::where('id',$id)->update($data);

        return redirect()->route('backend.trusted-logo.index')->with(['status' => 'success', 'message' => 'Trusted logo updated successfully.']);

    }catch(\Exception $e){
      return redirect()->route('backend.trusted-logo.edit',$id)->with(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
  }
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trusted  $Trusted
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       try{

        Trusted::find($id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Trusted logo deleted successfully.']);
    }catch(\Exception $e){
        return response()->json(['status' => 'danger', 'message' => 'Something went wrong, please try again.']);
    }
}
}
