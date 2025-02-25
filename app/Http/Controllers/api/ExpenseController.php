<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return response()->json(['data' => $category], 200, [], JSON_UNESCAPED_UNICODE);
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
            $data['category_id'] = $request->category_id;
            $data['amount'] = $request->amount;
            $data['date'] = $request->date;
            if ($request->filled('notes')) {
                $data['notes'] = $request->note;
            }
            Expense::create($data);
            DB::commit();
            $expenses = Expense::where('user_id', $request->user_id)->get();
            if ($expenses->isNotEmpty()) {
                foreach ($expenses as $expense) {
                    $date = Carbon::parse($expense->created_at);
                    $data[] = [
                        'user_name' => $expense->user->name,
                        'category' => $expense->category->name_ar,
                        'amount' => $expense->amount,
                        'date' => $expense->date,
                    ];
                }
                return  response()->json(['message' => 'Data Fetch Successfully', 'data' => $data], 200, [], JSON_UNESCAPED_UNICODE);
            } else {
                return  response()->json(['message' => 'Error to Fetch Data'], 401, [], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Exception $th) {
            return  response()->json(['message' => 'Error To add data'], 202, [], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $expenses = Expense::where('user_id', $id)->get();
        if ($expenses->isNotEmpty()) {
            foreach ($expenses as $expense) {
                $date = Carbon::parse($expense->created_at);
                $data[] = [
                    'user_name' => $expense->user->name,
                    'category' => $expense->category->name_ar,
                    'amount' => $expense->amount,
                    'date' => $expense->date,
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
