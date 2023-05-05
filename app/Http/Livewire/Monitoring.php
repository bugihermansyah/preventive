<?php

namespace App\Http\Livewire;

use App\Models\Location;
use App\Models\User;
use App\Models\Checklist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Monitoring extends Component
{

    public function progress()
    {
        $q = DB::table('users')
                ->select('users.name',
                        DB::raw('(select count(*) from locations
                                        where locations.user_id = users.id
                                        AND locations.deleted_at = NULL) as staff_locations'),
                        DB::raw('(select count(*) from checklists
                                        where checklists.user_id = users.id
                                        AND MONTH(checklists.date) = 05) as staff_currents')
                )->get();
        return $q;
    }

    public function render()
    {
        $isMonthNow =  Carbon::now()->month;
        $isYearNow = Carbon::now()->year;
        $isMonthLast =  Carbon::now()->subMonth(1);
        $isYearLast = Carbon::now()->subYear(1);
        $totalChecklist = Checklist::whereMonth('created_at', $isMonthNow)
                            ->whereYear('created_at', $isYearNow)
                            ->count();
        $totalChecklistLastMonth = Checklist::whereMonth('created_at', $isMonthLast)
                            ->whereYear('created_at', $isYearLast)
                            ->count();
        $totalLocation = Location::all()->count();

        return view('livewire.monitoring', [
            'locations' => Location::all()->count(),
            'staffs' => DB::table('users')
                            ->join('model_has_roles','model_has_roles.model_id','=','users.id')
                            ->join('roles','roles.id','=','users.id')
                            ->where('roles.name','staff')
                            ->select('users.name',
                                    DB::raw('(select count(*) from locations
                                        where locations.user_id = users.id
                                        AND locations.deleted_at is NULL) as staff_locations'),
                                    DB::raw('(select count(*) from checklists
                                        where checklists.user_id = users.id
                                        AND MONTH(checklists.date) = MONTH(now())) as staff_currents')
                            )->get(),

            'checklists' => DB::table('checklists')
                            ->select('users.name as user_name','locations.name','checklists.date','checklists.created_at')
                            ->join('locations','locations.id','=','checklists.location_id')
                            ->join('users','checklists.user_id','=','users.id')
                            ->latest('checklists.created_at')
                            ->limit('10')
                            ->get(),

            'last_month' => Carbon::now()
                            ->copy()
                            ->subMonth(1)
                            ->format('F Y'), 
            'last_month_value' => round($totalChecklistLastMonth/$totalLocation*100),

            'current_month' => Carbon::now()
                            ->format('F Y'), 
            'current_month_value' => round($totalChecklist/$totalLocation*100),
            
            'total_location' => Location::all()->count()

        ]);
    }
}
