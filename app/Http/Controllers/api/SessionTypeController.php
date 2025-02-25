<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\SessionType;
use App\Models\UserSession;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SessionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $session = SessionType::all();
        return  response()->json(['data' => $session], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $data['user_id'] = $request->user_id;
            $data['session_type_id'] = $request->session_type_id;
            UserSession::create($data);
            DB::commit();
            $sessions = UserSession::where('user_id', $request->user_id)->get();
            if ($sessions->isNotEmpty()) {
                foreach ($sessions as $session) {
                    $date = Carbon::parse($session->created_at);
                    $data[] = [
                        'user_name' => $session->user->name,
                        'session' => !empty($session->other_name) ? $session->other_name : $session->sessiontype->name,
                        'details' => $session->Details,
                        'date' => $date->diffForHumans(),
                    ];
                }
                return  response()->json(['message' => 'Data Fetch Successfully', 'data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return  response()->json(['message' => 'Error to Fetch Data'], 401, [], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Exception $th) {
            return  response()->json(['message' => 'Error To add data'], 401, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $session = UserSession::where('id', $id)->first();
        if (isset($session) & !empty($session)) {
            $date = Carbon::parse($session->created_at);
            $data['user_name'] = $session->user->name;
            $data['session'] = !empty($session->other_name) ? $session->other_name : $session->sessiontype->name;
            $data['details'] = $session->Details;
            $data['date'] = $date->diffForHumans();
            return  response()->json(['message' => 'Data Fetch Successfully', 'data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return  response()->json(['message' => 'Error to Fetch Data'], 401, [], JSON_UNESCAPED_UNICODE);
        }
    }
    public function showall(string $id)
    {
        $data = [];
        $sessions = UserSession::where('user_id', $id)->get();
        if ($sessions->isNotEmpty()) {
            foreach ($sessions as $session) {
                $date = Carbon::parse($session->created_at);

                $data[] = [
                    'user_name' => $session->user->name,
                    'session' => !empty($session->other_name) ? $session->other_name : $session->sessiontype->name,
                    'details' => $session->Details,
                    'date' => $date->diffForHumans(),
                ];
            }
            return  response()->json(['message' => 'Data Fetch Successfully', 'data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
        } else {
            return  response()->json(['message' => 'Error to Fetch Data'], 401, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
