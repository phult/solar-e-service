<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ScheduleController extends BaseController
{
    public function setting($apiKey, $deviceId, Request $request)
    {
        $schedule = Schedule::where('device_id', '=', $deviceId)
            ->whereHas('user', function ($q) use ($apiKey) {
                $q->where('api_key', '=', $apiKey)
                    ->where('status', '=', 'active');
            })
            ->first(['setting', 'device_id']);
        if ($schedule !== null) {
            $user = User::where('api_key', '=', $apiKey)
                ->where('status', '=', 'active')->first();
            return view('setting', [
                'setting' => $schedule->setting,
                'deviceId' => $schedule->device_id,
                'user' => $user,
            ]);
        } else {
            return $this->error([
                'data' => 'not found',
            ]);
        }

    }
    public function saveSetting($apiKey, $deviceId, Request $request)
    {
        $schedule = Schedule::where('device_id', '=', $deviceId)
            ->whereHas('user', function ($q) use ($apiKey) {
                $q->where('api_key', '=', $apiKey)
                    ->where('status', '=', 'active');
            })
            ->first();
        if ($schedule != null) {
            $schedule->setting = $request->input('setting');
            $schedule->save();
            return $this->success();
        } else {
            return $this->error();
        }
    }
    public function state($apiKey, $deviceId, Request $request)
    {
        $result = [];
        $schedule = Schedule::where('device_id', '=', $deviceId)
            ->whereHas('user', function ($q) use ($apiKey) {
                $q->where('api_key', '=', $apiKey)
                    ->where('status', '=', 'active');
            })
            ->first(['setting']);
        if ($schedule != null) {
            $deviceSetting = $schedule['setting'];
            $deviceSetting = json_decode($deviceSetting, true);
            foreach ($deviceSetting as $pin => $pinSetting) {
                $pinState = [
                    'pin' => $pin,
                    'state' => $pinSetting['default'],
                ];
                //check on setting
                $state = $this->checkPinState($pinSetting['on'], $pinSetting['default'], 'on');
                if ($state != false) {
                    $pinState['state'] = $state;
                }
                //check off setting
                $state = $this->checkPinState($pinSetting['off'], $pinSetting['default'], 'off');
                if ($state != false) {
                    $pinState['state'] = $state;
                }
                $result[] = $pinState;
            }
        }
        return $this->success([
            'data' => $result,
        ]);
    }
    public function checkPinState($pinSetting, $defaultState, $checkedState)
    {
        $retval = false;
        foreach ($pinSetting as $setting) {
            $now = new \DateTime();
            $dateFrom = new \DateTime($setting['date_from'] . ' 00:00:00');
            $dateTo = new \DateTime($setting['date_to'] . ' 23:59:59');
            $timeFromSplit = explode(':', $setting['time_from']);
            $timeFrom = new \DateTime();
            $timeFrom->setTime($timeFromSplit[0], $timeFromSplit[1], $timeFromSplit[2]);
            $timeToSplit = explode(':', $setting['time_to']);
            $timeTo = new \DateTime();
            $timeTo->setTime($timeToSplit[0], $timeToSplit[1], $timeToSplit[2]);
            if ($now >= $dateFrom
                 & $now <= $dateTo
                 & $now >= $timeFrom
                 & $now <= $timeTo) {
                $retval = $checkedState;
                break;
            }
        }
        return $retval;
    }
}
