<?php


function respond(\App\Services\DTO\ResponseDTO $responseDTO, $is_view = false, $route = "")
{
    if ($is_view) {
        if ($responseDTO->getCode() != 200) {
            if ($route != "")
                return redirect(route($route))->withErrors([$responseDTO->getDescription()])->withInput();
            else
                return redirect()->back()->withErrors([$responseDTO->getDescription()])->withInput();
        }
        if ($route != "")
            return redirect(route($route))->with('message', $responseDTO->getDescription());
        else
            return redirect()->back()->with('message', $responseDTO->getDescription());
    }
    return \response($responseDTO, $responseDTO->getCode());
}


function absolute_url($url)
{
    $urlGenerator = app('Illuminate\Routing\UrlGenerator');
    return $urlGenerator->to($url);
}


function encrypt_text($payload){
    return \Illuminate\Support\Facades\Crypt::encryptString($payload);
}

function daysDiff($start, $end){
    $end = strtotime($end);
    $your_date = strtotime($start);
    $datediff = $end - $your_date;

    $day = round($datediff / (60 * 60 * 24));
    return $day==0 ? 1 : $day;
}

function total($start, $end, $cost){
    $dif = daysDiff($start, $end);
    return $cost*$dif;
}

