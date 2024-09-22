<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\CustomPageRequest;
use DataTables;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       if($request->ajax()){

          $row = CustomPage::OrderBy('id','desc')->latest()->get();

          return DataTables::of($row)

          ->addIndexColumn()

          ->addColumn('updated_at',function($row){
            return Carbon::parse($row->updated_at)->format('d-m-Y h:i A');
        })

          ->addColumn('description',function($row){
           return Str::limit(strip_tags($row->description), 100, '..');
       })

       ->addColumn('action', function($row){
            $btn = '';
            $btn .= '<a href="'.route("backend.custom-page.edit", $row->id).'" class="edit-record m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" title="Edit"><i class="la la-edit"></i></a>';
            return $btn;
        })

          ->rawColumns(['created_at','action'])
          ->make(true);
      }
      return view('backend.custom_page.index');
  }

     public function edit($id)
     {
       $data['record'] = CustomPage::find($id);
       return view('backend.custom_page.edit',$data);
     }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomPage  $customPage
     * @return \Illuminate\Http\Response
     */

    public function update(CustomPageRequest $request, $id)
    {
       try{

           $data = array(
             'description' => $request->description,
         );

           CustomPage::where('id',$id)->update($data);
           return redirect()->route('backend.custom-page.index')->with(['status'=>'success','message'=>'Data has added successfully.']);

       }catch(\Exception $e){

        return redirect()->route('backend.custom-page.index')->with(['status'=>'danger','message'=>'Oop`s somthing wents wrong.']);
    }
}

}