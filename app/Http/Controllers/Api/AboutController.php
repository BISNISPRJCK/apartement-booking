<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\CoreValue;
use App\Models\Statistic;

class AboutController extends Controller
{
    public function index()
    {
        return response()->json([
            'about' => About::first(),
            'corevalues' => CoreValue::latest()->get(),
            'statics' => Statistic::latest()->get(),
        ]);
    }

    // ABout Update dan add
    public function storeAbout(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'mission' => 'required',
            'vision' => 'required'
        ]);

        $about = About::first();

        if ($about) {
            $about->update($request->all());
            return response()->json([
                'about' => $about,
                'message' => 'berhasil edit about'
            ]);
        } else {
            $about = About::create($request->all());

            return response()->json([
                'about' => $about,
                'message' => 'berhasil tambah about'
            ]);
        }
    }

    public function deleteAbout()
    {
        $about = About::first();

        if (!$about) {
            return response()->json([
                'message' => 'About tidak ditemukan'
            ], 404);
        }

        $about->delete();

        return response()->json([
            'message' => 'About berhasil dihapus'
        ]);
    }




    public function storeCore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $core = CoreValue::create($request->all());

        return response()->json($core);
    }


    public function updateCore(Request $request, $id)
    {
        $core = CoreValue::findOrFail($id);
        $core->update($request->all());

        return response()->json($core);
    }

    public function deleteCore($id)
    {
        CoreValue::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }

    public function storeStat(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'value' => 'required',
        ]);

        $stat = Statistic::create($request->all());

        return response()->json($stat);
    }


    public function updateStat(Request $request, $id)
    {
        $stat = Statistic::findOrFail($id);
        $stat->update($request->all());

        return response()->json($stat);
    }


    public function deleteStat($id)
    {
        Statistic::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Deleted'
        ]);
    }
}
