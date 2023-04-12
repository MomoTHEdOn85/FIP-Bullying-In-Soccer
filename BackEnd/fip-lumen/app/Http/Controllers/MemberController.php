<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Member;


class MemberController extends Controller
{
  public function showAllMembers() {
    return response()->json(Member::all());
  }

  public function showOneMember($id) {
    return response()->json(Member::find($id));
  }


  //CRUD

  public function createMember(Request $request) {

    $this->validate($request, [
      //Setting up rules
      'fname' => 'required',
      'lname' => 'required',
      'email' => 'required'
    ]);

   // $member = new Member();
    $member = Member::create($request->all());
 
    //$member->name = $request->input('name');
    //$member->email = $request->input('email');


    //$member->save();

    return response()->json($member, 201);

    
  }


  public function updateMember(Request $request) {
    $member = Member::findOrFail($id);
    $member->update($request->all());
    return response()->json($member, 200);
  }


  public function deleteMember($id) {
    $member = Member::findOrFail($id)->delete();
    return response('deleted successfully', 200);
  }

  

}
