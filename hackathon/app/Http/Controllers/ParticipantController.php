<?php

namespace App\Http\Controllers;

use App\Models\Participants;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{


    public function select() {
        $data = Participants::all();
        return response()->json($data);
    }

    public function orderById() {
        $data = Participants::select('id')->get()->count();
        return response()->json($data);
    }

    public function insert(Request $req) {

        $email = Participants::where('email', 'like','%'.$req->input('email').'%')->first();

        if (!$email){

            $newData = new Participants;
            $newData->email = $req->input('email');
            $newData->idea = $req->input('idea');
            $newData->state = false;

            $newData->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully'
            ]);
        }
        else {
            return response()->json([
                'status' => 'Faild!',
                'message' => 'This email is already taken!'
            ]);
        }

    }

    public function edit($id) {
        $data = Participants::where('id' , 'like', '%' .$id. '%')->first();
        return response()->json($data);
    }

    public function update(Request $req , $id) {
        $data = Participants::where('id' , 'like', '%' .$id. '%')->first();
        $data->idea = $req->input('idea');
        $data->save();
    }

    public function selectIdea() {
        $data = Participants::select('id','idea')->get();
        return response()->json($data);
    }

    public function validateIdea(Request $req, $id ) {
        $data = Participants::where('id' , 'like', '%' .$id. '%')->first();
        $data->state = $req->input('state');
        if($req->input('state' == '1')){
            return response()->json([
                'status' => 'sec!',
                'message' => 'This message is already taken!'
            ]);
        }
        else {
            return response()->json([
                'status' => 'Faild!',
                'message' => 'This message is already taken!'
            ]);
        }
        $data->save();
    }

    public function selectAccepted() {
        $data = Participants::where('state', 'like' , '1')->get('idea');
        return response()->json($data);
    }

    public function countAccepted() {
        $data = Participants::where('state', 'like' , '1')->get()->count();
        return response()->json($data);
    }

    public function deleteRefuesd() {
        $data = Participants::where('state', 'like' , '0');
        
        $data->delete();

        return response()->json([
            'status' => 'delete!',
            'message' => 'All refuesd ideas has ben deleted!'
        ]);
    }
}
