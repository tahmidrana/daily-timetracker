<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimeLogRequest;
use App\Models\TimeLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class TimeLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('time_logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTimeLogRequest $request)
    {
        try{
            $entrys = $request->log_types;
            foreach($entrys as $row) {
                if($row['worked_hours']) {
                    $timeLog = new TimeLog();
                    $timeLog->user_id = $request->user_id;
                    $timeLog->project_id = $request->project_id;
                    $timeLog->entry_date = $request->entry_date;
                    $timeLog->time_log_type_id = $row['time_log_type_id'];
                    $timeLog->worked_hours = $row['worked_hours'];
                    $timeLog->save();
                }
            }
            return back()->withSuccess('Saved Successfully');
        } catch(\Exception $e) {
            return back()->withError('Save Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function show(TimeLog $timeLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function edit(TimeLog $timeLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TimeLog $timeLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeLog  $timeLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(TimeLog $timeLog)
    {
        //
    }

    public function getLogs()
    {
        $user = auth()->user();
        
        $data = DB::table('time_logs as a')
            ->select('a.id', 'c.userid', 'c.name as staff_name', 'c.designation', 'd.title AS project_name', 'd.client', 
            'a.entry_date', DB::raw('sum(a.worked_hours) AS total_hours'), DB::raw('GROUP_CONCAT(CONCAT(b.title, ": ", a.worked_hours)) AS time_logs'))
            ->join('time_log_types as b', 'a.time_log_type_id', '=', 'b.id')
            ->join('users as c', 'a.user_id', '=', 'c.id')
            ->join('projects as d', 'a.project_id', '=', 'd.id');
        if($user->is_superuser == 0) {
            $data->where('a.user_id', '=', $user->id);
        }

        $data->groupBy(['a.entry_date', 'a.project_id', 'a.user_id'])
            ->get();
        
        $result = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('date', function ($row){
                return Carbon::parse($row->entry_date)->format('d M, Y');
            })
            ->addColumn('project', function ($row){
                return $row->project_name;
            })
            ->addColumn('time_logs', function ($row){
                return implode(',\n', explode(',', $row->time_logs));
            })
            ->addColumn('action', function($row){
                $btn = '<a href="'. route('time-logs.destroy', $row->id) .'" onclick="return confirm_delete()" class="edit btn btn-danger btn-icon btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        return $result;
    }
}
