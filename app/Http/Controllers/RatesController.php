<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Rate;

use Illuminate\Http\Request;

class RatesController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check())
        {
            $slug = $request->slug;
            $product = Product::whereSlug($slug)->firstOrFail();

            if (strlen($request->review) < config('setting.six_value') || $request->point < config('setting.one_value'))
            {
                return response()->json([
                    'message' => trans('content.can_not_review'),
                    'flag' => config('setting.zero_value'),
                ]);
            }
            else
            {
                $rate = new Rate(array(
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'point' => $request->point,
                    'review' => $request->review,
                ));
                $rate->save();
                $product->update(['avgPoint' => $product->update_avgPoint($request->point)]);
                $review_count = $product->users->count();
                $user_name = Auth::user()->name;
                $point = $request->point;
                $review = $request->review;

                return response()->json([
                    'html' => view('rates.item', compact('user_name', 'point', 'review'))->render(),
                    'message' => trans('content.review_success'),
                    'flag' => config('setting.one_value'),
                    'new_avgPoint' => $product->update_avgPoint($request->point),
                    'review_count' => $review_count,
                ]);
            }
        }
        else
        {
            return respone()->json([
                'message' => trans('content.login_before_review'),
            ]);
        }
    }
}
