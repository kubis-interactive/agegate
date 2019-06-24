<?php

namespace Kubis\AgeGate\Controllers;

use Validator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

use Kubis\AgeGate\Exceptions\AgeGateFormTypeNotSet;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function get(Request $request){
        $viewType = config('agegate.form_type', 'year');
        return View::first([
            'vendor.kubis.agegate.' . $viewType,
            'agegate::' . $viewType
        ]);
    }

    public function post(Request $request){
        // redirect him back or to homepage
        $returnUrl = $request->has('return') ? rawurldecode($request->input('return')) : url('/');

        // validation based on configuration type
        switch(config('agegate.form_type')) {
            case 'dob':
                $validator = Validator::make($request->input(), [
                    'day' => 'required|numeric|min:1|max:31',
                    'month' => 'required|numeric|min:1|max:12',
                    'year' => 'required|digits:4',
                ]);
            break;

            case 'year':
                $validator = Validator::make($request->input(), [
                    'year' => 'required|digits:4',
                ]);
            break;

            default:
                throw new AgeGateFormTypeNotSet("AgeGate configuration form_type not set");
        }
        
        if ($validator->fails()) {
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors($validator)
                ->withInput();
        }

        // do some additional datetime checks
        $then = new Carbon();
        $then->year = $request->input('year');
        if(config('agegate.form_type') == 'dob'){
            $then->day = $request->input('day');
            $then->month = $request->input('month');
        }

        if($then->diffInYears(new Carbon()) < (int)config('agegate.legal_age', 18)){
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors([
                    'too_young' => true
                ])
                ->withInput();
        }

        if($then->diffInYears(new Carbon()) >= (int)config('agegate.maximum_age', 120)) {
            return redirect(route('age-gate.redirect') . "?return=" . urlencode($returnUrl))
                ->withErrors([
                    'too_old' => true
                ])
                ->withInput();
        }

        // check if remember me checkbox is checked
        if($request->has('remember') && (int)$request->input('remember') == 1) {
            $cookieTime = (int)config('agegate.cookie_time_extended') * 60 * 24;
        } else {
            $cookieTime = config('agegate.cookie_time') * 60 * 24;
        }
        
        
        return redirect($returnUrl)->cookie(config('agegate.cookie_name'), 'legal-age', $cookieTime);
    }
}
