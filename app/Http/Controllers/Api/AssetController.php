<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssetStore;
use App\Http\Requests\ReportStore;
use App\Http\Resources\AssetCollection;
use App\Http\Resources\AssetResource;
use App\Models\Asset;
use App\Models\Project;
use App\Models\Report;
use App\Models\Suggestion;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AssetCollection
     */
    public function index()
    {
        return new AssetCollection(Asset::where('visible', '=', '1')->get());
    }

    public function getTemplates()
    {
        return new AssetCollection(Asset::where('visible', '=', '1')->where('is_template', '=', '1')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $asset = Asset::make();

        return view('assets.edit', [
            'asset' => $asset,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(AssetStore $request)
    {
        return Asset::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Asset $asset
     * @return AssetResource
     */
    public function show(Asset $asset)
    {
        return new AssetResource($asset);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Asset $asset
     * @return Asset|Application|ResponseFactory|Response
     */
    public function update(Request $request, Asset $asset)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'file_path' => 'string',
            'object' => 'string',
            'type' => 'string',
            'visible' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 422);
        }

        $asset->update($request->all());

        return $asset;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Asset $asset
     * @return string[]
     */
    public function destroy(Asset $asset)
    {
        Asset::destroy($asset->id);
        return ['status' => '200'];
    }

    public function resportAsset(ReportStore $request, Asset $asset)
    {
        return Report::create(
            array_merge($request->all(), ['asset_id' => $asset->id])
        );
    }
}
