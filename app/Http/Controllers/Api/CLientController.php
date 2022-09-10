<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class CLientController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ClientResource::collection(Client::all());
    }

    /**
     * @param ClientRequest $request
     * @return ClientResource
     */
    public function store(ClientRequest $request): ClientResource
    {
        $client = Client::create($request->validated());
        return new ClientResource($client);
    }

    /**
     * @param Client $client
     * @return ClientResource
     */
    public function show(Client $client): ClientResource
    {
        return new ClientResource($client);
    }

    /**
     * @param ClientRequest $request
     * @param Client $client
     * @return ClientResource
     */
    public function update(ClientRequest $request, Client $client): ClientResource
    {
        $client->update($request->validated());
        return new ClientResource($client);
    }

    /**
     * @param Client $client
     * @return Response
     */
    public function destroy(Client $client): Response
    {
        $client->delete();
        return response()->noContent();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->file()) {
            $file_name = time() . '_' . $request->file->getClientOriginalName();
            $request->file('file')->storeAs('clients', $file_name);
            if ($request->id) {
                $client = Client::find($request->id);
                $client->avatar = $file_name;
                $client->update();
            }
        }
        return response()->json(['file' => $file_name]);
    }
}
